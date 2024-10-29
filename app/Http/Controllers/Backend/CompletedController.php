<?php

namespace App\Http\Controllers\Backend;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customercontact;
use App\Models\Booking;
use App\Models\Checkout;
use App\Models\ContractOut;


class CompletedController extends Controller
{
public function index()
{
    $bookings = Booking::with(['ContractOut', 'checkout', 'ContractIn'])
            ->where('is_complete', 1)
            ->orderBy('created_at', 'desc')
            ->get();

    return view('backend.completedcontract.index', compact('bookings'));
}


public function show($id)
{
    $booking = Booking::with(['ContractOut', 'checkout', 'ContractIn'])
                      ->findOrFail($id);
     return view('backend.completedcontract.view', compact('booking'));
}


















}
