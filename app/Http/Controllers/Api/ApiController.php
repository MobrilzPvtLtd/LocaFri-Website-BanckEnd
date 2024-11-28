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
use Illuminate\Support\Facades\Request as UrlRequest;

class ApiController extends Controller
{

    public function getTerms() {
        $termsContent = [
            'title' => 'Terms and Conditions',
            'general_conditions' => [
                [
                    'heading' => '1. Hirer\'s Responsibilities',
                    'content' => 'The hirer is responsible for the rented vehicle (including all accessories) from the start of the rental period. The vehicle must be returned in its original condition (washed, vacuumed, and in working order)...',
                ],

            ],
            'link' => url('/terms-and-conditions'),
        ];

        return response()->json($termsContent, 200);
    }

    public function getPrivacy() {
        $privacyPolicy = [
            'title' => 'Privacy Policy',
            'company_name' => config('app.name'),
            'app_url' => config('app.url'),
            'app_email' => setting('email'),
            'content' => [
                'introduction' => "At " . config('app.name') . ", accessible at " . config('app.url') . ", one of our main priorities is the privacy of our visitors. This Privacy Policy document contains types of information that is collected and recorded by " . config('app.name') . " and how we use it.",

                'log_files' => [
                    'title' => 'Log Files',
                    'description' => config('app.name') . " follows a standard procedure of using log files. These files log visitors when they visit websites. All hosting companies do this as a part of hosting services' analytics. The information collected by log files includes IP addresses, browser type, ISP, date and time stamp, referring/exit pages, and possibly the number of clicks. These are not linked to any information that is personally identifiable.",
                ],
            ],
        ];

        return response()->json($privacyPolicy);
    }

