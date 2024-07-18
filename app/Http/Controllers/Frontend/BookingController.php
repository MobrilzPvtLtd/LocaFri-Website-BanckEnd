<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\EnquiryMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;
use App\Models\Checkout;

class BookingController extends Controller
{
    public function bookingCheckout(Request $request){
        // dd($request);

        // $totalPrice = $request->Dprice + $request->wprice + $request->mprice;
        $totalPrice = $request->price;

        $additional_driver = $request->additional_driver ?? 0;
        $booster_seat = $request->booster_seat ?? 0;
        $child_seat = $request->child_seat ?? 0;
        $exit_permit = $request->exit_permit ?? 0;

        if ($request->targetDate == 'day') {
            $totalPrice += $request->Dprice * $request->day_count;
            $Dprice = $request->price;
        } else if ($request->targetDate == 'week') {
            $totalPrice += $request->wprice * $request->week_count;
            $wprice = $request->price;
        } else if ($request->targetDate == 'month') {
            $totalPrice += $request->mprice * $request->month_count;
            $mprice = $request->price;
        }

        // Add optional charges
        $totalPrice += $additional_driver + $booster_seat + $child_seat + $exit_permit;

        // Debug log to check values
        \Log::info('Booking data:', $request->all());

        // Create new booking
        $booking = new Booking();
        $booking->name = $request->name;
        $booking->Dprice = $Dprice ?? '0.00';
        $booking->wprice = $wprice ?? '0.00';
        $booking->mprice = $mprice ?? '0.00';
        $booking->day_count = $request->day_count;
        $booking->week_count = $request->week_count;
        $booking->month_count = $request->month_count;
        $booking->additional_driver = $request->additional_driver;
        $booking->booster_seat = $request->booster_seat;
        $booking->child_seat = $request->child_seat;
        $booking->exit_permit = $request->exit_permit;
        $booking->total_price = $totalPrice;
        $booking->targetDate = $request->targetDate;
        $booking->pickUpLocation = $request->pickUpLocation;
        $booking->dropOffLocation = $request->dropOffLocation;
        $booking->pickUpDate = \Carbon\Carbon::parse($request->pickUpDate);
        $booking->pickUpTime = $request->pickUpTime;
        $booking->collectionDate = \Carbon\Carbon::parse($request->collectionDate);
        $booking->collectionTime = $request->collectionTime;
        $booking->save();

        $checkout = new Checkout();
        $checkout->first_name = $request->first_name;
        $checkout->last_name = $request->last_name;
        $checkout->email = $request->email;
        $checkout->address_first = $request->address_first;
        $checkout->address_last = $request->address_last;
        $checkout->save();

        return redirect()->route('reservation')->with('success', 'Booking Successfully');
    }

}
