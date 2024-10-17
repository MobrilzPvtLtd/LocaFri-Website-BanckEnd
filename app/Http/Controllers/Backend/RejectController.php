<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;

class RejectController extends Controller
{
    public function index()
    {
        $bookings = Booking::where('is_rejected', '!=', 0)->get();
        return view('backend.reject.index',compact('bookings'));
    }
    public function addBack($id)
    {
        // Find the booking by its ID
        $booking = Booking::findOrFail($id);

        // Set is_rejected to 0, indicating it's no longer rejected
        $booking->is_rejected = 0;

        // Save the updated booking
        $booking->save();

        // Redirect to the Reservation index with a success message
        return redirect()->route('reservation.index')->with('success', 'Booking has been successfully added back to the reservation list.');
    }


    // public function show()
    // {
    //     // $bookings = Booking::where('is_rejected', '!=', 0)->get();
    //     return view('backend.reject.view');
    // }



    public function show($id)
   {
    // Retrieve the booking details by its ID
    $booking = Booking::findOrFail($id);

    // Pass the booking details to the view
    return view('backend.reject.view', compact('booking'));

    }

    // public function addBack($id)
    // {
    //     // Find the booking by its ID
    //     $booking = Booking::findOrFail($id);

    //     // Set is_rejected to 0, indicating it's no longer rejected
    //     $booking->is_rejected = 0;

    //     // Save the updated booking
    //     $booking->save();

    //     // Redirect to the Reservation index with a success message
    //     return redirect()->route('reservation.index')->with('success', 'Booking has been successfully added back to the reservation list.');
    // }




}
