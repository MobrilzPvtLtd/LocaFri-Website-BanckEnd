<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('login', [ App\Http\Controllers\API\ApiController::class, 'login']);
Route::get('avalibalcars', [ App\Http\Controllers\API\ApiController::class, 'avalibalcars']);
Route::get('cardetails/{id}', [ App\Http\Controllers\API\ApiController::class, 'cardetails']);
Route::get('cars', [ App\Http\Controllers\API\ApiController::class, 'cars']);




