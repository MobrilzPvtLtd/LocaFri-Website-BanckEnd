<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vehicle;

class FrontendController extends Controller
{
    /**
     * Retrieves the view for the index page of the frontend.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $vehicles = Vehicle::where('featured', true)->get();
        // $vehicles = Vehicle::all();
        return view('frontend.index',compact('vehicles'));
    }

    /**
     * Privacy Policy Page.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function privacy()
    {
        return view('frontend.privacy');
    }

    /**
     * Terms & Conditions Page.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function terms()
    {
        return view('frontend.terms');
    }

    public function cars(){
        // $vehicles = Vehicle::all();
        $vehicles = Vehicle::orderBy('id', 'desc')->paginate(6);
        return view('frontend.cars',compact('vehicles'));
    }
}

