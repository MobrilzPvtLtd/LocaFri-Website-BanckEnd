<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Mail\SendOtpMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\Vehicle;


class ApiController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            $user = User::create([
                'email' => $request->email,
            ]);
        }
        $otp = mt_rand(100000, 999999);
        $user->otp = $otp;
        $user->save();
        Mail::to($user->email)->send(new SendOtpMail($otp));

        return response()->json([
            'message' => 'Your account register successfully. Please check your email for 6 digit OTP',
        ]);
    }

    public function avalibalcars()
    {
        $activeCars = Vehicle::where('status', 1)->get();

        return response()->json([
            'status' => 'Available Cars',
            'data' => $activeCars
        ]);
    }

    public function cardetails($id)
    {
        $car = Vehicle::find($id);
        if (!$car) {
            return response()->json([
                'status' => 'error',
                'message' => 'Car not found'
            ], 404);
        }
        return response()->json([
            'status' => 'success',
            'data' => $car
        ]);
    }

    public function cars()
    {
        $cars = Vehicle::all();

        return response()->json([
            'status' => 'success',
            'data' => $cars
        ]);
    }
}
