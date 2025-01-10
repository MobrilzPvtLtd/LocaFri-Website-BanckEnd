<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Vehicle;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;



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


    public function thank_you()
    {
        return view('frontend.thank-you');
    }
    public function terms_and_conditions()
    {
        return view('frontend.terms-and-conditions');
    }
    public function privacy()
    {
        return view('frontend.privacy');
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
        // session()->put('pickUpTime', $req->pickUpTime);
        // session()->put('collectionDate', $req->collectionDate);
        // session()->put('collectionTime', $req->collectionTime);

        return redirect()->route('cars');
    }

    public function carsdetailsPost(Request $req)
    {
        session()->put('pickUpLocation', $req->pickUpLocation);
        session()->put('dropOffLocation', $req->dropOffLocation);
        session()->put('pickUpDate', $req->pickUpDate);
        // session()->put('pickUpTime', $req->pickUpTime);
        // session()->put('collectionDate', $req->collectionDate);
        // session()->put('collectionTime', $req->collectionTime);
        $slug = $req->slug;

        // $pickUpLocation = session()->get('pickUpLocation');
        // $dropOffLocation = session()->get('dropOffLocation');
        // $pickUpDate = session()->get('pickUpDate');

        // dd($pickUpLocation,$dropOffLocation,$pickUpDate,$slug);
        return redirect()->route('carsdetails', $slug);
    }
    public function cardetails($slug, Request $req)
    {
        $vehicles = Vehicle::where('slug', $slug)->firstOrFail();
        // $totalPrice = $vehicles->Dprice + $vehicles->wprice + $vehicles->mprice;
        // dd($req);
        return view('frontend.pages.carsdetails', compact('vehicles'));
    }
    /**
     * Privacy Policy Page.
     *
     * @return \Illuminate\Contracts\View\View
     */

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

    public function registerSubmit(Request $request)
{
    $request->validate([
        'first_name' => 'required|string|max:255',
        // 'name' => 'required|string|max:255|unique:users',
        'email' => 'required|email|unique:users',
        'mobile' => 'required|numeric',
        'password' => 'required|min:6|confirmed',
    ]);

    User::create([
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'email' => $request->email,
        'mobile' => $request->mobile,
        'password' => Hash::make($request->password),
    ]);

    return redirect()->route('login')->with('success', 'Registration successful!');
}

public function contact()
    {
        return view('frontend.contact');
    }
    public function reservation(Request $request)
    {
        $params = [
            'name', 'Dprice', 'wprice', 'mprice','pickUpLocation', 'dropOffLocation','pickUpDate','pickUpTime', 'collectionDate', 'collectionTime','targetDate', 'day_count', 'week_count', 'month_count', 'additional_driver', 'booster_seat', 'child_seat', 'exit_permit', 'message', 'total_price'
        ];

        $params = $request->only($params);

        $parsedDates = $this->parseDateRange($params['pickUpDate']);
        // dd($parsedDates);

        $data = array_merge($params, $parsedDates);
        // dd($data);
        // $data = array_map(fn($param) => $request->query($param), array_combine($params, $params));

        return view('frontend.pages.reservation', compact('data'));

    }

    private function parseDateRange($dateRange)
    {
        $startMoments = list($startPart, $endPart) = explode(' - ', $dateRange);
        $dateFormat = 'd/m/y h:i A';

        $startMoment = Carbon::createFromFormat($dateFormat, $startPart);
        $endMoment = Carbon::createFromFormat($dateFormat, $endPart);

        $startDate = $startMoment->format('Y-m-d');
        $endDate = $endMoment->format('Y-m-d');
        $startTime = $startMoment->format('H:i:s');
        $endTime = $endMoment->format('H:i:s');

        return [
            'startDate' => $startDate,
            'endDate' => $endDate,
            'startTime' => $startTime,
            'endTime' => $endTime,
        ];
    }

    public function likeVehicle($vehicleId)
{
    $vehicle = Vehicle::find($vehicleId);
    if ($vehicle) {
        $like = Like::where(['user_id' => Auth::id(), 'vehicle_id' => $vehicleId])->first();
        if ($like) {
            if ($like->like == 1) {
                $like->delete();
            } else {
                $like->like = 1;
                $like->save();
            }
        } else {
            Like::create(['user_id' => Auth::id(), 'vehicle_id' => $vehicleId, 'like' => 1]);
        }
    }

    return redirect()->back();
}

public function dislikeVehicle($vehicleId)
{
    $vehicle = Vehicle::find($vehicleId);
    if ($vehicle) {
        $like = Like::where(['user_id' => Auth::id(), 'vehicle_id' => $vehicleId])->first();
       if ($like) {
            if ($like->like == 0) {
                $like->delete();
            } else {
                $like->like = 0;
                $like->save();
            }
        } else {
            Like::create(['user_id' => Auth::id(), 'vehicle_id' => $vehicleId, 'like' => 0]);
        }
    }

    return redirect()->back();
}

}
