<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\ProductController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('register', [ApiController::class, 'register']);
Route::post('login', [ApiController::class, 'login']);
Route::post('resend-otp', [ApiController::class, 'resendOtp']);
Route::post('verify-otp', [ApiController::class, 'verifyOtp']);
Route::get('avalibalcars', [ApiController::class, 'avalibalcars']);
Route::get('cardetails/{id}', [ApiController::class, 'cardetails']);
Route::get('cars', [ApiController::class, 'cars']);

// Route::middleware('auth')->group(function () {
    Route::get('index', [ProductController ::class, 'index']);
    Route::post('store', [ProductController ::class, 'store']);
    Route::post('update/{id}', [ProductController ::class, 'update']);
    Route::post('delete/{id}', [ProductController ::class, 'destroy']);
// });




