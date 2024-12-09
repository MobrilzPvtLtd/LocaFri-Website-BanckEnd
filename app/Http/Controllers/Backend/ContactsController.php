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


    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:open,close',
        ]);

        $contact = Contact::findOrFail($id);
        $contact->status = $request->status;
        $contact->save();

        if ($contact->status === 'close') {
            $contact->delete(); // Move to trash
            return redirect()->route('contact.trash')->with('success', __('Contact closed and archived successfully.'));
        }

        return redirect()->route('contact.index')->with('success', __('Contact status updated successfully!'));
    }

    public function viewTrash()
    {
        $trashedContacts = Contact::onlyTrashed()->get();
        return view('backend.contact.trash', compact('trashedContacts'));
    }

    public function restore($id)
    {
    $contact = Contact::onlyTrashed()->findOrFail($id);
    $contact->restore();
    $contact->status = 'open';
    $contact->save();

    return redirect()->route('contact.index')->with('success', __('Contact restored successfully.'));
    }

    public function destroy($id)
    {
        $contact = Contact::onlyTrashed()->findOrFail($id);
        $contact->forceDelete();
        return redirect()->route('contact.trash')->with('success', __('Contact permanently deleted.'));
    }
}
