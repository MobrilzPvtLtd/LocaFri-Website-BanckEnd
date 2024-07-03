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

        return view('frontend.index', compact('vehicles'));
    }

    public function cars()
    {
        // $pickUpLocation = session()->get('pickUpLocation');
        // $dropOffLocation = session()->get('dropOffLocation');
        // $pickUpDate = session()->get('pickUpDate');
        // $pickUpTime = session()->get('pickUpTime');
        // $collectionDate = session()->get('collectionDate');
        // $collectionTime = session()->get('collectionTime');

        // dd($pickUpLocation,$dropOffLocation,$pickUpDate,$pickUpTime,$collectionDate,$collectionTime);

        $vehicles = Vehicle::orderBy('id', 'desc')->paginate(6);
        return view('frontend.cars', compact('vehicles'));
    }

    public function carsPost(Request $req){
        session()->put('pickUpLocation', $req->pickUpLocation);
        session()->put('dropOffLocation', $req->dropOffLocation);
        session()->put('pickUpDate', $req->pickUpDate);
        session()->put('pickUpTime', $req->pickUpTime);
        session()->put('collectionDate', $req->collectionDate);
        session()->put('collectionTime', $req->collectionTime);

        return redirect()->route('cars');
    }

    public function carsdetailsPost(Request $req ){
        session()->put('pickUpLocation', $req->pickUpLocation);
        session()->put('dropOffLocation', $req->dropOffLocation);
        session()->put('pickUpDate', $req->pickUpDate);
        session()->put('pickUpTime', $req->pickUpTime);
        session()->put('collectionDate', $req->collectionDate);
        session()->put('collectionTime', $req->collectionTime);
        $slug = $req->slug;

        // $pickUpLocation = session()->get('pickUpLocation');
        // $dropOffLocation = session()->get('dropOffLocation');
        // $pickUpDate = session()->get('pickUpDate');
        // $pickUpTime = session()->get('pickUpTime');
        // $collectionDate = session()->get('collectionDate');
        // $collectionTime = session()->get('collectionTime');

        // dd($pickUpLocation,$dropOffLocation,$pickUpDate,$pickUpTime,$collectionDate,$collectionTime,$slug);
        return redirect()->route('carsdetails',$slug);
    }
    public function cardetails($slug, Request $req)
    {
        $vehicles = Vehicle::where('slug', $slug)->firstOrFail();
        // dd($vehicles);
        return view('frontend.pages.carsdetails', compact('vehicles'));
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
    public function login()
    {
        return view('frontend.pages.login');
    }
    public function register()
    {
        return view('frontend.pages.register');
    }
    public function contact()
    {

        return view('frontend.contact');
    }
    public function reservation()
    {
        return view('frontend.pages.reservation');
    }
}
