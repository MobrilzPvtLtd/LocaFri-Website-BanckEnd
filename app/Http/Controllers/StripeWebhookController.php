<?php

namespace App\Http\Controllers;

use App\Mail\BookingMail;
use App\Models\Booking;
use App\Models\Checkout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
        $booking->order_status = $response->payment_status;
        $booking->save();

        $checkout = Checkout::where('booking_id',$booking->id)->first();

        $remaining_amount = $booking->total_price;
        $discount = $booking->total_price * 0.10;
        $remaining_amount -= $discount;

        $data = [
            'name' => $checkout->first_name . ' ' . $checkout->last_name,
            'email' => $checkout->email,
            'address_first' => $checkout->address_first,
            'address_last' => $checkout->address_last,
            'vehicle_name' => $booking->name,
            'day_price' => $booking->Dprice,
            'week_price' => $booking->wprice,
            'month_price' => $booking->mprice,
            'total_price' => $booking->total_price,
            'remaining_amount' => $remaining_amount,
            'additional_driver' => $booking->additional_driver,
            'booster_seat' => $booking->booster_seat,
            'child_seat' => $booking->child_seat,
            'exit_permit' => $booking->exit_permit,
            'pickUpLocation' => $booking->pickUpLocation,
            'dropOffLocation' => $booking->dropOffLocation,
            'pickUpDate' => $booking->pickUpDate,
            'pickUpTime' => $booking->pickUpTime,
            'collectionTime' => $booking->collectionTime,
            'collectionDate' => $booking->collectionDate,
            'targetDate' => $booking->targetDate,
            'status' => $booking->status,
            'order_status' => $booking->order_status,
            'payment_status' => $booking->payment_status,
            'payment_method' => $booking->payment_method,
        ];

        if ($checkout->email) {
            Mail::to($checkout->email)->send(new BookingMail($data));
        }

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
