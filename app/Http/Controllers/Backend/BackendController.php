<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use App\Models\Booking;
use App\Models\Contact;
use App\Models\Checkout;

class BackendController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $vehicles = Vehicle::all()->count();
        $bookings = Booking::all()->count();
        $contacts = contact::all()->count();
        $acceptedBookingsCount = Booking::where('is_viewbooking', '!=', 0)->count();
        $rejectedBookings = Booking::where('is_rejected', '!=', 0)->count();
        $contracts = Booking::where('is_contract', '!=', 0)->count();
        return view('backend.index',compact('vehicles','bookings','contacts', 'acceptedBookingsCount','rejectedBookings','contracts'));
    }
}
