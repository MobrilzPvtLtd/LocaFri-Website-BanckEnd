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
        $booking = new Booking();
        $booking->name = $request->input('name');
        $booking->Dprice = $request->Dprice;
        $booking->wprice = $request->wprice;
        $booking->mprice = $request->mprice;
        $booking->pickUpLocation = session()->get('pickUpLocation');
        $booking->dropOffLocation = session()->get('dropOffLocation');
        $booking->pickUpDate = session()->get('pickUpDate');
        $booking->pickUpTime = session()->get('pickUpTime');
        $booking->collectionDate = session()->get('collectionDate');
        $booking->collectionTime = session()->get('collectionTime');
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
