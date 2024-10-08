<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Api\PaymentController;
// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('singup', [ApiController::class, 'register']);
Route::post('login', [ApiController::class, 'login']);
Route::post('resend-otp', [ApiController::class, 'resendOtp']);
Route::post('verify-otp', [ApiController::class, 'verifyOtp']);
Route::post('avalibalcars', [ApiController::class, 'avalibalcars']);
Route::get('cardetails/{id}', [ApiController::class, 'cardetails']);
Route::get('cars', [ApiController::class, 'cars']);
Route::post('contract', [ApiController::class, 'contract']);
Route::post('create-contract', [ApiController::class, 'create_contract']);

Route::post('checkin', [ApiController::class, 'checkin']);
// Route::middleware('auth:api')->post('checkin', [ApiController::class, 'checkin']);
Route::post('accept', [ApiController::class, 'acceptBooking'])->name('booking.accept');

// Route::middleware('auth')->group(function () {
    Route::get('index', [ProductController ::class, 'index']);
    Route::post('store', [ProductController ::class, 'store']);
    Route::post('update/{id}', [ProductController ::class, 'update']);
    Route::post('delete/{id}', [ProductController ::class, 'destroy']);
// });
// Route::post('stripe', [PaymentController::class, 'stripe'])->name('stripe');
// Route::get('stripe-checkout', [PaymentController::class, 'stripeCheckout'])->name('stripe-checkout');
// Route::get('stripe-checkout-cancel', [PaymentController::class, 'stripeCheckoutCancel'])->name('stripe-checkout-cancel');

Route::get('stripe', [PaymentController ::class, 'stripe']);
// Route::get('stripe/checkout', [PaymentController::class, 'stripeCheckout']);
// Route::get('stripe/checkout/cancel', [PaymentController::class, 'stripeCheckoutCancel']);