    public function register(Request $request) {
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

    public function avalibalcars(Request $request) {
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

    public function cardetails($id) {
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

    public function cars() {
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

    public function acceptBooking(Request $request) {
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

    public function contract(Request $request) {
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

    public function login(Request $request) {
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

    public function resendOtp(Request $request) {
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

    public function verifyOtp(Request $request) {
        $request->validate(['email' => 'required|email', 'otp' => 'required']);

        // Find user by email
        $user = User::where('email', $request->email)->first();

        // Check if the user exists
        if (!$user) {
            return response()->json(['status' => false, 'message' => 'User not found.'], 404);
        }

        // Check if the OTP matches
        if ($user->otp !== $request->otp) {
            return response()->json(['status' => false, 'message' => 'Invalid OTP.'], 401);
        }

        // If the OTP is correct, and the user hasn't been verified yet, mark them as verified
        if ($user->verified == 0) {
            $user->update(['otp' => null,]);
        }

        // Generate a token (even if the user has already verified the OTP)
        $token = $user->createToken('auth_token', ['*'])->plainTextToken;

        // Set the expiration time for the token (optional, e.g., 1 day)
        $expiresAt = Carbon::now()->addDay(1);

        // Return the response with token and expiration time
        return response()->json([
            'status' => true,
            'message' => 'Your email is verified. You are now logged in.',
            'token' => $token,
            'expires_at' => $expiresAt->toDateTimeString(), // Optionally return the expiration time
        ]);
    }

    public function create_contract(Request $request) {
        if (!Auth::check()) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthenticated. Please login to continue.',
            ], 401);
        }

      try {
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
        $booking = new Booking();
        // $booking->user_id = $user->id;  // Store the authenticated user's ID
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
        $booking->pickUpLocation = $request->pickUpLocation;
        $booking->dropOffLocation = $request->dropOffLocation;
        $booking->pickUpDate = \Carbon\Carbon::parse($request->pickUpDate);
        $booking->pickUpTime = $request->pickUpTime;
        $booking->collectionDate = \Carbon\Carbon::parse($request->collectionDate);
        $booking->collectionTime = $request->collectionTime;
        $booking->payment_type = $request->payment_type;
        $booking->save();

        // Create the checkout
        $checkout = new Checkout();
        $checkout->booking_id = $booking->id;
        $checkout->first_name = $request->first_name;
        $checkout->last_name = $request->last_name;
        $checkout->email = $request->email;
        $checkout->phone = $request->phone;
        $checkout->address_first = $request->address_first;
        $checkout->address_last = $request->address_last;
        $checkout->save();

        return response()->json([
            'status' => true,
            'message' => 'Contract created successfully.',
            'price' => (int) $booking->total_price,
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


    public function bookingHistory(Request $request)
{
    $transactions = Transaction::with(['booking.checkout']) // Eager load related data
        ->whereHas('booking.checkout', function ($query) use ($request) {
            $query->where('email', $request->email);
        })
        ->get();

    $transactionData = [];

    foreach ($transactions as $transaction) {
        $booking = $transaction->booking->checkout ?? null;
        $bookings = $transaction->booking ?? null;

        // Correctly retrieve the latest contract using booking_id from Transaction's booking
        $contract = ContractIn::where('booking_id', $transaction->booking->id ?? null)->latest()->first();
        $contract_id = $contract ? $contract->id : null;

        if ($transaction->full_payment_paid == 0) {
            $apiUrl = basename(request()->url());

            $payment_link = $transaction && $transaction->remaining_amount > 0
                ? route('stripe', [
                    'price' => $transaction->remaining_amount,
                    'vehicle_name' => $transaction->booking->name ?? 'N/A',
                    'customer_email' => $transaction->booking->checkout->email,
                    'booking_id' => $transaction->booking->id ?? 'N/A',
                    'payment_type' => 'payment_full',
                    'apiUrl' => $apiUrl,
                ])
                : null;

            $transactionData[] = [
                'contract_id' => $contract_id, // Include the correct contract ID
                'booking_id' => $transaction->booking->id ?? null,
                'total_amount' => $transaction->booking->total_price ?? null,
                'amount_paid' => $transaction->amount ?? null,
                'remaining_amount' => $transaction->remaining_amount ?? null,
                'payment_link' => $payment_link,
                'bookings' => $bookings,
            ];
        }
    }

    return response()->json([
        'status' => true,
        'data' => $transactionData,
    ]);
}


    public function logout(Request $request) {
        $user = $request->user();

        $user->currentAccessToken()->delete();

        return response()->json([
            'status' => true,
            'message' => 'Logout successful. Your token has been invalidated, and verified status has been reset.',
        ], 200);
    }

    public function updateProfile(Request $request) {
        $user = $request->user();

        $request->validate([
            'first_name' => 'string|max:255|nullable',
            'last_name' => 'string|max:255|nullable',
            'email' => 'email|unique:users,email,' . $user->id . '|nullable',
            'mobile' => 'string|max:15|nullable|unique:users,mobile,' . $user->id,
            'password' => 'string|min:8|nullable',
        ], [
            'email.unique' => 'The email address is already taken.',
            'password.min' => 'The password must be at least 8 characters.',
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

    public function checkin(Request $request) {
        $validator = Validator::make($request->all(), [
            'booking_id' => 'required|exists:checkouts,booking_id',
            'license_photo' => 'nullable|file|mimes:jpeg,png,jpg',
            'record_kilometers' => 'required|integer',
            'fuel_level' => 'nullable|string',
            'vehicle_images' => 'nullable|array',
            'vehicle_images.*' => 'file|mimes:jpeg,png,jpg',
            'vehicle_damage_comments' => 'nullable|string',
            'customer_signature' => 'nullable|file|mimes:jpeg,png,jpg',
            'fuel_image' => 'nullable|file|mimes:jpeg,png,jpg',
            'name' => 'required|string',
            'email' => 'required|email|exists:checkouts,email',
        ], [
            'name.required' => 'First name is required.',
            'email.required' => 'Email address is required.',
            'email.exists' => 'The selected email does not exist in our records.',
            'booking_id.required' => 'Booking ID is required.',
            'booking_id.exists' => 'Invalid Booking ID.',
        ]);

        // If validation fails
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'The given data was invalid.',
                'status_code' => 422,
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            // Fetch the checkout based on email and booking_id
            $checkout = Checkout::where('email', $request->email)
                                ->where('booking_id', $request->booking_id) // Added the booking_id filter
                                ->latest()
                                ->first();

            if (!$checkout) {
                return response()->json(['status' => false, 'message' => 'No booking found for this email and booking ID.'], 404);
            }

            // Check if the booking has 'is_contract' set to 1
            $booking_is_contract = Booking::where('id', $checkout->booking_id)
                                          ->where('is_contract', 1)
                                          ->first();

            if (!$booking_is_contract) {
                return response()->json(['status' => false, 'message' => 'No contract found for this email and booking ID.'], 404);
            }

            // Create the contract-in record
            $contract = new ContractIn();
            $contract->booking_id = $checkout->id; // Use checkout ID here
            $contract->name = $request->name;
            $contract->address = $request->address;
            $contract->postal_code = $request->postal_code;
            $contract->email = $request->email;

            // Handle file uploads
            $licensePhotoPath = $request->hasFile('license_photo') ? $request->file('license_photo')->store('license_photos', 'public') : null;
            $contract->license_photo = $licensePhotoPath;

            $vehicleImagePaths = [];
            if ($request->hasFile('vehicle_images')) {
                foreach ($request->file('vehicle_images') as $image) {
                    $vehicleImagePaths[] = $image->store('vehicle_images', 'public');
                }
            }
            $contract->vehicle_images = json_encode($vehicleImagePaths);

            $contract->customer_signature = $request->hasFile('customer_signature')
                ? $request->file('customer_signature')->store('signatures', 'public')
                : null;

            $contract->fuel_image = $request->hasFile('fuel_image')
                ? $request->file('fuel_image')->store('fuel_image', 'public')
                : null;

            $contract->record_kilometers = $request->record_kilometers;
            $contract->fuel_level = $request->fuel_level;
            $contract->vehicle_damage_comments = $request->vehicle_damage_comments;
            $contract->save();

            // Update the booking's contract status
            $booking = Booking::where('id', $contract->booking_id)->first();
            $booking->is_contract = 2;  // Update the contract status
            $booking->save();

            // Send email notification
            Mail::to($request->email)->send(new ContractCreatedMail($contract));

            // Return response with checkin ID
            return response()->json([
                'status' => true,
                'message' => 'Check-in completed successfully.',
                'data' => [
                    'contract_id' => $contract->id, // Add contract ID to response
                    'contract' => $contract
                ]
            ], 201);

        } catch (\Exception $e) {
            return response()->json(['status' => false, 'error' => $e->getMessage()], 500);
        }
    }

    public function checkout(Request $request) {
       $validator = Validator::make($request->all(), [
        'license_photo' => 'nullable|file|mimes:jpeg,png,jpg|max:2048',
        'record_kilometers' => 'required|integer',
        'fuel_level' => 'nullable|string',
        'vehicle_images' => 'nullable|array',
        'vehicle_images.*' => 'file|mimes:jpeg,png,jpg|max:2048',
        'vehicle_damage_comments' => 'nullable|string',
        'customer_signature' => 'nullable|file|mimes:jpeg,png,jpg|max:2048',
        'fuel_image' => 'nullable|file|mimes:jpeg,png,jpg|max:2048',
        'email' => 'required|email',
        // Validate contract_id to ensure it exists in contract_ins table
        // 'contract_id' => 'required|exists:contract_ins,id',
        // Ensure contract_id exists in contract_ins table
        ], [
        'email.required' => 'Email address is required.',
        'email.exists' => 'The selected email does not exist in our records.',
        // 'contract_id.exists' => 'The selected contract ID is invalid.',
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
        // Ensure the contract exists and matches the email
        $contract = ContractIn::where('id', $request->contract_id)
            ->where('email', $request->email)
            ->first();

        if (!$contract) {
            return response()->json(['error' => 'Contract ID is invalid for this email.'], 403);
        }

        $booking = Booking::where('id', $contract->booking_id)->first();
        if (!$booking || $booking->is_confirm != 1) {
            return response()->json(['error' => 'Booking is not confirmed or does not exist.'], 403);
        }

        $contractOut = ContractOut::where('contract_id', $contract->id)->first();

        // Process vehicle images
        $vehicleImages = $request->hasFile('vehicle_images') ?
            array_map(fn($image) => $image->store('vehicle_images', 'public'), $request->file('vehicle_images')) : [];

        $customerSignaturePath = $request->hasFile('customer_signature') ?
            $request->file('customer_signature')->store('signatures', 'public') : null;

        $fuelImagePath = $request->hasFile('fuel_image') ?
            $request->file('fuel_image')->store('fuel_images', 'public') : null;

        $licensePhotoPath = $request->hasFile('license_photo') ?
            $request->file('license_photo')->store('license_photos', 'public') : $contract->license_photo;

        $record_kilometers = $request->record_kilometers - $contract->record_kilometers;

        $data = [
            'contract_id' => $contract->id,
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

        // If contractOut exists, update it, otherwise create a new one.
        $contractOutData = $contractOut ? $contractOut->update($data) : ContractOut::create($data);

        // Mark booking as confirmed
        $booking->is_confirm = 2;
        $booking->save();

        // Check if servicing alert needs to be created
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

        // Send checkout mail to user and admin
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

    public function contactus(Request $request) {
       $request->validate([
           'name' => 'required',
           'email' => 'required|email',
           'message' => 'required',
       ]);

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

