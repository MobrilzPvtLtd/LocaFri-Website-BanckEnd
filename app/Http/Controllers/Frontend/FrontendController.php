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

        $vehicles = Vehicle::orderBy('id', 'desc')->paginate(6);
        return view('frontend.cars', compact('vehicles'));
    }

    public function carsPost(Request $req)
    {
        session()->put('pickUpLocation', $req->pickUpLocation);
        session()->put('dropOffLocation', $req->dropOffLocation);
        session()->put('pickUpDate', $req->pickUpDate);
        session()->put('pickUpTime', $req->pickUpTime);
        session()->put('collectionDate', $req->collectionDate);
        session()->put('collectionTime', $req->collectionTime);

        return redirect()->route('cars');
    }

    public function carsdetailsPost(Request $req)
    {
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
        return redirect()->route('carsdetails', $slug);
    }
    public function cardetails($slug, Request $req)
    {
        $vehicles = Vehicle::where('slug', $slug)->firstOrFail();
        $totalPrice = $vehicles->Dprice + $vehicles->wprice + $vehicles->mprice;
        // dd($totalPrice);
        return view('frontend.pages.carsdetails', compact('vehicles', 'totalPrice'));
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
    public function reservation(Request $request)
    {
        // dd($request);
        $name = $request->query('name');
        $Dprice = $request->query('Dprice');
        $wprice = $request->query('wprice');
        $mprice = $request->query('mprice');
        $pickUpDate = $request->query('pickUpDate');
        $collectionDate = $request->query('collectionDate');
        $targetDate = $request->query('targetDate');
        $day_count = $request->query('day_count');
        $week_count = $request->query('week_count');
        $month_count = $request->query('month_count');
        $additional_driver= $request->query('additional_driver');
        $booster_seat= $request->query('booster_seat');
        $child_seat= $request->query('child_seat');
        $exit_permit= $request->query('exit_permit');
        $message = $request->query('message');
        $total_price = $request->query('total_price');
    //    dd($request);
        return view('frontend.pages.reservation', compact('name','Dprice', 'wprice', 'mprice', 'pickUpDate', 'collectionDate', 'day_count', 'week_count', 'month_count', 'additional_driver', 'booster_seat', 'child_seat', 'exit_permit','targetDate', 'message', 'total_price'));
    }
}
