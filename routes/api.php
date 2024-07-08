<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('login', [ApiController::class, 'login']);
Route::get('avalibalcars', [ApiController::class, 'avalibalcars']);
Route::get('cardetails/{id}', [ApiController::class, 'cardetails']);
Route::get('cars', [ApiController::class, 'cars']);




