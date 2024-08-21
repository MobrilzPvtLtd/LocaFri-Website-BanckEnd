<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Stripe\Exception\CardException;
use Stripe\Exception\RateLimitException;
use Stripe\Exception\InvalidRequestException;
use Stripe\Exception\AuthenticationException;
use Stripe\Exception\ApiConnectionException;
use Stripe\Exception\ApiErrorException;
use Stripe\StripeClient;

class PaymentController extends Controller
{
    public function stripe(Request $request)
    {
        try {
            $stripeSecret = env('STRIPE_SECRET');
            if (!$stripeSecret) {
                return response()->json([
                    'status' => false,
                    'message' => 'Stripe secret key not set in environment.',
                ], 500);
            }

            $stripe = new StripeClient($stripeSecret);

            $redirectUrl = route('stripe-checkout') . '?session_id={CHECKOUT_SESSION_ID}';
            $cancelUrl = route('stripe-checkout-cancel') . '?session_id={CHECKOUT_SESSION_ID}';

            // Log request data for debugging
            Log::info('Stripe Request Data:', $request->all());

            $response = $stripe->checkout->sessions->create([
                'success_url' => $redirectUrl,
                'cancel_url' => $cancelUrl,
                'customer_email' => $request->customer_email,
                'payment_method_types' => ['link', 'card'],
                'line_items' => [
                    [
                        'price_data' => [
                            'product_data' => [
                                'name' => $request->vehicle_name,
                            ],
                            'unit_amount' => 100 * $request->price,
                            'currency' => 'USD',
                        ],
                        'quantity' => 1,
                    ],
                ],
                'mode' => 'payment',
                'allow_promotion_codes' => true,
                'metadata' => [
                    'booking_id' => $request->booking_id,
                    'payment_type' => $request->payment_type,
                ],
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Stripe session created successfully.',
                'session_url' => $response['url'],
                'session_id' => $response['id'],
            ]);
        } catch (InvalidRequestException $e) {
            Log::error("Stripe Invalid Request Error: " . $e->getMessage(), [
                'stripe_error' => $e->getJsonBody(),
            ]);
            return response()->json([
                'status' => false,
                'message' => 'Invalid request made: ' . $e->getMessage(),
            ], 400);
        } catch (\Exception $e) {
            Log::error("Stripe General Error: " . $e->getMessage());
            return response()->json([
                'status' => false,
                'message' => 'Failed to create Stripe session: ' . $e->getMessage(),
            ], 500);
        }
    }
}
