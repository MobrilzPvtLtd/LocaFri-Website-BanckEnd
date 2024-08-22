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
use App\Models\Booking;

class PaymentController extends Controller
{
    public function stripe(Request $request){

        try {
            // Initialize Stripe client with secret key
            $stripe = new StripeClient(env('STRIPE_SECRET'));

            // Construct success and cancel URLs
            $redirectUrl = route('stripe-checkout') . '?session_id={CHECKOUT_SESSION_ID}';
            $cancelUrl = route('stripe-checkout-cancel') . '?session_id={CHECKOUT_SESSION_ID}';

            // Create a Stripe checkout session
            $response = $stripe->checkout->sessions->create([
                'success_url' => $redirectUrl,
                'cancel_url' => $cancelUrl,
                // 'customer_email' => $request->customer_email,
                'payment_method_types' => ['link', 'card'],
                'line_items' => [
                    [
                        'price_data' => [
                            'product_data' => [
                                'name' => $request->vehicle_name,
                            ],
                            'unit_amount' => 100 * $request->price, // Price in cents
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
            // dd($response);
            // Return the session URL in a JSON response
            return response()->json([
                'status' => true,
                'message' => 'Stripe session created successfully.',
                'session_url' => $response['url'],
            ]);
        } catch (\Exception $e) {
            // Log error and return a JSON error response
            Log::error('Stripe Error: ' . $e->getMessage());
            return response()->json([
                'status' => false,
                'message' => 'Failed to create Stripe session: ' . $e->getMessage(),
            ], 500);
        }
    }

    // public function stripe(Request $request)
    // {
    //     try {
    //         // Ensure the Stripe secret key is set
    //         $stripeSecret = env('STRIPE_SECRET');
    //         if (!$stripeSecret) {
    //             return response()->json([
    //                 'status' => false,
    //                 'message' => 'Stripe secret key not set in environment.',
    //             ], 500);
    //         }

    //         // Instantiate the Stripe client
    //         $stripe = new StripeClient($stripeSecret);

    //         // Construct URLs
    //         $redirectUrl = route('stripe-checkout') . '?session_id={CHECKOUT_SESSION_ID}';
    //         $cancelUrl = route('stripe-checkout-cancel') . '?session_id={CHECKOUT_SESSION_ID}';

    //         // Fetch the booking information using the booking ID from the request
    //         $booking = Booking::find($request->booking_id);

    //         // Check if the booking exists
    //         if (!$booking) {
    //             return response()->json([
    //                 'status' => false,
    //                 'message' => 'Booking not found.',
    //             ], 404);
    //         }

    //         // Log request data for debugging
    //         Log::info('Stripe Request Data:', $request->all());

    //         // Create the Stripe checkout session
    //         $response = $stripe->checkout->sessions->create([
    //             'success_url' => $redirectUrl,
    //             'cancel_url' => $cancelUrl,
    //             'payment_method_types' => ['link', 'card'],
    //             'line_items' => [
    //                 [
    //                     'price_data' => [
    //                         'product_data' => [
    //                             'name' => $booking->vehicle_name, // Use the vehicle name from the booking
    //                         ],
    //                         'unit_amount' => 100 * $request->price, // Assuming price is in dollars, converted to cents
    //                         'currency' => 'USD',
    //                     ],
    //                     'quantity' => 1,
    //                 ],
    //             ],
    //             'mode' => 'payment',
    //             'allow_promotion_codes' => true,
    //             'metadata' => [
    //                 'booking_id' => $request->booking_id,
    //                 'payment_type' => $request->payment_type,
    //             ],
    //         ]);

    //         // Return a successful response
    //         return response()->json([
    //             'status' => true,
    //             'message' => 'Stripe session created successfully.',
    //             'session_url' => $response['url'],
    //             'session_id' => $response['id'],
    //         ]);
    //     } catch (InvalidRequestException $e) {
    //         Log::error("Stripe Invalid Request Error: " . $e->getMessage(), [
    //             'stripe_error' => $e->getJsonBody(),
    //         ]);
    //         return response()->json([
    //             'status' => false,
    //             'message' => 'Invalid request made: ' . $e->getMessage(),
    //         ], 400);
    //     } catch (\Exception $e) {
    //         Log::error("Stripe General Error: " . $e->getMessage());
    //         return response()->json([
    //             'status' => false,
    //             'message' => 'Failed to create Stripe session: ' . $e->getMessage(),
    //         ], 500);
    //     }
    // }
}
