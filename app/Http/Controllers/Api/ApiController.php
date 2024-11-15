<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Mail\SendOtpMail;
use Illuminate\Support\Facades\Mail;
use App\Models\Vehicle;
use Carbon\Carbon;
use App\Models\Booking;
use App\Models\Checkout;
use Illuminate\Support\Facades\Log;
use App\Mail\ContractCreatedMail;
use App\Mail\MakeContract;
use App\Mail\CheckOutMail;
use App\Models\ContractIn;
use App\Models\ContractOut;
use App\Models\Contact;
use App\Mail\ContactMail;


use App\Models\Alert;
use App\Models\Transaction;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;




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

    public function avalibalcars(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // 'location' => 'required',
            'available_time' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'The given data was invalid.',
                "status_code" => 422,
                "errors" => $validator->errors(),
            ], 422);
        }

        $activeCarsQuery = Vehicle::where('status', 1);

        if ($request->location) {
            $activeCarsQuery->where('location', $request->location);
        }

        if ($request->available_time) {
            $availableDateTime = Carbon::parse($request->available_time);

            $formattedAvailableTime = $availableDateTime->format('Y-m-d H:i:s');

            $activeCarsQuery->where('available_time', $formattedAvailableTime);
        }

        $activeCars = $activeCarsQuery->get();

        $vehicleData = [];
        foreach ($activeCars as $vehicle) {

            $images = $vehicle->image ? json_decode($vehicle->image, true) : [];
            $imageUrls = array_map(fn($image) => asset('public/storage/' . $image), $images);
            $profile = !empty($imageUrls) ? $imageUrls[0] : null;

            $features = $vehicle->features ? json_decode($vehicle->features, true) : [];

            $vehicleData[] = [
                'id' => $vehicle->id,
                'name' => $vehicle->name,
                'model' => $vehicle->model,
                'type' => $vehicle->type,
                'desc' => $vehicle->desc,
                'location' => $vehicle->location,
                'mitter' => $vehicle->mitter,
                'profile' => $profile,
                'images' => $imageUrls,
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
                'ratings' => $vehicle->ratings,
                'created_at' => $vehicle->created_at,
                'updated_at' => $vehicle->updated_at,
            ];
        }
        return response()->json([
            'status' => true,
            'data' => $vehicleData
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
            'permitted_kilometers_day' => $vehicle->permitted_kilometers_day,
            'permitted_kilometers_week' => $vehicle->permitted_kilometers_week,
            'permitted_kilometers_month' => $vehicle->permitted_kilometers_month,
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
            $vehicles = Vehicle::where('status', 1)->get();

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
                //mail logic
                $checkout = Checkout::where('booking_id', $booking->id)->first();

                if ($checkout && $checkout->email) {

                    Mail::to($checkout->email)->send(new MakeContract($booking));
                }

                return response()->json(['status' => 'success','booking' => $booking], 200);
            }

            return response()->json(['status' => 'success','contract' => $bookings], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error','message' => $e->getMessage()], 500);
        }
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
            'status' => true,
            'message' => 'Your OTP has been sent for login. Please check your email for the 6-digit OTP.',
        ], 200);
    }

    public function resendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['status' => false,'message' => 'User not found.'], 404);
        }

        $otp = mt_rand(100000, 999999);

        $user->otp = $otp;
        $user->verified = 0;
        $user->save();

        Mail::to($user->email)->send(new SendOtpMail($otp));

        return response()->json([
            'status' => true,
            'message' => 'A new OTP has been sent to your email.',
        ]);
    }

    public function verifyOtp(Request $request)
    {
        $request->validate(['email' => 'required|email', 'otp' => 'required']);

        // Find user by email
        $user = User::where('email', $request->email)->first();

        // Check if the OTP matches
        if ($user->otp !== $request->otp) {
            return response()->json(['status' => false, 'message' => 'Invalid OTP.'], 401);
        }

        if ($user->verified == 1) {
            return response()->json(['status' => false, 'message' => 'OTP has expired. A new OTP has been sent to your email.'], 401);
        }

        $user->update(['otp' => null, 'verified' => 1]);

        // Generate a token
        $token = $user->createToken('auth_token', ['*'])
                      ->plainTextToken;

        // Set the expiration time for the token to 1 day from now
        $expiresAt = Carbon::now()->addDay(1);

        // Return the response with token and expiration time
        return response()->json([
            'status' => true,
            'message' => 'Your email is verified.',
            'token' => $token,
            'expires_at' => $expiresAt->toDateTimeString(),  // Optionally return the expiration time
        ]);
    }


    public function create_contract(Request $request)
    {
    try {
        // Check if the user is authenticated
        if (!Auth::check()) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthenticated. Please login to continue.',
            ], 401);
        }

        $user = Auth::user();

        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'vehicle_name' => 'required|string|max:255',
            'Dprice' => 'required|numeric|min:0',
            'wprice' => 'required|numeric|min:0',
            'mprice' => 'required|numeric|min:0',
            'pickUpLocation' => 'required|string|max:255',
            'dropOffLocation' => 'required|string|max:255',
            'pickUpDate' => 'required|date',
            'pickUpTime' => 'required|string',
            'collectionDate' => 'required|date',
            'collectionTime' => 'required|string',
            'day_count' => 'required|integer|min:0',
            'week_count' => 'required|integer|min:0',
            'month_count' => 'required|integer|min:0',
            'first_name' => 'required|string|max:255',
            'email' => 'required|email|exists:users,email',
        ], [
            'first_name.required' => 'First name is required.',
            'email.required' => 'Email address is required.',
            'email.exists' => 'The selected email does not exist in our records.',
        ]);

        // Handle validation errors
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'The given data was invalid.',
                'status_code' => 422,
                'errors' => $validator->errors(),
            ], 422);
        }

        // Calculate the total price
        $totalPrice = $request->Dprice * $request->day_count +
                      $request->wprice * $request->week_count +
                      $request->mprice * $request->month_count +
                      ($request->additional_driver ?? 0) +
                      ($request->booster_seat ?? 0) +
                      ($request->child_seat ?? 0) +
                      ($request->exit_permit ?? 0);

        // Create the booking
        $booking = Booking::create([
            'name' => $request->vehicle_name,
            'Dprice' => $request->Dprice,
            'wprice' => $request->wprice,
            'mprice' => $request->mprice,
            'day_count' => $request->day_count,
            'week_count' => $request->week_count,
            'month_count' => $request->month_count,
            'additional_driver' => $request->additional_driver ?? 0,
            'booster_seat' => $request->booster_seat ?? 0,
            'child_seat' => $request->child_seat ?? 0,
            'exit_permit' => $request->exit_permit ?? 0,
            'total_price' => $totalPrice,
            'pickUpLocation' => $request->pickUpLocation,
            'dropOffLocation' => $request->dropOffLocation,
            'pickUpDate' => Carbon::parse($request->pickUpDate),
            'pickUpTime' => $request->pickUpTime,
            'collectionDate' => Carbon::parse($request->collectionDate),
            'collectionTime' => $request->collectionTime,
            'payment_type' => $request->payment_type,
        ]);

        // Create the checkout
        $checkout = Checkout::create([
            'booking_id' => $booking->id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address_first' => $request->address_first,
            'address_last' => $request->address_last,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Contract created successfully.',
            'price' => $booking->total_price,
            'vehicle_name' => $booking->name,
            'customer_email' => $checkout->email,
            'booking_id' => $booking->id,
            'payment_type' => $booking->payment_type,
        ], 201);

    } catch (\Illuminate\Auth\AuthenticationException $e) {
        // Handle unauthenticated access
        return response()->json([
            'status' => false,
            'message' => 'You are not authenticated. Please login and try again.',
        ], 401);
    } catch (\Exception $e) {
        // Handle any other exceptions
        return response()->json([
            'status' => false,
            'message' => 'An error occurred while creating the contract.',
            'error' => env('APP_DEBUG') ? $e->getMessage() : 'Please contact support.', // Hide detailed errors in production
        ], 500);
    }
    }


  public function logout(Request $request)
    {
        // Get the authenticated user
        $user = $request->user();

        // Revoke the token that was used to authenticate the current request
        $user->currentAccessToken()->delete();

        // Set 'verified' to 0
        $user->update(['verified' => 0]);

        return response()->json([
            'status' => true,
            'message' => 'Logout successful. Your token has been invalidated, and verified status has been reset.',
        ], 200);
    }
   public function updateProfile(Request $request)
   {
    // Get the authenticated user
    $user = $request->user();

    // Validate the request input
    $request->validate([
        'first_name' => 'string|max:255|nullable',
        'last_name' => 'string|max:255|nullable',
        'email' => 'email|unique:users,email,' . $user->id . '|nullable',
        'mobile' => 'string|max:15|nullable|unique:users,mobile,' . $user->id,
        'password' => 'string|min:8|nullable', // Password is optional and only validated if provided
    ], [
        'email.unique' => 'The email address is already taken.',
        'password.min' => 'The password must be at least 8 characters.', // Only shows if password is provided
        'mobile.unique' => 'The mobile number is already taken.',
    ]);

    // Prepare data to update
    $data = $request->only('first_name', 'last_name', 'email', 'mobile');

    // If password is provided, hash it before updating
    if ($request->filled('password')) {
        $data['password'] = bcrypt($request->password);
    }

    // Update user profile
    $user->update($data);

    // Return response
    return response()->json([
        'status' => true,
        'message' => 'Profile updated successfully.',
        'user' => $user,
    ], 200);
   }


    public function checkin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'license_photo' => 'nullable|file|mimes:jpeg,png,jpg|max:2048',
            'record_kilometers' => 'required|integer',
            'fuel_level' => 'nullable|string',
            'vehicle_images' => 'nullable|array',
            'vehicle_images.*' => 'file|mimes:jpeg,png,jpg|max:2048',
            'vehicle_damage_comments' => 'nullable|string',
            'customer_signature' => 'nullable|file|mimes:jpeg,png,jpg|max:2048',
            'fuel_image' => 'nullable|file|mimes:jpeg,png,jpg|max:2048',

            'name' => 'required|string|max:255',
            'email' => 'required|email|exists:checkouts,email',
        ], [
            'name.required' => 'First name is required.',
            'email.required' => 'Email address is required.',
            'email.exists' => 'The selected email does not exist in our records.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'The given data was invalid.',
                "status_code" => 422,
                "errors" => $validator->errors(),
            ], 422);
        }

        try {
            $checkout = Checkout::where('email', $request->email)->latest()->first();
            if (!$checkout) {
                return response()->json(['status' => false,'message' => 'No booking found for this email.'], 404);
            }
            $booking_is_contract = Booking::where('id', $checkout->booking_id)->where('is_contract',1)->first();
            if (!$booking_is_contract) {
                return response()->json(['status' => false,'message' => 'No is contract found for this email.'], 404);
            }

            $contract = new ContractIn();
            $contract->booking_id = $checkout->id;
            $contract->name = $request->name;
            $contract->address = $request->address;
            $contract->postal_code = $request->postal_code;
            $contract->email = $request->email;

            $licensePhotoPath = $request->hasFile('license_photo') ? $request->file('license_photo')->store('license_photos', 'public') : $contract->license_photo;
            $contract->license_photo = $licensePhotoPath;

            $vehicleImagePaths = $contract->vehicle_images ? json_decode($contract->vehicle_images, true) : [];

            if ($request->hasFile('vehicle_images')) {
                foreach ($request->file('vehicle_images') as $image) {
                    $vehicleImagePaths[] = $image->store('vehicle_images', 'public');
                }
            }
            $contract->vehicle_images = json_encode($vehicleImagePaths);

            $customerSignaturePath = $request->hasFile('customer_signature')
                ? $request->file('customer_signature')->store('signatures', 'public')
                : $contract->customer_signature;
            $contract->customer_signature = $customerSignaturePath;

            $fuelImagePath = $request->hasFile('fuel_image')
                ? $request->file('fuel_image')->store('fuel_image', 'public')
                : $contract->fuel_image;
            $contract->fuel_image = $fuelImagePath;

            $contract->record_kilometers = $request->record_kilometers;
            $contract->fuel_level = $request->fuel_level;
            $contract->vehicle_damage_comments = $request->vehicle_damage_comments;
            $contract->save();

            $booking = Booking::where('id', $contract->booking_id)->first();
            $booking->is_contract = 2;
            $booking->save();

            Mail::to($request->email)->send(new ContractCreatedMail($contract));

            return response()->json([
                'status' => true,
                'message' => 'Check-in completed successfully.',
                'data' => $contract
            ], 201);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'error' => $e->getMessage()], 500);
        }
    }

    public function checkout(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'license_photo' => 'nullable|file|mimes:jpeg,png,jpg|max:2048',
            'record_kilometers' => 'required|integer',
            'fuel_level' => 'nullable|string',
            'vehicle_images' => 'nullable|array',
            'vehicle_images.*' => 'file|mimes:jpeg,png,jpg|max:2048',
            'vehicle_damage_comments' => 'nullable|string',
            'customer_signature' => 'nullable|file|mimes:jpeg,png,jpg|max:2048',
            'fuel_image' => 'nullable|file|mimes:jpeg,png,jpg|max:2048',

            'email' => 'required|email|exists:contract_ins,email',
            'contract_id' => 'required|exists:contract_ins,id',
        ], [
            'email.required' => 'Email address is required.',
            'email.exists' => 'The selected email does not exist in our records.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'The given data was invalid.',
                "status_code" => 422,
                "errors" => $validator->errors(),
            ], 422);
        }
        try {
            $contract = ContractIn::where('id', $request->contract_id)->where('email', $request->email)->first();
            if (!$contract) {
                return response()->json(['error' => 'contract_id is invalid.'], 403);
            }

            $booking = Booking::where('id', $contract->booking_id)->first();
            if (!$booking || $booking->is_confirm != 1) {
                return response()->json(['error' => 'Booking is not confirmed or does not exist.'], 403);
            }

            $contractOut = ContractOut::where('contract_id', $contract->id)->first();

            $vehicleImages = $request->hasFile('vehicle_images') ?
                array_map(fn($image) => $image->store('vehicle_images', 'public'), $request->file('vehicle_images')) : [];

            $customerSignaturePath = $request->hasFile('customer_signature') ?
                $request->file('customer_signature')->store('signatures', 'public') : null;

            $fuelImagePath = $request->hasFile('fuel_image') ?
                $request->file('fuel_image')->store('fuel_images', 'public') : null;

            $licensePhotoPath = $request->hasFile('license_photo') ? $request->file('license_photo')->store('license_photos', 'public') : $contract->license_photo;

            $record_kilometers = $request->record_kilometers - $contract->record_kilometers;

            $data = [
                'contract_id' => $contract->id,
                // 'booking_id' => $booking->id,
                'name' => $request->name,
                'address' => $request->address,
                'postal_code' => $request->postal_code,
                'email' => $request->email,
                'record_kilometers' => $record_kilometers,
                'fuel_level' => $request->fuel_level,
                'vehicle_images' => json_encode($vehicleImages),
                'vehicle_damage_comments' => $request->vehicle_damage_comments,
                'customer_signature' => $customerSignaturePath,
                'fuel_image' => $fuelImagePath,
                'license_photo' => $licensePhotoPath,
            ];

            $contractOutData = $contractOut ? $contractOut->update($data) : ContractOut::create($data);

            $booking->is_confirm = 2;
            $booking->save();

            if ($contractOutData->record_kilometers >= 15000) {
                $alert = new Alert();
                $alert->vehicle_id = $contractOutData->id;
                $alert->kilometer = $contractOutData->record_kilometers;

                if ($contractOutData->record_kilometers >= 80000) {
                    $alert->servicing = 'Brakes check';
                } elseif ($contractOutData->record_kilometers >= 40000) {
                    $alert->servicing = 'Plates change';
                } else {
                    $alert->servicing = 'Servicing';
                }

                $alert->save();
            }

            $admin = User::where('id', 1)->first();

            Mail::to($contract->email)->send(new CheckOutMail($contract, $contractOutData));
            Mail::to($admin->email)->send(new CheckOutMail($contract, $contractOutData));

            return response()->json([
                'status' => true,
                'message' => 'Contract Out details saved.',
                'data' => $contractOutData
            ]);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'error' => $e->getMessage()], 500);
        }
    }


    public function bookinghistory(Request $request){

    }

    public function getBookingHistory($email)
  {
    try {
        // Retrieve bookings based on the provided email from the checkout table
        $checkouts = Checkout::where('email', $email)->with('booking')->get();

        if ($checkouts->isEmpty()) {
            return response()->json([
                'status' => false,
                'message' => 'No booking history found for this email.',
            ], 404);
        }

        // Format the response to include booking details and statuses
        $bookingHistory = $checkouts->map(function ($checkout) {
            $booking = $checkout->booking;
            $statusDescription = $this->getBookingStatusDescription($booking);

            return [
                'booking_id' => $booking->id ?? null,
                'vehicle_name' => $booking->name ?? null,
                'total_price' => $booking->total_price ?? null,
                'status' => $booking->status ?? null,
                'pickUpLocation' => $booking->pickUpLocation ?? null,
                'dropOffLocation' => $booking->dropOffLocation ?? null,
                'pickUpDate' => $booking->pickUpDate ?? null,
                'collectionDate' => $booking->collectionDate ?? null,
                'created_at' => $checkout->created_at,
                'status_description' => $statusDescription,
            ];
        });

        return response()->json([
            'status' => true,
            'message' => 'Booking history retrieved successfully.',
            'data' => $bookingHistory,
        ], 200);

    } catch (\Exception $e) {
        return response()->json([
            'status' => false,
            'message' => 'An error occurred while retrieving booking history.',
            'error' => env('APP_DEBUG') ? $e->getMessage() : 'Please contact support.',
        ], 500);
    }
   }

/**
 * Get the booking status description based on specific conditions.
 */
    private function getBookingStatusDescription($booking)
   {
    if ($booking->is_reject == 1) {
        return 'Booking rejected by admin';
    }
    if ($booking->is_view == 1) {
        return 'Booking approved';
    }
    if ($booking->is_contract == 1) {
        return 'Check-in form sent by admin';
    }
    if ($booking->is_contract == 2) {
        return 'Check-in form submitted by user';
    }
    if ($booking->is_confirm == 1) {
        return 'Check-in details seen and approved by admin';
    }
    if ($booking->is_complete == 1) {
        return 'Booking completed';
    }
    return 'Booking is yet to approve';
   }


   public function contactus(Request $request)
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

       try {
            Mail::to($contact->email)->send(new ContactMail($contact));
            Mail::to($admin->email)->send(new ContactMail($contact));
       } catch (\Exception $e) {
            return response()->json([
               'status' => false,
               'message' => 'Message saved but failed to send email to the admin.',
               'error' => env('APP_DEBUG') ? $e->getMessage() : 'Please contact support.',
            ], 500);
       }

       return response()->json([
           'status' => true,
           'message' => 'Message sent successfully!',
       ], 200);
   }



}

