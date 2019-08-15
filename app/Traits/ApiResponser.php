<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

trait ApiResponser {

    protected function successReponse($data, $code) {
        return response()->json($data,$code);
    }

    /**
     * @param string|array $message
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    protected function errorResponse($message, $code) {
        return response()->json(['error' => $message,'code' => $code],$code);
    }

    /**
     * @param Collection $collection
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    protected function showAll(Collection $collection, $code = 200) {
        return $this->successReponse(['data' => $collection],$code);
    }

    /**
     * @param Model $model
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    protected function showOne(Model $model, $code = 200) {
        return $this->successReponse(['data' => $model],$code);
    }
}