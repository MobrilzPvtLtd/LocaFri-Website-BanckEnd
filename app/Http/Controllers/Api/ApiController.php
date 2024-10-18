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
use App\Models\Contract;
use App\Models\ContractsOut;
use Illuminate\Support\Facades\Log;
use App\Mail\ContractCreatedMail;
use App\Mail\MakeContract;
use App\Mail\CheckOutMail;
use Illuminate\Support\Facades\Validator;

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
            return response()->json([
                'status' => false,
                'message' => 'Invalid OTP.',
            ], 401);
        }

        $otpExpiryTime = Carbon::parse($user->otp_generated_at)->addSeconds(30);
        if (Carbon::now()->greaterThan($otpExpiryTime)) {

            $otp = mt_rand(100000, 999999);

            $user->otp = $otp;
            $user->otp_generated_at = Carbon::now();
            $user->save();


            Mail::to($user->email)->send(new SendOtpMail($otp));

            return response()->json([
                'status' => true,
                'message' => 'OTP has expired. New OTP has been sent to your email.',
            ], 200);
        }

        $user->otp = null;
        $user->verified = 1;
        $user->save();

        // Auth::login($user);
        // $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => true,
            'message' => 'Your email is verified.',
            // 'user' => $user,
            // 'token' => $token
        ]);
    }

    public function avalibalcars(Request $request)
    {
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
                //mail logic
                $checkout = Checkout::where('booking_id', $booking->id)->first();

                if ($checkout && $checkout->email) {

                    Mail::to($checkout->email)->send(new MakeContract($booking));
                }

                return response()->json([
                    'status' => 'success',
                    'message' => 'Contract created successfully and email sent.',
                    'booking' => $booking
                ], 200);
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

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'The given data was invalid.',
                "status_code" => 422,
                "errors" => $validator->errors(),
            ], 422);
        }

        // Calcular el precio total
        $totalPrice = 0;
        $totalPriceDay = $request->Dprice * $request->day_count;
        $totalPriceWeek = $request->wprice * $request->week_count;
        $totalPriceMonth = $request->mprice * $request->month_count;
        $totalPrice = $totalPriceDay + $totalPriceWeek + $totalPriceMonth;

        // Añadir costos adicionales
        $totalPrice += $request->additional_driver ?? 0;
        $totalPrice += $request->booster_seat ?? 0;
        $totalPrice += $request->child_seat ?? 0;
        $totalPrice += $request->exit_permit ?? 0;

        // Crear la reserva
        $booking = new Booking();
        $booking->name = $request->vehicle_name;
        $booking->Dprice = $request->Dprice;
        $booking->wprice = $request->wprice;
        $booking->mprice = $request->mprice;
        $booking->day_count = $request->day_count;
        $booking->week_count = $request->week_count;
        $booking->month_count = $request->month_count;
        $booking->additional_driver = $request->additional_driver ?? 0;
        $booking->booster_seat = $request->booster_seat ?? 0;
        $booking->child_seat = $request->child_seat ?? 0;
        $booking->exit_permit = $request->exit_permit ?? 0;
        $booking->total_price = $totalPrice;
        $booking->pickUpLocation = $request->pickUpLocation;
        $booking->dropOffLocation = $request->dropOffLocation;
        $booking->pickUpDate = Carbon::parse($request->pickUpDate);
        $booking->pickUpTime = $request->pickUpTime;
        $booking->collectionDate = Carbon::parse($request->collectionDate);
        $booking->collectionTime = $request->collectionTime;
        $booking->save();

        // Crear el checkout
        $checkout = new Checkout();
        $checkout->booking_id = $booking->id;
        $checkout->first_name = $request->first_name;
        $checkout->last_name = $request->last_name;
        $checkout->email = $request->email;
        $checkout->phone = $request->phone;
        $checkout->address_first = $request->address_first;
        $checkout->address_last = $request->address_last;
        $checkout->save();

        // $user = User::where('email', $request->email)->first();

        // if (!$user) {
        //     $user = User::create([
        //         'email' => $request->email,
        //     ]);
        // }

        // $otp = mt_rand(100000, 999999);
        // $user->otp = $otp;
        // $user->save();

        // Mail::to($user->email)->send(new SendOtpMail($otp));

        return response()->json([
            'status' => true,
            'message' => 'Contract created successfully.',
        ], 201);
    }

    public function checkin(Request $request)
    {
        try {
            if (!$request->has('email') || empty($request->email)) {
                return response()->json(['message' => 'Email is required for authentication.'], 401);
            }

            $email = $request->email;
            Log::channel('checkin_logs')->info('Incoming email for check-in', ['email' => $email]);

            $checkout = Checkout::where('email', $email)->first();
            if ($checkout) {
                $bookingId = $checkout->booking_id;
                Log::channel('checkin_logs')->info('Booking found in Checkout model', ['booking_id' => $bookingId]);
            } else {
                Log::channel('checkin_logs')->info('No booking found in Checkout model for email', ['email' => $email]);
                return response()->json(['message' => 'No booking found for this email.'], 404);
            }

            $contract = Contract::where('email', $email)->first();

            if (!$contract) {
                $contract = new Contract();
                $contract->email = $email;
                $contract->booking_id = $bookingId;
            } else {
                if (empty($contract->booking_id)) {
                    $contract->booking_id = $bookingId;
                }
            }

            $validated = $request->validate([
                'license_photo' => 'nullable|file|mimes:jpeg,png,jpg|max:2048',
                'record_kilometers' => 'nullable|string',
                'fuel_level' => 'nullable|string',
                'vehicle_images' => 'nullable|array',
                'vehicle_images.*' => 'file|mimes:jpeg,png,jpg|max:2048',
                'vehicle_damage_comments' => 'nullable|string',
                'customer_signature' => 'nullable|file|mimes:jpeg,png,jpg|max:2048'
            ]);

            Log::channel('checkin_logs')->info('Check-in request validated', ['validated' => $validated]);

            $licensePhotoPath = $request->hasFile('license_photo')
                ? $request->file('license_photo')->store('license_photos', 'public')
                : $contract->license_photo;

            $vehicleImagePaths = $contract->vehicle_images ? json_decode($contract->vehicle_images, true) : [];
            if ($request->hasFile('vehicle_images')) {
                foreach ($validated['vehicle_images'] as $image) {
                    $vehicleImagePaths[] = $image->store('vehicle_images', 'public');
                }
            }

            $customerSignaturePath = $request->hasFile('customer_signature')
                ? $request->file('customer_signature')->store('signatures', 'public')
                : $contract->customer_signature;

            $contract->license_photo = $licensePhotoPath;
            $contract->record_kilometers = $validated['record_kilometers'] ?? $contract->record_kilometers;
            $contract->fuel_level = $validated['fuel_level'] ?? $contract->fuel_level;
            $contract->vehicle_images = json_encode($vehicleImagePaths);
            $contract->vehicle_damage_comments = $validated['vehicle_damage_comments'] ?? $contract->vehicle_damage_comments;
            $contract->customer_signature = $customerSignaturePath;
            $contract->save();

            // Retrieve the booking and handle null check
            $booking = Booking::where('id', $contract->booking_id)->first();

            // Check if booking is found
            if (!$booking) {
                Log::channel('checkin_logs')->error('Booking not found with contract\'s booking_id', ['booking_id' => $contract->booking_id]);
                return response()->json(['message' => 'Booking not found for the contract.'], 404);
            }

            // Update the booking's is_contract status
            $booking->is_contract = 2;
            $booking->save();

            Log::channel('checkin_logs')->info('Check-in successful, contract updated.', ['contract' => $contract]);

            try {
                Mail::to($email)->send(new ContractCreatedMail($contract));
                Log::channel('checkin_logs')->info('Email sent successfully', ['email' => $email]);
            } catch (\Exception $e) {
                Log::channel('checkin_logs')->error('Failed to send email', ['error' => $e->getMessage()]);
                return response()->json(['message' => 'Failed to send email.', 'error' => $e->getMessage()], 500);
            }

            return response()->json([
                'message' => 'Check-in completed successfully! Contract updated and email sent.',
                'data' => $contract
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::channel('checkin_logs')->error('Validation failed', ['errors' => $e->errors()]);
            return response()->json(['message' => 'Validation failed.', 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            Log::channel('checkin_logs')->error('An error occurred while processing the check-in', ['error' => $e->getMessage()]);
            return response()->json(['message' => 'An error occurred while processing your request.', 'error' => $e->getMessage()], 500);
        }
    }
    public function checkout(Request $request)
    {
        try {
            // Validate incoming data
            $request->validate([
                'email' => 'required|email',
                'record_kilometers' => 'required|integer',
                'fuel_level' => 'required|integer|min:0|max:100',
                'vehicle_images' => 'required|array',
                'vehicle_images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'vehicle_damage_comments' => 'nullable|string',
                'customer_signature' => 'required|file|mimes:jpeg,png,jpg|max:2048',
                'odometer_image' => 'required|file|mimes:jpeg,png,jpg|max:2048', // Add odometer image validation
            ]);

            // Find the contract based on the provided email
            $contract = Contract::where('email', $request->email)->first();

            if (!$contract) {
                return response()->json(['error' => 'Contract not found for the provided email.'], 404);
            }

            // Check if the related booking is confirmed
            $booking = Booking::where('id', $contract->booking_id)->first();
            if (!$booking || $booking->is_confirm != 1) {
                return response()->json(['error' => 'Booking is not confirmed or does not exist.'], 403);
            }

            // Check if a ContractsOut record already exists for this contract
            $contractsOut = ContractsOut::where('contract_id', $contract->id)->first();

            // Handle vehicle images upload
            $vehicleImages = [];
            if ($request->hasFile('vehicle_images')) {
                foreach ($request->file('vehicle_images') as $image) {
                    $path = $image->store('vehicle_images', 'public');
                    $vehicleImages[] = $path;
                }
            }

            // Handle customer signature upload
            $customerSignaturePath = $request->hasFile('customer_signature')
                ? $request->file('customer_signature')->store('signatures', 'public')
                : null;

            // Handle odometer image upload
            $odometerImagePath = $request->hasFile('odometer_image')
                ? $request->file('odometer_image')->store('odometer_images', 'public')
                : null;

            // If ContractsOut exists, update it; otherwise, create a new one
            if ($contractsOut) {
                $contractsOut->update([
                    'record_kilometers' => $request->record_kilometers,
                    'fuel_level' => $request->fuel_level,
                    'vehicle_images' => json_encode($vehicleImages),
                    'vehicle_damage_comments' => $request->vehicle_damage_comments,
                    'customer_signature' => $customerSignaturePath,
                    'odometer_image' => $odometerImagePath,
                ]);
            } else {
                $contractsOut = ContractsOut::create([
                    'contract_id' => $contract->id,
                    'email' => $contract->email,
                    'record_kilometers' => $request->record_kilometers,
                    'fuel_level' => $request->fuel_level,
                    'vehicle_images' => json_encode($vehicleImages),
                    'vehicle_damage_comments' => $request->vehicle_damage_comments,
                    'customer_signature' => $customerSignaturePath,
                    'odometer_image' => $odometerImagePath,
                ]);
            }

            // Update the booking status to 'successful'
            $booking->status = 'successful';
            $booking->save();

            // Log success message
            Log::channel('checkout_logs')->info('Contracts-Out details saved/updated successfully.', ['contracts_out' => $contractsOut]);

            // Send email notifications
            $customerEmail = $contract->email;
            $adminEmail = config('mail.admin_email') ?? 'admin@example.com';

            Mail::to($customerEmail)->send(new CheckOutMail($contract, $contractsOut));
            Mail::to($adminEmail)->send(new CheckOutMail($contract, $contractsOut));

            return response()->json([
                'message' => 'Contracts-Out details saved/updated, booking status updated to successful, and emails sent.',
                'data' => $contractsOut
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::channel('checkout_logs')->error('Validation failed', ['errors' => $e->errors()]);
            return response()->json(['message' => 'Validation failed.', 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            Log::channel('checkout_logs')->error('An error occurred while processing the checkout', ['error' => $e->getMessage()]);
            return response()->json(['message' => 'An error occurred while processing your request.', 'error' => $e->getMessage()], 500);
        }
    }
}

