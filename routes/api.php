<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\SystemSettingController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post('/login', 'App\Http\Controllers\Api\LoginController@login');
Route::middleware('auth:sanctum')->group(function(){
    Route::get('/user', function (Request $request) {
        return $request->user();
    });




});
    Route::apiResource('/system-setting', SystemSettingController::class)->only(['index', 'update']);

    Route::get('/all-categories', [CategoryController::class, 'allCategories']);
    Route::get('/categories/status/{id}', [CategoryController::class, 'status']);
    Route::apiResource('/categories', CategoryController::class);


    Route::get('/all-products', [ProductController::class, 'allProducts']);
    Route::get('/products/status/{id}', [ProductController::class, 'status']);
    Route::apiResource('/products', ProductController::class);