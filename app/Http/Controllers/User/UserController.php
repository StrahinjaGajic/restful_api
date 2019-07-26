<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\ApiController;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::all();

        return $this->showAll($user);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed'
        ],[
            'email.required' => 'Email address is required',
            'email.unique' => 'This email is already taken'
        ]);

        if($validator->fails()){
            return response()->json(['error' => $validator->errors()], 422);
        }

        $data = $request->all();
        $data['password'] = bcrypt($request->password);
        $data['verified'] = User::UNVERIFIED_USER;
        $data['verification_token'] = User::generateVerificationCode();
        $data['admin'] = User::REGULAR_USER;

        $user = User::create($data);

        return $this->showOne($user,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        return $this->showOne($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'string|min:3',
            'email' => 'email|unique:users,email,'.$user->id,
            'admin' => 'in:'.User::REGULAR_USER.','.User::ADMIN_USER,
            'password' => 'min:6|confirmed'
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()],422);
        }
        if($request->has('name')) {
            $user->name = $request->name;
        }
        if ($request->has('email') && $user->email != $request->email) {
            $user->verified = User::UNVERIFIED_USER;
            $user->verification_token = User::generateVerificationCode();
            $user->email = $request->email;
        }
        if($request->has('password')) {
            $user->password = bcrypt($request->password);
        }

        if($request->has('admin')) {
            if (!$user->isVerified()) {
                return response()->json(['error' => 'Only verified users can modify the admin field','code' => 409],409);
            }
            $user->admin = $request->admin;
        }
        if(!$user->isDirty()){
            return response()->json(['error' => 'You need to specify a different value to update','code' => 422],422);
        }

        $user->save();

        return $this->showOne($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return $this->showOne($user);
    }
}
