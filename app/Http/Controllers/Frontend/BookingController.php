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
        // Validate request data
        $request->validate([
            'name' => 'required',
            'Dprice' => 'required',
            'wprice' => 'required',
            'mprice' => 'required',
            'day_count' => 'required',
            'week_count' => 'required',
            'month_count' => 'required',
            'additional_driver' => 'nullable',
            'booster_seat' => 'nullable',
            'child_seat' => 'nullable',
            'exit_permit' => 'nullable',
            'targetDate' => 'required',
            'pickUpLocation' => 'required',
            'dropOffLocation' => 'required',
            'pickUpDate' => 'required',
            'pickUpTime' => 'required',
            'collectionDate' => 'required',
            'collectionTime' => 'required',
        ]);
    
        // Calculate total price
        $totalPrice = $request->Dprice + $request->wprice + $request->mprice;
    
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
    
        // Debug log to check values
        \Log::info('Booking data:', $request->all());
    
        // Create new booking
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
    
        return redirect()->route('reservation')->with('success', 'Booking Successfully');
    }
    
}
