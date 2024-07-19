<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class StripeWebhookController extends Controller
{
    public function stripeCheckout(Request $request){

        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

        $redirectUrl = route('stripe-checkout-success') . '?session_id={CHECKOUT_SESSION_ID}';
        $cancelUrl = route('stripe-checkout-cancel') . '?session_id={CHECKOUT_SESSION_ID}';

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
            ],
        ]);

        return redirect($response['url']);
    }

    public function stripeCheckoutSuccess(Request $request){
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

        $response = $stripe->checkout->sessions->retrieve($request->session_id);

        $booking = Booking::find($response->metadata->booking_id);
        $booking->order_id = $response->id;
        $booking->status = $response->status;
        $booking->payment_status = $response->payment_status;
        $booking->save();

        return redirect()->route('home');
    }

    public function stripeCheckoutCancel(Request $request){
        $booking = Booking::where('order_id', $request->session_id)->first();
        $booking->status = $booking->status;
        $booking->payment_status = $booking->payment_status;
        $booking->save();

        return redirect()->route('home');
    }

}
