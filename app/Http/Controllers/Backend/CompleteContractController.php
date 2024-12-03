<?php

namespace App\Http\Controllers\Backend;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customercontact;
use App\Models\Booking;
use App\Models\Checkout;
use App\Models\ContractOut;


class CompleteContractController extends Controller
{


    public function index()
    {
       $bookings = Booking::where('is_viewbooking', '!=', 0)
            ->where('is_confirm', '!=', 0)
            ->where('is_complete', '!=', 1)
            ->with(['ContractIn', 'checkout'])
            ->orderBy('created_at', 'desc')
            ->get();
        // dd($bookings);

        return view('backend.completecontract.index', compact('bookings'));
    }


    public function confirmContract(Request $request)
    {
        $booking = Booking::find($request->booking_id);

        if ($request->btnVal == 'complete') {
            $booking->is_complete = 1;
            $booking->status = 'success';
        }else{
            $booking->is_confirm = 1;
        }
        $booking->save();
        return response()->json(['status' => true, $booking]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {



    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
         // Retrieve the booking by its ID with related contract and checkout details
         $booking = Booking::with(['ContractIn', 'checkout','transaction'])->findOrFail($id);

         // Pass the booking data to the view
         return view('backend.completecontract.show', compact('booking'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

    // Retrieve the booking by its ID with related contract and checkout details
    $booking = Booking::with(['ContractIn', 'checkout'])->findOrFail($id);

    // Pass the booking data to the edit view
    return view('backend.completecontract.edit', compact('booking'));
    }

        //


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    // Validate the request
    $request->validate([
        'name' => 'required|string|max:255',
        'total_price' => 'required|numeric',
        'pickUpLocation' => 'required|string|max:255',
        'dropOffLocation' => 'required|string|max:255',
        'status' => 'required|string|max:255', // Adjust as necessary
        // Add validation rules for contract and checkout details as needed
        'checkout_first_name' => 'sometimes|string|max:255',
        'checkout_last_name' => 'sometimes|string|max:255',
        'checkout_email' => 'sometimes|email|max:255',
        // Add other validation rules as necessary
    ]);

    // Retrieve the booking
    $booking = Booking::findOrFail($id);

    // Update the booking details
    $booking->update([
        'name' => $request->input('name'),
        'total_price' => $request->input('total_price'),
        'pickUpLocation' => $request->input('pickUpLocation'),
        'dropOffLocation' => $request->input('dropOffLocation'),
        'status' => $request->input('status'),
    ]);

    // If contract details exist, update them
    if ($booking->contract) {
        $booking->contract->update([
            'postal_code' => $request->input('postal_code'),
            'email' => $request->input('email'),
            'license_photo' => $request->file('license_photo') ? $request->file('license_photo')->store('licenses') : $booking->contract->license_photo,
            'record_kilometers' => $request->input('record_kilometers'),
            'fuel_level' => $request->input('fuel_level'),
            'vehicle_damage_comments' => $request->input('vehicle_damage_comments'),
            'customer_signature' => $request->file('customer_signature') ? $request->file('customer_signature')->store('signatures') : $booking->contract->customer_signature,
        ]);
    }

    // If checkout details exist, update them
    if ($booking->checkout) {
        $booking->checkout->update([
            'first_name' => $request->input('checkout_first_name'),
            'last_name' => $request->input('checkout_last_name'),
            'email' => $request->input('checkout_email'),
            'address_first' => $request->input('checkout_address_first'),
            'address_last' => $request->input('checkout_address_last'),
        ]);
    }

    // Redirect back to the index page with success message
    return redirect()->route('completecontract.index')->with('success', 'Booking details updated successfully.');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

}
