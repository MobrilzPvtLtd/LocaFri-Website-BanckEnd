<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;
use App\Models\Contact;
use App\Models\User;

class ContactController extends Controller
{
    public function submit(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        // Save form data to the database
        $contact = new Contact();
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->message = $request->message;
        $contact->save();

        // $admin = User::where('id', 1)->first();

        // // Send email
        // Mail::to($contact->email)->send(new ContactMail($contact));
        // Mail::to($admin->email)->send(new ContactMail($contact));


        $adminEmail = User::where('id', 1)->value('email');
        $infoEmail = 'info@locafri.ch';


    Mail::to($contact->email)->send(new ContactMail($contact));
    Mail::to([$adminEmail, $infoEmail])->send(new ContactMail($contact));

        return redirect()->back()->with('success', 'Message sent successfully!');
    }

    public function update(Request $request, $id)
{
    $contact = Contact::findOrFail($id);
    $contact->status = $request->status; // Update status to 'open' or 'close'
    $contact->save();

    return redirect()->back()->with('success', 'Contact status updated successfully.');
}

// public function trash($id)
// {
//     $contact = Contact::findOrFail($id);
//     $contact->delete(); // Moves to soft delete (trash)
//     return redirect()->route('contacts.trash')->with('success', 'Contact moved to trash.');
// }





}
