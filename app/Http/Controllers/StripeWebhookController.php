<?php

namespace App\Http\Controllers;

use App\Mail\BookingMail;
use App\Models\Booking;
use App\Models\Checkout;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Request as UrlRequest;

class StripeWebhookController extends Controller
{
    public function stripePayment(Request $request){
        $currentUrl = UrlRequest::url();
        $segments = explode('/', $currentUrl);
        $apiUrl = end($segments);

        $redirectUrl = route('stripe',['price' => $request->price, 'vehicle_name' => $request->vehicle_name, 'customer_email' => $request->customer_email,'booking_id' => $request->booking_id,'payment_type' => $request->payment_type, 'apiUrl' => $apiUrl]);

        return response()->json(['status' => true, 'redirectUrl' => $redirectUrl]);
    }
    public function stripe(Request $request){
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

        $redirectUrl = route('stripe-checkout') . '?session_id={CHECKOUT_SESSION_ID}';
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
                'payment_type' => $request->payment_type,
                'apiUrl' => $request->apiUrl ?? '',
            ],
        ]);

        return redirect($response['url']);
    }

    public function stripeCheckout(Request $request){
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

        $response = $stripe->checkout->sessions->retrieve($request->session_id);
        $amount_total = number_format($response->amount_total / 100, 2, '.', '');

        $booking = Booking::find($response->metadata->booking_id);
        $booking->status = $response->metadata->payment_type == 1 ? $response->status : "Parcel Paid";
        $booking->save();

        $transaction = new Transaction();
        $transaction->order_id = $response->metadata->booking_id;
        $transaction->transaction_id = $response->id;
        $transaction->amount = $amount_total;
        $transaction->currency = $response->currency;
        $transaction->payment_method = "stripe";
        $transaction->date_time = \Carbon\Carbon::now();
        $transaction->payment_status = $response->metadata->payment_type == 1 ? $response->status : "Parcel Paid";
        $transaction->save();

        $bookingFirst = Booking::where('id', $response->metadata->booking_id)->first();
        $checkout = Checkout::where('booking_id', $bookingFirst->id)->first();

        $remaining_amount = $bookingFirst->total_price;
        $discount = $bookingFirst->total_price * 0.10;
        $remaining_amount -= $discount;

        $data = [
            'name' => $checkout->first_name . ' ' . $checkout->last_name,
            'email' => $response->customer_email,
            'address_first' => $checkout->address_first,
            'address_last' => $checkout->address_last,
            'vehicle_name' => $bookingFirst->name,
            'day_price' => $bookingFirst->Dprice,
            'week_price' => $bookingFirst->wprice,
            'month_price' => $bookingFirst->mprice,
            'total_price' => $bookingFirst->total_price,
            'remaining_amount' => $response->metadata->payment_type == 1 ? $bookingFirst->amount : $remaining_amount,
            'additional_driver' => $bookingFirst->additional_driver,
            'booster_seat' => $bookingFirst->booster_seat,
            'child_seat' => $bookingFirst->child_seat,
            'exit_permit' => $bookingFirst->exit_permit,
            'pickUpLocation' => $bookingFirst->pickUpLocation,
            'dropOffLocation' => $bookingFirst->dropOffLocation,
            'pickUpDate' => $bookingFirst->pickUpDate,
            'pickUpTime' => $bookingFirst->pickUpTime,
            'collectionTime' => $bookingFirst->collectionTime,
            'collectionDate' => $bookingFirst->collectionDate,
            'targetDate' => $bookingFirst->targetDate,
            'status' => $bookingFirst->status,
            // 'order_status' => $booking->order_status,
            // 'payment_status' => $booking->payment_status,
            // 'payment_method' => $booking->payment_method,
        ];

        if ($response->customer_email) {
            Mail::to($response->customer_email)->send(new BookingMail($data));
        }

        if ($response->metadata->apiUrl) {
            return response()->json(['status' => true, 'data' => $data]);
        } else {
            return redirect()->route('thank-you');
        }
    }

    public function stripeCheckoutCancel(Request $request){
        $booking = Booking::where('order_id', $request->session_id)->first();
        $booking->status = $booking->status;
        $booking->payment_status = $booking->payment_status;
        $booking->save();

        return redirect()->route('thank-you');
    }

}
