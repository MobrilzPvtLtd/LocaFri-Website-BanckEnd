<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\EnquiryMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;

class BookingController extends Controller
{
    public function booking(Request $request)
    {
        $totalPrice = $request->Dprice+$request->wprice+$request->mprice;

        $additional_driver = $request->additional_driver ?? 0;
        $booster_seat = $request->booster_seat ?? 0;
        $child_seat = $request->child_seat ?? 0;
        $exit_permit = $request->exit_permit ?? 0;

        if ($request->targetDate == 'day') {
            $totalPrice += $request->Dprice * $request->day_count;
        } else if ($request->targetDate == 'week') {
            $totalPrice += $request->wprice * $request->week_count;
        } else if ($request->targetDate == 'month') {
            $totalPrice += $request->mprice * $request->month_count;
        }

        // Add optional charges
        $totalPrice += $additional_driver + $booster_seat + $child_seat + $exit_permit;

        $booking = new Booking();
        $booking->name = $request->name;
        $booking->Dprice = $request->Dprice;
        $booking->wprice = $request->wprice;
        $booking->mprice = $request->mprice;
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
        $booking->pickUpDate = $request->pickUpDate;
        $booking->pickUpTime = $request->pickUpTime;
        $booking->collectionDate = $request->collectionDate;
        $booking->collectionTime = $request->collectionTime;
        $booking->save();

        // if (Auth::check()) {
        //     $userEmail = Auth::user()->email;
        // } else {
        //     return redirect()->back()->with('error', 'User is not authenticated.');
        // }

        // Send the email
        // Mail::to($userEmail)->send(new EnquiryMail($booking));
        return redirect()->back()->with('success', 'Booking Successfully');
    }
}
