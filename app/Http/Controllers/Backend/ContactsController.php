<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Booking;

class ContactsController extends Controller
{
        public function index(){
        $contacts = Contact::all();
        return view('backend.contact.massage',compact('contacts'));
    }

    public function is_view(){
        $contacts = Contact::all();
        foreach($contacts as $contact){
            $contact->is_view = 1;
            $contact->save();
        }
        return response()->json($contact);
    }

    public function is_viewbooking(){
        $bookings = Booking::all();
        foreach($bookings as $booking){
            $booking->is_viewbooking = 1;
            $booking->save();
        }
        return response()->json($booking);
    }

}
