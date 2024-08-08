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
use Stripe\Stripe;
class PaymentController extends Controller
{
    public function stripe(Request $request)
    {
        $request->validate([
            'number' => 'required|numeric',
            'exp_month' => 'required|numeric|min:1|max:12',
            'exp_year' => 'required|numeric',
            'cvc' => 'required|numeric',
            'amount' => 'required|numeric|min:1',
            'description' => 'required|string',
        ]);

        try {
            $stripe = new StripeClient(env('STRIPE_SECRET'));

            $res = $stripe->tokens->create([
                'card' => [
                    'number' => $request->number,
                    'exp_month' => $request->exp_month,
                    'exp_year' => $request->exp_year,
                    'cvc' => $request->cvc,
                ],
            ]);

            Stripe::setApiKey(env('STRIPE_SECRET'));

            $response = $stripe->charges->create([
                'amount' => $request->amount * 100, // Stripe expects the amount in cents
                'currency' => 'usd',
                'source' => $res->id,
                'description' => $request->description,
            ]);

            return response()->json(['status' => $response->status, 'charge_id' => $response->id], 201);
        } catch (CardException $e) {
            return response()->json(['error' => 'Card declined', 'message' => $e->getMessage()], 400);
        } catch (RateLimitException $e) {
            return response()->json(['error' => 'Too many requests', 'message' => $e->getMessage()], 429);
        } catch (InvalidRequestException $e) {
            return response()->json(['error' => 'Invalid request', 'message' => $e->getMessage()], 400);
        } catch (AuthenticationException $e) {
            return response()->json(['error' => 'Authentication error', 'message' => $e->getMessage()], 401);
        } catch (ApiConnectionException $e) {
            return response()->json(['error' => 'Network error', 'message' => $e->getMessage()], 500);
        } catch (ApiErrorException $e) {
            return response()->json(['error' => 'Stripe API error', 'message' => $e->getMessage()], 500);
        } catch (\Exception $e) {
            Log::error('Stripe Payment Error: ' . $e->getMessage());
            return response()->json(['error' => 'Internal server error', 'message' => $e->getMessage()], 500);
        }
    }

    // public function stripeCheckout(Request $request)
    // {
    //     $stripe = new StripeClient(env('STRIPE_SECRET'));

    //     $response = $stripe->checkout->sessions->retrieve($request->session_id);

    //     $amount_total = number_format($response->amount_total / 100, 2, '.', '');

    //     $booking = Booking::find($response->metadata->booking_id);
    //     $booking->status = $response->metadata->payment_type == 1 ? $response->status : "Parcel Paid";
    //     $booking->save();

    //     $transaction = new Transaction();
    //     $transaction->order_id = $response->metadata->booking_id;
    //     $transaction->transaction_id = $response->id;
    //     $transaction->amount = $amount_total;
    //     $transaction->currency = $response->currency;
    //     $transaction->payment_method = "stripe";
    //     $transaction->date_time = Carbon::now();
    //     $transaction->payment_status = $response->metadata->payment_type == 1 ? $response->status : "Parcel Paid";
    //     $transaction->save();

    //     $bookingFirst = Booking::where('id', $response->metadata->booking_id)->first();
    //     $checkout = Checkout::where('booking_id', $bookingFirst->id)->first();

    //     $remaining_amount = $bookingFirst->total_price;
    //     $discount = $bookingFirst->total_price * 0.10;
    //     $remaining_amount -= $discount;

    //     $data = [
    //         'name' => $checkout->first_name . ' ' . $checkout->last_name,
    //         'email' => $response->customer_email,
    //         'address_first' => $checkout->address_first,
    //         'address_last' => $checkout->address_last,
    //         'vehicle_name' => $bookingFirst->name,
    //         'day_price' => $bookingFirst->Dprice,
    //         'week_price' => $bookingFirst->wprice,
    //         'month_price' => $bookingFirst->mprice,
    //         'total_price' => $bookingFirst->total_price,
    //         'remaining_amount' => $response->metadata->payment_type == 1 ? $bookingFirst->amount : $remaining_amount,
    //         'additional_driver' => $bookingFirst->additional_driver,
    //         'booster_seat' => $bookingFirst->booster_seat,
    //         'child_seat' => $bookingFirst->child_seat,
    //         'exit_permit' => $bookingFirst->exit_permit,
    //         'pickUpLocation' => $bookingFirst->pickUpLocation,
    //         'dropOffLocation' => $bookingFirst->dropOffLocation,
    //         'pickUpDate' => $bookingFirst->pickUpDate,
    //         'pickUpTime' => $bookingFirst->pickUpTime,
    //         'collectionTime' => $bookingFirst->collectionTime,
    //         'collectionDate' => $bookingFirst->collectionDate,
    //         'targetDate' => $bookingFirst->targetDate,
    //         'status' => $bookingFirst->status,
    //     ];

    //     if ($response->customer_email) {
    //         Mail::to($response->customer_email)->send(new BookingMail($data));
    //     }

    //     return response()->json(['message' => 'Payment successful and email sent'], 200);
    // }

    // public function stripeCheckoutCancel(Request $request)
    // {
    //     $booking = Booking::where('order_id', $request->session_id)->first();
    //     $booking->status = $booking->status;
    //     $booking->payment_status = $booking->payment_status;
    //     $booking->save();

    //     return response()->json(['message' => 'Payment cancelled'], 200);
    // }
}
