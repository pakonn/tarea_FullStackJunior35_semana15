<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/users',[UserController::class,'index']);
Route::post('/register',[UserController::class,'register']);
Route::post('/login',[UserController::class,'login']);

Route::get('/products',[ProductController::class,'index']);

Route::get('/orders/{id}',[OrderController::class,'listOrders']);

Route::middleware('auth:sanctum')->group(function(){
    //PRODUCTS
    Route::post('/products',[ProductController::class,'store']);
    Route::put('/products/{id}',[ProductController::class,'update']);
    Route::delete('/products/{id}',[ProductController::class,'destroy']);
    Route::put('/products/{id}/restore',[ProductController::class,'restore']);

    //ORDERS Y ORDER_ITEM
    Route::post('/orders',[OrderController::class,'store']);
    Route::put('/orders/{id}',[OrderController::class,'update_head']);
    Route::delete('/orders/{id}',[OrderController::class,'destroy_head']);
    Route::put('/orders/{id}/restore',[OrderController::class,'restore_head']);    

    Route::put('/order_items/{id}',[OrderItemController::class,'update_line']);
    Route::delete('/order_items/{id}',[OrderItemController::class,'destroy_line']);
    Route::put('/order_items/{id}/restore',[OrderItemController::class,'restore_line']);  
});
