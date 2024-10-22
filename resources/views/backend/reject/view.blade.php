@extends('backend.layouts.app')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4>Rejected Reservation Details</h4>
        <a href="{{ route('reject.index') }}" class="btn btn-warning btn-sm">
            <i class="fas fa-reply"></i>
        </a>
    </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5>Booking Information</h5>
                    {{-- <p><strong>Booking ID:</strong> {{ $booking->id }}</p> --}}
                    <p><strong>Name:</strong> {{ $booking->name }}</p>
                    <p><strong>Total Price:</strong> {{ $booking->total_price }}</p>
                    <p><strong>Pick Up Location:</strong> {{ $booking->pickUpLocation }}</p>
                    <p><strong>Drop Off Location:</strong> {{ $booking->dropOffLocation }}</p>
                    <p><strong>Pick Up Date:</strong> {{ $booking->pickUpDate }}</p>
                    <p><strong>Collection Date:</strong> {{ $booking->collectionDate }}</p>
                    {{-- <p><strong>Target Date:</strong> {{ $booking->targetDate }}</p> --}}
                    <p><strong>Status:</strong> {{ $booking->status }}</p>
                    <p><strong>Payment Method:</strong>
                        @if (isset($tran->payment_method))
                        <span style="background-color: #b1d994;padding: 5px;">
                            {{ ucwords($tran->payment_method) }}
                        </span>
                    @else
                        <span style="background-color: #e8857d;padding: 5px;">
                            Unpaid
                        </span>
                    @endif
                    </p>
                </div>

                {{-- Uncommented details --}}
                <div class="col-md-6">
                    <h5>Additional Booking Information</h5>
                    <p><strong>Daily Price:</strong> {{ $booking->Dprice }}</p>
                    <p><strong>Weekly Price:</strong> {{ $booking->wprice }}</p>
                    <p><strong>Monthly Price:</strong> {{ $booking->mprice }}</p>
                    <p><strong>Days Count:</strong> {{ $booking->day_count }}</p>
                    <p><strong>Weeks Count:</strong> {{ $booking->week_count }}</p>
                    <p><strong>Months Count:</strong> {{ $booking->month_count }}</p>
                    <p><strong>Additional Driver:</strong> {{ $booking->additional_driver }}</p>
                    <p><strong>Booster Seat:</strong> {{ $booking->booster_seat }}</p>
                    <p><strong>Child Seat:</strong> {{ $booking->child_seat }}</p>
                    <p><strong>Exit Permit:</strong> {{ $booking->exit_permit }}</p>
                    <p><strong>Pick Up Time:</strong> {{ $booking->pickUpTime }}</p>
                    <p><strong>Collection Time:</strong> {{ $booking->collectionTime }}</p>
                </div>
            </div>
            <div class="mt-4">
                <a href="{{ route('reject.index') }}" class="btn btn-secondary">Back to List</a>
            </div>
        </div>
    </div>
@endsection
