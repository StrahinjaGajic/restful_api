<?php

use Illuminate\Http\Request;
use \Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('buyers','Buyer\BuyerController',['only' => ['index','show']]);
Route::resource('buyers.transactions','Buyer\BuyerTransactionController',['only' => ['index']]);
Route::resource('buyers.products','Buyer\BuyerProductController',['only' => ['index']]);
Route::resource('buyers.seller','Buyer\BuyerSellerController',['only' => ['index']]);
Route::resource('buyers.category','Buyer\BuyerCategoryController',['only' => ['index']]);

Route::resource('products','Product\ProductController',['only' => ['index','show']]);

Route::resource('sellers','Seller\SellerController',['only' => ['index','show']]);
Route::resource('sellers.transaction','Seller\SellerTransactionController',['only' => ['index']]);
Route::resource('sellers.categories','Seller\SellerCategoryController',['only' => ['index']]);
Route::resource('sellers.buyer','Seller\SellerBuyerController',['only' => ['index']]);
Route::resource('sellers.products','Seller\SellerProductController',['only' => ['index']]);

Route::resource('categories','Category\CategoryController',['except' => ['create','edit']]);
Route::resource('categories.products','Category\CategoryProductController',['only' => ['index']]);
Route::resource('categories.seller','Category\CategorySellerController',['only' => ['index']]);
Route::resource('categories.transaction','Category\CategoryTransactionController',['only' => ['index']]);
Route::resource('categories.buyer','Category\CategoryBuyerController',['only' => ['index']]);

Route::resource('transactions','Transaction\TransactionController',['only' => ['index','show']]);
Route::resource('transactions.categories', 'Transaction\TransactionCategoryController', ['only' => 'index']);
Route::resource('transactions.sellers', 'Transaction\TransactionSellerController', ['only' => 'index']);

Route::resource('users','User\UserController',['except' => ['create','edit']]);