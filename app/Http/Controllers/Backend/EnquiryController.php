<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EnquiryController extends Controller
{
    public function index(){
        // $contacts = Contact::all();
        return view('backend.enquiry.index');
    }
}
