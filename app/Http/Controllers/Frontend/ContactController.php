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

        $admin = User::where('id', 1)->first();

        // Send email
        Mail::to($contact->email)->send(new ContactMail($contact));
        Mail::to($admin->email)->send(new ContactMail($contact));

        return redirect()->back()->with('success', 'Message sent successfully!');
    }
}
