<?php

namespace App\Http\Controllers;

use App\Mail\BookingMail;
use App\Models\Booking;
use App\Models\Checkout;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;
use App\Mail\PaymentReminderMail;


use Illuminate\Support\Facades\Request as UrlRequest;

class StripeWebhookController extends Controller
{
    public function stripePayment(Request $request){
        $currentUrl = UrlRequest::url();
        $segments = explode('/', $currentUrl);
        $apiUrl = end($segments);

        $payment_full = 'payment_full';
        $payment_partial = 'payment_partial';

        if ($request->payment_type != $payment_full && $request->payment_type != $payment_partial) {
            return response()->json(['status' => false, 'error' => 'The provided payment_type is invalid.']);
        }

        $redirectUrl = route('stripe',['price' => $request->price, 'vehicle_name' => $request->vehicle_name, 'customer_email' => $request->customer_email,'booking_id' => $request->booking_id,'payment_type' => $request->payment_type, 'apiUrl' => $apiUrl]);

        return response()->json(['status' => true,'booking_id' => $request->booking_id, 'redirectUrl' => $redirectUrl]);
    }

    public function stripe(Request $request){
        if($request->payment_type == "payment_partial"){
            // $amount = $request->price;
            $amount = $request->price * 0.10;
            // $amount -= $discount;
        }else{
            $amount = $request->price;
        }

        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

        $redirectUrl = route('stripe-checkout') . '?session_id={CHECKOUT_SESSION_ID}';
        $cancelUrl = route('stripe-checkout-cancel') . '?session_id={CHECKOUT_SESSION_ID}';


        $response = $stripe->checkout->sessions->create([
            'success_url' => $redirectUrl,
            'cancel_url' => $cancelUrl,
            'customer_email' => $request->customer_email,
            'payment_method_types' => ['link', 'card', 'twint'],
            'line_items' => [
                [
                    'price_data' => [
                        'product_data' => [
                            'name' => $request->vehicle_name,
                        ],
                        'unit_amount' => 100 * $amount,
                        'currency' => 'CHF',
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

    public function stripeCheckout(Request $request)
    {
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

        $response = $stripe->checkout->sessions->retrieve($request->session_id);

        if ($response->metadata->apiUrl && Transaction::where('transaction_id', $response->id)->exists()) {
            return response()->json(['status' => false, 'error' => "The selected session_id already used."]);
        }

        $booking_old = Booking::where('id', $response->metadata->booking_id)->first();

        if ($booking_old) {
            // this full_payment_paid update for history show in app //
            $tr = Transaction::where('order_id', $booking_old->id)
                ->where('payment_status', '!=', 'payment_full')
                ->latest()
                ->first();

            if ($tr) {
                $tr->full_payment_paid = 1;
                $tr->save();
            }

            $remaining_amount = $booking_old->total_price;
        }

        if ($response->metadata->payment_type == "payment_partial") {
            $remaining_amount -= $booking_old->total_price * 0.10;
        } else {
            $remaining_amount = 0;
        }

        $amount_total = number_format($response->amount_total / 100, 2, '.', '');

        $transaction = new Transaction();
        $transaction->order_id = $response->metadata->booking_id;
        $transaction->transaction_id = $response->id;
        $transaction->amount = $amount_total;
        $transaction->remaining_amount = $remaining_amount;
        $transaction->currency = $response->currency;
        $transaction->payment_method = "stripe";
        $transaction->date_time = \Carbon\Carbon::now();
        $transaction->payment_status = $response->metadata->payment_type == "payment_full" ? "payment_full" : "payment_partial";
        $transaction->payment_paid = $response->status;
        // $transaction->full_payment_paid = $response->metadata->payment_type == "payment_full" ? 1 : 0;
        $transaction->save();

        $booking = Booking::find($response->metadata->booking_id);
        if ($booking) {
            $booking->payment_type = $response->metadata->payment_type == "payment_full" ? "payment_full" : "payment_partial";
            $booking->save();
        }

        $checkout = Checkout::where('booking_id', $transaction->order_id)->first();

        $data = [
            'name' => $checkout->first_name . ' ' . $checkout->last_name,
            'email' => $response->customer_email,
            'address_first' => $checkout->address_first,
            'address_last' => $checkout->address_last,
            'vehicle_name' => $booking->name,
            'day_price' => $booking->Dprice,
            'week_price' => $booking->wprice,
            'month_price' => $booking->mprice,
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
            'strip_payment_status' => $response->status,
            'payment_type' => $booking->payment_type,
            'payment_method' => $transaction->payment_method,
            'payment_status' => $transaction->payment_status,
            'total_price' => $booking->total_price,
            'amount_paid' => $transaction->amount,
            'remaining_amount' => $transaction->remaining_amount,
        ];

        if ($response->customer_email) {
            Mail::to($response->customer_email)->send(new BookingMail($data));
        }

        if ($transaction->remaining_amount > 0) {
            $paymentUrl = route('stripe', [
                'price' => $transaction->remaining_amount,
                'vehicle_name' => $booking->name,
                'customer_email' => $response->customer_email,
                'booking_id' => $response->metadata->booking_id,
                'payment_type' => 'payment_full',
            ]);

            $reminderData = $data + ['payment_url' => $paymentUrl];
            Mail::to($response->customer_email)->send(new PaymentReminderMail($reminderData));
        }

        if ($response->status == 'complete') {
            return redirect()->route('thank-you');
        }

        if ($response->metadata->apiUrl) {
            return response()->json(['status' => true, 'data' => $data]);
        } else {
            return redirect()->route('thank-you');
        }
    }




    public function transactionResponse(Request $request){
        $transaction = Transaction::where('order_id',$request->booking_id)->latest()->first();

        if (!$transaction) {
            return response()->json(['status' => false, 'error' => 'The provided booking_id is invalid.']);
        }

        $booking = Booking::find($transaction->order_id);

        $data = [
            'booking_status' => $booking->status,
            'payment_paid' => $transaction->payment_paid,
            'payment_type' => $booking->payment_type,
            'payment_method' => $transaction->payment_method,
            // 'payment_status' => $transaction->payment_status,
            'total_price' => $booking->total_price,
            'amount_paid' => $transaction->amount,
            'remaining_amount' => $transaction->remaining_amount,
        ];
        // dd($transaction);

        return response()->json(['status' => true, 'data' => $data]);
    }

    public function stripeCheckoutCancel(Request $request){
        $booking = Booking::where('order_id', $request->session_id)->first();
        $booking->status = $booking->status;
        $booking->payment_status = $booking->payment_status;
        $booking->save();

        return redirect()->route('thank-you');
    }
}
