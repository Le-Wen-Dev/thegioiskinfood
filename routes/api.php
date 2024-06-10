<?php

use App\Http\Controllers\Api\ApiProductController;
use App\Http\Controllers\Api\ApiUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


Route::get('/product', [ApiProductController::class, 'index']);
Route::post('/storeproduct', [ApiProductController::class, 'store']);
Route::get('/productssale', [ApiProductController::class, 'productsSale']);
Route::get('/editproduct/{id}', [ApiProductController::class, 'showoneproduct']);
Route::post('/editproduct/{id}', [ApiProductController::class, 'editproduct']);
Route::get('/deleteproduct/{id}', [ApiProductController::class, 'deleteproduct']);

//user
Route::get('/user', [ApiUserController::class, 'index']);
Route::post('/adduser', [ApiUserController::class, 'store']);
Route::get('/showone/{id}', [ApiUserController::class, 'showone']);
Route::post('/edituser/{id}', [ApiUserController::class, 'edituser']);
Route::get('/deleteuser/{id}', [ApiUserController::class, 'deleteuser']);
