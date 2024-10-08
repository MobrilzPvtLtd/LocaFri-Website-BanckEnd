<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;

class EnquiryController extends Controller
{
    public function index(){
        $bookings = Booking::all();
        return view('backend.enquiry.index',compact('bookings'));
    }

    public function destroy(Booking $booking)
    {
        // dd($booking);
        $booking->delete();
        return redirect()->route('enquiry.index');
    }
}
