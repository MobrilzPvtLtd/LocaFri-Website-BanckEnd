<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\StripeWebhookController;
use App\Http\Livewire\TermsAndConditions;

Route::get('/terms-and-conditions', [ApiController::class, 'getTerms']);
Route::get('/privacy-policy', [ApiController::class, 'getPrivacy']);


// is_contract route hit for admin dashboard //
Route::post('accept', [ApiController::class, 'acceptBooking'])->name('booking.accept');
Route::post('contract', [ApiController::class, 'contract']);

Route::get('cars', [ApiController::class, 'cars']);
Route::get('cardetails/{id}', [ApiController::class, 'cardetails']);
Route::post('avalibalcars', [ApiController::class, 'avalibalcars']);

Route::post('singup', [ApiController::class, 'register']);
Route::post('login', [ApiController::class, 'login']);
Route::post('verify-otp', [ApiController::class, 'verifyOtp']);
Route::post('resend-otp', [ApiController::class, 'resendOtp']);

Route::post('booking-history', [ApiController::class, 'bookingHistory']);
Route::post('contactus', [ApiController::class, 'contactus']);

Route::middleware('auth:sanctum')->group( function () {
    Route::post('logout', [ApiController::class, 'logout']);
    Route::put('updateProfile', [ApiController::class, 'updateProfile']);
    Route::post('create-contract', [ApiController::class, 'create_contract']);
    Route::post('stripe-payment', [StripeWebhookController::class, 'stripePayment']);
    Route::post('checkin', [ApiController::class, 'checkin']);
    Route::post('checkout', [ApiController::class, 'checkout']);
    Route::get('getPaymentStatus', [ApiController::class, 'getPaymentStatus']);

});

// task testing apis for fluter //
Route::get('index', [ProductController ::class, 'index']);
Route::post('store', [ProductController ::class, 'store']);
Route::post('update/{id}', [ProductController ::class, 'update']);
Route::post('delete/{id}', [ProductController ::class, 'destroy']);


