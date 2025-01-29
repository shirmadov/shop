<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ShopController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/catalog',[ShopController::class,'catalog']);
Route::post('/catalog-order',[ShopController::class,'createOrder']);
Route::post('/approve-order',[ShopController::class,'approveOrder']);
