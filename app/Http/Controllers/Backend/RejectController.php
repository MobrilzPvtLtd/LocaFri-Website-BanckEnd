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
}
