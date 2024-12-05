<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;
use App\Models\Checkout;

class BookingController extends Controller
{
    public function bookingCheckout(Request $request){

        $request->validate([
            'first_name' => 'required|string|max:255',
            'email' => 'required|email',
        ], [
            'first_name.required' => 'First name is required.',
            'email.required' => 'Email address is required.',
        ]);
        // dd($request);
        $totalPrice = 0;
        $totalPriceDay = $request->Dprice * $request->day_count;

        $totalPriceWeek = $request->wprice * $request->week_count;

        $totalPriceMonth = $request->mprice * $request->month_count;

        $totalPrice = $totalPriceDay + $totalPriceWeek + $totalPriceMonth;

        // switch ($request->targetDate) {
        //     case 'day':
        //         $Dprice = $request->Dprice;
        //         $totalPrice = $Dprice * $request->day_count;
        //         break;
        //     case 'week':
        //         $wprice = $request->wprice;
        //         $totalPrice = $wprice * $request->week_count;
        //         break;
        //     case 'month':
        //         $mprice = $request->mprice;
        //         $totalPrice = $mprice * $request->month_count;
        //         break;
        // }

        $totalPrice += $request->additional_driver ?? 0;
        $totalPrice += $request->booster_seat ?? 0;
        $totalPrice += $request->child_seat ?? 0;
        $totalPrice += $request->exit_permit ?? 0;

        $booking = new Booking();
        $booking->name = $request->name;
        $booking->Dprice = $request->Dprice ?? '0.00';
        $booking->wprice = $request->wprice ?? '0.00';
        $booking->mprice = $request->mprice ?? '0.00';
        $booking->day_count = $request->day_count;
        $booking->week_count = $request->week_count;
        $booking->month_count = $request->month_count;
        $booking->additional_driver = $request->additional_driver ?? '0.00';
        $booking->booster_seat = $request->booster_seat ?? '0.00';
        $booking->child_seat = $request->child_seat ?? '0.00';
        $booking->exit_permit = $request->exit_permit ?? '0.00';
        $booking->total_price = $totalPrice;
        $booking->targetDate = $request->targetDate;
        $booking->pickUpLocation = $request->pickUpLocation;
        $booking->dropOffLocation = $request->dropOffLocation;
        $booking->pickUpDate = \Carbon\Carbon::parse($request->startDate);
        $booking->pickUpTime = $request->startTime;
        $booking->collectionDate = \Carbon\Carbon::parse($request->endDate);
        $booking->collectionTime = $request->endTime;
        // $booking->order_status = "unpaid";
        $booking->payment_type = $request->payment_type;
        $booking->save();

        $checkout = new Checkout();
        $checkout->booking_id = $booking->id;
        $checkout->first_name = $request->first_name;
        $checkout->last_name = $request->last_name;
        $checkout->email = $request->email;
        $checkout->address_first = $request->address_first;
        $checkout->address_last = $request->address_last;
        $checkout->zipcode = $request->zipcode;
        $checkout->city = $request->city;
        $checkout->save();
        if($request->payment_method == "twint"){
            return redirect()->back();
        }else{
            return redirect()->route('stripe',['price' => $booking->total_price, 'vehicle_name' => $booking->name, 'customer_email' => $checkout->email,'booking_id' => $booking->id,'payment_type' => $booking->payment_type]);
        }

    }

}
