@extends('backend.layouts.app')

@section('content')
    <div class="card">
        <div class="d-flex justify-content-between">
            <div class="align-self-center">
                <h4 class="card-title p-1">Completed Contract Details</h4>
            </div>
            <a href="{{ route('completedcontract.index') }}" class="btn btn-warning">
                <i class="fas fa-reply fa-fw"></i>
            </a>
        </div>
    </div>
     <br>
    <div class="row">
        <div class="col-md-6">
            <div class="card-body">
                <h5>Booking Information</h5>
                <div>
                    {{-- Checkout Details --}}
                    @if ($booking->checkout)
                        <p><strong>First Name:</strong> {{ $booking->checkout->first_name }}</p>
                        <p><strong>Last Name:</strong> {{ $booking->checkout->last_name }}</p>
                        <p><strong>Email:</strong> {{ $booking->checkout->email }}</p>
                        <p><strong>Address Line 1:</strong> {{ $booking->checkout->address_first }}</p>
                        <p><strong>Address Line 2:</strong> {{ $booking->checkout->address_last }}</p>
                    @else
                        <p><strong>No Checkout Details Available</strong></p>
                    @endif

                    {{-- Booking Information --}}
                    <p><strong>Car Name:</strong> {{ $booking->name }}</p>
                    <p><strong>Total Price:</strong> {{ $booking->total_price }}</p>
                    <p><strong>Pick Up Location:</strong> {{ $booking->pickUpLocation }}</p>
                    <p><strong>Drop Off Location:</strong> {{ $booking->dropOffLocation }}</p>
                    <p><strong>Status:</strong> {{ ucwords($booking->status) }}</p>
                    <p><strong>Payment Method:</strong>
                        @if (isset($tran->payment_method))
                            <span style="background-color: #b1d994; padding: 5px;">{{ ucwords($tran->payment_method) }}</span>
                        @else
                            <span style="background-color: #e8857d; padding: 5px;">Unpaid</span>
                        @endif
                    </p>

                    {{-- Additional Booking Information --}}
                    <p><strong>Daily Price:</strong> {{ $booking->Dprice }}</p>
                    <p><strong>Weekly Price:</strong> {{ $booking->wprice }}</p>
                    <p><strong>Monthly Price:</strong> {{ $booking->mprice }}</p>
                    <p><strong>Day Count:</strong> {{ $booking->day_count }}</p>
                    <p><strong>Week Count:</strong> {{ $booking->week_count }}</p>
                    <p><strong>Month Count:</strong> {{ $booking->month_count }}</p>
                    <p><strong>Additional Driver:</strong> {{ $booking->additional_driver }}</p>
                    <p><strong>Booster Seat:</strong> {{ $booking->booster_seat }}</p>
                    <p><strong>Child Seat:</strong> {{ $booking->child_seat }}</p>
                    <p><strong>Exit Permit:</strong> {{ $booking->exit_permit }}</p>
                    <p><strong>Pick Up Date:</strong> {{ $booking->pickUpDate }}</p>
                    <p><strong>Pick Up Time:</strong> {{ $booking->pickUpTime }}</p>
                    <p><strong>Collection Time:</strong> {{ $booking->collectionTime }}</p>
                    <p><strong>Collection Date:</strong> {{ $booking->collectionDate }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card-body">
                <h5>Contract Details</h5>
                <div >
                    @if ($booking->is_contract == 2 && $booking->ContractIn)
                        <p><strong>Postal Code:</strong> {{ $booking->ContractIn->postal_code }}</p>
                        <p><strong>License Photo:</strong> <img src="{{ asset('storage/' . $booking->ContractIn->license_photo) }}" alt="License Photo" style="max-width: 100px;"></p>
                        <p><strong>Record Kilometers:</strong> {{ $booking->ContractIn->record_kilometers }}</p>
                        <p><strong>Fuel Level:</strong> {{ $booking->ContractIn->fuel_level }}</p>
                        <p><strong>Vehicle Damage Comments:</strong> {{ $booking->ContractIn->vehicle_damage_comments }}</p>
                        <p><strong>Customer Signature:</strong> <img src="{{ asset('storage/' . $booking->ContractIn->customer_signature) }}" alt="Customer Signature" style="max-width: 100px;"></p>
                    @else
                        <p><strong>No Contract Details Available</strong></p>
                    @endif

                    {{-- ContractOut Details --}}
                    @if ($booking->contractOut)
                        <p><strong>ContractOut ID:</strong> {{ $booking->contractOut->id }}</p>
                        <p><strong>Email:</strong> {{ $booking->contractOut->email }}</p>
                        <p><strong>Fuel Level:</strong> {{ $booking->contractOut->fuel_level }}</p>
                        <p><strong>Kilometers:</strong> {{ $booking->contractOut->record_kilometers }}</p>
                        <p><strong>Vehicle Damage Comments:</strong> {{ $booking->contractOut->vehicle_damage_comments }}</p>
                        <p><strong>Customer Signature:</strong> <img src="{{ asset('storage/' . $booking->contractOut->customer_signature) }}" alt="Customer Signature" style="max-width: 100px;"></p>
                        <p><strong>Odometer Image:</strong> <img src="{{ asset('storage/' . $booking->contractOut->odometer_image) }}" alt="Odometer Image" style="max-width: 100px;"></p>
                    @else
                        <p><strong>No ContractOut Details Available</strong></p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
