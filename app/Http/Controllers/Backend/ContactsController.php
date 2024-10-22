<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Alert;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Booking;

class ContactsController extends Controller
{
        public function index(){
        $contacts = Contact::all();
        return view('backend.contact.massage',compact('contacts'));
    }

    public function is_view(Request $request){
        if($request->alertSeen == 'alert'){
            $alert = [];
            $alerts = Alert::get();
            foreach($alerts as $alert){
                $alert->seen = 1;
                $alert->save();
            }
            return response()->json($alert);
        }else{
            $contact = [];
            $contacts = Contact::all();
            foreach($contacts as $contact){
                $contact->is_view = 1;
                $contact->save();
            }
            return response()->json($contact);
        }
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
