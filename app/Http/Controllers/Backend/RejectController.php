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
        
        $booking = Booking::findOrFail($id);
        $booking->is_rejected = 0;
        $booking->save();
        return redirect()->route('reservation.index')->with('success', 'Booking has been successfully added back to the reservation list.');
    }
   public function show($id)
   {
    $booking = Booking::findOrFail($id);
    return view('backend.reject.view', compact('booking'));

    }

    public function destroy($id)
{
    $booking = Booking::findOrFail($id);
    $booking->delete();
    return redirect()->route('reject.index')->with('success', 'Rejected Booking has been deleted successfully.');
}

    



}
