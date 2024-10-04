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
use Illuminate\Support\Facades\URL;
use Carbon\Carbon;
use App\Models\Booking;
use App\Models\BookingEntry;
use App\Models\Checkout;
use App\Models\Contract;
use Illuminate\Support\Facades\Log;
use App\Mail\ContractCreatedMail; 
use App\Models\CreateContract;




class ApiController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|email|max:150',
            'password' => 'sometimes|required|min:8|confirmed',
            'mobile' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();
        if ($user) {
            return response()->json(['status' => false, 'message' => 'Provided email has already been taken']);
        }

        $otp = mt_rand(100000, 999999);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->mobile = $request->mobile;
        $user->otp = $otp;
        $user->save();

        Mail::to($user->email)->send(new SendOtpMail($otp));

        return response()->json([
            'message' => 'Your account register successfully. Please check your email for 6 digit OTP',
        ]);
    }

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
            'message' => 'Your OTP has been sent for login. Please check your email for the 6-digit code.',
        ]);
    }
    public function resendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['message' => 'User not found.'], 404);
        }

        $otp = mt_rand(100000, 999999);
        $user->otp = $otp;
        $user->otp = Carbon::now();
        $user->save();

        Mail::to($user->email)->send(new SendOtpMail($otp));

        return response()->json([
            'message' => 'A new OTP has been sent to your email.',
        ]);
    }


    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['message' => 'User not found.'], 404);
        }

        if ($user->otp != $request->otp) {
            return response()->json(['message' => 'Invalid OTP.'], 401);
        }

        $otpExpiryTime = Carbon::parse($user->otp_generated_at)->addSeconds(30);
        if (Carbon::now()->greaterThan($otpExpiryTime)) {

            $otp = mt_rand(100000, 999999);

            $user->otp = $otp;
            $user->otp_generated_at = Carbon::now();
            $user->save();


            Mail::to($user->email)->send(new SendOtpMail($otp));

            return response()->json([
                'message' => 'OTP has expired. New OTP has been sent to your email.',
            ]);
        }

        $user->otp = null;
        $user->verified = 1;
        $user->save();

        Auth::login($user);
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => true,
            'message' => 'Logged in successfully',
            // 'user' => $user,
            'token' => $token
        ]);
    }

    public function avalibalcars(Request $request)
    {
        $request->validate([
            'available' => 'required|date_format:Y-m-d H:i:s',
        ]);

        $availableDateTime = Carbon::parse($request->available)->toDateTimeString();

        $activeCars = Vehicle::where('status', 1)
            ->where('available', $availableDateTime)
            ->get();

        if ($activeCars->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'No cars found for the given datetime',
                'datetime' => $availableDateTime
            ]);
        }

        return response()->json([
            'status' => 'Available Cars',
            'data' => $activeCars
        ]);
    }

    public function cardetails($id)
    {
        $vehicle = Vehicle::find($id);

        if (!$vehicle) {
            return response()->json([
                'status' => 'error',
                'message' => 'Car not found'
            ], 404);
        }

        $profile = null;
        $images = [];
        $imageUrls = [];

        if ($vehicle->image) {
            $images = json_decode($vehicle->image, true);
        }

        if (!empty($images)) {
            foreach ($images as $image) {
                $imageUrls[] = asset('public/storage/' . $image);
            }
            $profile = $imageUrls[0]; 
        }

        $features = json_decode($vehicle->features, true);

        $data = [
            'id' => $vehicle->id,
            'name' => $vehicle->name,
            'model' => $vehicle->modal,
            'type' => $vehicle->type,
            'desc' => $vehicle->desc,
            'location' => $vehicle->location,
            'mitter' => $vehicle->mitter,
            'profile' => $profile,
            'images' => $imageUrls, // Add all image URLs
            'body' => $vehicle->body,
            'seat' => $vehicle->seat,
            'door' => $vehicle->door,
            'luggage' => $vehicle->luggage,
            'fuel' => $vehicle->fuel,
            'auth' => $vehicle->auth,
            'trans' => $vehicle->trans,
            'exterior' => $vehicle->exterior,
            'interior' => $vehicle->interior,
            'featured' => $vehicle->featured,
            'features' => $features,
            'slug' => $vehicle->slug,
            'Dprice' => $vehicle->Dprice,
            'wprice' => $vehicle->wprice,
            'mprice' => $vehicle->mprice,
            'available_time' => $vehicle->available_time,
            'status' => $vehicle->status,
            'ratings' => $vehicle->ratings,//added for ratings
            'created_at' => $vehicle->created_at,
            'updated_at' => $vehicle->updated_at,
        ];

        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }

    public function cars()
    {
        try {
            $vehicles = Vehicle::get();

            $vehicleData = [];

            foreach ($vehicles as $vehicle) {
                $profile = null;
                $images = [];
                $imageUrls = [];

                if ($vehicle->image) {
                    $images = json_decode($vehicle->image, true);
                }

                if (!empty($images)) {
                    foreach ($images as $image) {
                        $imageUrls[] = asset('public/storage/' . $image);
                    }
                    $profile = $imageUrls[0]; // Use the first image as the profile image
                }

                $features = json_decode($vehicle->features, true);

                $data = [
                    'id' => $vehicle->id,
                    'name' => $vehicle->name,
                    'model' => $vehicle->modal,
                    'type' => $vehicle->type,
                    'desc' => $vehicle->desc,
                    'location' => $vehicle->location,
                    'mitter' => $vehicle->mitter,
                    'profile' => $profile,
                    'images' => $imageUrls, // Add all image URLs
                    'body' => $vehicle->body,
                    'seat' => $vehicle->seat,
                    'door' => $vehicle->door,
                    'luggage' => $vehicle->luggage,
                    'fuel' => $vehicle->fuel,
                    'auth' => $vehicle->auth,
                    'trans' => $vehicle->trans,
                    'exterior' => $vehicle->exterior,
                    'interior' => $vehicle->interior,
                    'featured' => $vehicle->featured,
                    'features' => $features, // Add features array instead of JSON string
                    'slug' => $vehicle->slug,
                    'Dprice' => $vehicle->Dprice,
                    'wprice' => $vehicle->wprice,
                    'mprice' => $vehicle->mprice,
                    'available_time' => $vehicle->available_time,
                    'status' => $vehicle->status,
                    'ratings' => $vehicle->ratings,//added
                    'created_at' => $vehicle->created_at,
                    'updated_at' => $vehicle->updated_at,
                ];

                $vehicleData[] = $data;
            }

            return response()->json([
                'status' => 'success',
                'data' => $vehicleData,
            ]);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function acceptBooking(Request $request)
    {
        // Retrieve the booking ID from the request
        $bookingId = $request->input('booking_id');

        // Find the booking with the associated user
        $booking = Booking::with('user')->find($bookingId);

        if ($booking) {
            // Retrieve the associated user
            $user = $booking->user;

            $checkout = Checkout::where('booking_id', $booking->id)
                ->where('booking_id', $booking->id)
                ->first();

            if ($checkout) {
                // Fetch the first name, last name, and email from the matching Checkout entry
                $firstName = $checkout->first_name;
                $lastName = $checkout->last_name;
                $email = $checkout->email;

                return response()->json([
                    'status' => true,
                    'message' => 'Booking accepted',
                    'first_name' => $firstName,
                    'last_name' => $lastName,
                    'email' => $email, // This will use the email from the Checkout entry
                ]);
            } else {
                return response()->json(['status' => false, 'message' => 'No matching Checkout entry found'], 404);
            }
        } else {
            return response()->json(['status' => false, 'message' => 'Booking not found'], 404);
        }
    }

    public function contract(Request $request)
    {
        try {
        $bookings = Booking::where('is_viewbooking', '!=', 0)->get();
         $booking = Booking::where('id', $request->booking_id)->first();
            if ($booking) {
                $booking->is_contract = 1;
                $booking->save();

                return response()->json($booking);
            }
            return response()->json([
                'status' => 'success',
                'contract' => $bookings
            ], 200);
        } catch (\Exception $e) {
            Log::error('Error fetching bookings: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to fetch bookings.'
            ], 500);
        }
    }


public function create_contract(Request $request)
{
    try {
        $totalPrice = 0;
        $totalPriceDay = $request->Dprice * $request->day_count;
        $totalPriceWeek = $request->wprice * $request->week_count;
        $totalPriceMonth = $request->mprice * $request->month_count;
        $totalPrice = $totalPriceDay + $totalPriceWeek + $totalPriceMonth;
        $totalPrice += $request->additional_driver ?? 0;
        $totalPrice += $request->booster_seat ?? 0;
        $totalPrice += $request->child_seat ?? 0;
        $totalPrice += $request->exit_permit ?? 0;
        
        $booking = new Booking();
        $booking->name = $request->vehicle_name;
        $booking->Dprice = $request->Dprice ?? '0.00';
        $booking->wprice = $request->wprice ?? '0.00';
        $booking->mprice = $request->mprice ?? '0.00';
        $booking->day_count = $request->day_count;
        $booking->week_count = $request->week_count;
        $booking->month_count = $request->month_count;
        $booking->additional_driver = $request->additional_driver ?? '0.00';
        $booking->booster_seat = $request->booster_seat ?? '0.00';
        $booking->child_seat = $request->child_seat ?? '0.00';
        $booking->exit_permit = $request->exit_permit ?? '0.00';
        $booking->total_price = $totalPrice;
        $booking->targetDate = $request->targetDate;
        $booking->pickUpLocation = $request->pickUpLocation;
        $booking->dropOffLocation = $request->dropOffLocation;
        $booking->pickUpDate = \Carbon\Carbon::parse($request->startDate);
        $booking->pickUpTime = $request->startTime;
        $booking->collectionDate = \Carbon\Carbon::parse($request->endDate);
        $booking->collectionTime = $request->endTime;
        $booking->payment_type = $request->payment_type;
        $booking->save();

        
        $checkout = new Checkout();
        $checkout->booking_id = $booking->id;
        $checkout->first_name = $request->first_name ?? null;
        $checkout->last_name = $request->last_name ?? null;
        $checkout->email = $request->email ?? null;
        $checkout->phone = $request->phone ?? null;
        $checkout->address_first = $request->address_first ?? null;
        $checkout->address_last = $request->address_last ?? null;
        $checkout->save();
     
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
            'status' => true,
            'message' => 'Contract and Checkout created successfully! OTP sent to email.',
            // 'booking_data' => $booking,
            // 'checkout_data' => $checkout,
        ], 201);

    } catch (\Illuminate\Validation\ValidationException $e) {
        return response()->json([
            'message' => 'Validation failed.',
            'errors' => $e->errors(),
        ], 422);
    } catch (\Exception $e) {
        return response()->json([
            'message' => 'An error occurred while processing your request.',
            'error' => $e->getMessage(),
        ], 500);
    }
}


  public function checkin(Request $request)
    {
        try {
               $validated = $request->validate([
                'name' => 'nullable|string|max:255',
                'address' => 'nullable|string|max:255', 
                'postal_code' => 'nullable|string|max:10', 
                'email' => 'nullable|email',
                'license_photo' => 'nullable|file|mimes:jpeg,png,jpg',
                'record_kilometers' => 'nullable|string',
                'fuel_level' => 'nullable|string', 
                'vehicle_images' => 'nullable|array', 
                'vehicle_images.*' => 'file|mimes:jpeg,png,jpg', 
                'vehicle_damage_comments' => 'nullable|string', 
                'customer_signature' => 'nullable|file|mimes:jpeg,png,jpg'
            ]);
    
            
            $licensePhotoPath = isset($validated['license_photo'])
                ? $request->file('license_photo')->store('license_photos', 'public')
                : null;
    
            
            $vehicleImagePaths = [];
            if (isset($validated['vehicle_images'])) {
                foreach ($validated['vehicle_images'] as $image) {
                    $vehicleImagePaths[] = $image->store('vehicle_images', 'public');
                }
            }
    
            
            $customerSignaturePath = isset($validated['customer_signature'])
                ? $request->file('customer_signature')->store('signatures', 'public')
                : null;
    
            
            $vehicleInspection = Contract::create([
                'name' => $validated['name'],
                'address' => $validated['address'],
                'postal_code' => $validated['postal_code'],
                'email' => $validated['email'],
                'license_photo' => $licensePhotoPath,
                'record_kilometers' => $validated['record_kilometers'],
                'fuel_level' => $validated['fuel_level'],
                'vehicle_images' => json_encode($vehicleImagePaths),
                'vehicle_damage_comments' => $validated['vehicle_damage_comments'],
                'customer_signature' => $customerSignaturePath
            ]);
            
         Mail::to($validated['email'])->send(new ContractCreatedMail($vehicleInspection));

    
            
            return response()->json([
                'message' => 'Contract created successfully!',
                'data' => $vehicleInspection
            ], 201);
    
        } catch (\Illuminate\Validation\ValidationException $e) {
           
            return response()->json([
                'message' => 'Validation failed.',
                'errors' => $e->errors()
            ], 422);
    
        } catch (\Exception $e) {
           
            return response()->json([
                'message' => 'An error occurred while processing your request.',
                'error' => $e->getMessage()
            ], 500);
        }
    }


}