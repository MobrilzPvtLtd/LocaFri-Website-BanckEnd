@extends('backend.layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <h4> Checked In Confirmed Customer Details</h4>

            {{-- Booking Details --}}
            <table class="table table-bordered">

                {{-- Checkout Details --}}
                @if ($booking->checkout)
                    <tr>
                        <th>First Name</th>
                        <td>{{ $booking->checkout->first_name }}</td>
                    </tr>
                    <tr>
                        <th>Last Name</th>
                        <td>{{ $booking->checkout->last_name }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $booking->checkout->email }}</td>
                    </tr>
                    <tr>
                        <th>Address First Line</th>
                        <td>{{ $booking->checkout->address_first }}</td>
                    </tr>
                    <tr>
                        <th>Address Last Line</th>
                        <td>{{ $booking->checkout->address_last }}</td>
                    </tr>
                @else
                    <tr>
                        <th colspan="2">No checkout details available</th>
                    </tr>
                @endif

                {{-- Contract Details --}}
                @if ($booking->contract)
                    <tr>
                        <th>Postal Code</th>
                        <td>{{ $booking->contract->postal_code }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $booking->contract->email }}</td>
                    </tr>
                    <tr>
                        <th>License Photo</th>
                        <td><img src="{{ $booking->contract->license_photo }}" alt="License Photo" width="100"></td>
                    </tr>
                    <tr>
                        <th>Record Kilometers</th>
                        <td>{{ $booking->contract->record_kilometers }}</td>
                    </tr>
                    <tr>
                        <th>Fuel Level</th>
                        <td>{{ $booking->contract->fuel_level }}</td>
                    </tr>
                    <tr>
                        <th>Vehicle Damage Comments</th>
                        <td>{{ $booking->contract->vehicle_damage_comments }}</td>
                    </tr>
                    <tr>
                        <th>Customer Signature</th>
                        <td><img src="{{ $booking->contract->customer_signature }}" alt="Customer Signature" width="100">
                        </td>
                    </tr>
                    <tr>
                        <th>Vehicle Images</th>
                        <td><img src="{{ $booking->contract->vehicle_images }}" alt="Vehicle Images" width="100"></td>
                    </tr>
                @else
                    <tr>
                        <th colspan="2">No contract details available</th>
                    </tr>
                @endif


                <tr>
                    <th>Booking ID</th>
                    <td>{{ $booking->id }}</td>
                </tr>
                <tr>
                    <th>Name</th>
                    <td>{{ $booking->name }}</td>
                </tr>
                <tr>
                    <th>Total Price</th>
                    <td>{{ $booking->total_price }}</td>
                </tr>
                <tr>
                    <th>Pick Up Location</th>
                    <td>{{ $booking->pickUpLocation }}</td>
                </tr>
                <tr>
                    <th>Drop Off Location</th>
                    <td>{{ $booking->dropOffLocation }}</td>
                </tr>
                <tr>
                    <th>Pick Up Date</th>
                    <td>{{ $booking->pickUpDate }}</td>
                </tr>
                <tr>
                    <th>Pick Up Time</th>
                    <td>{{ $booking->pickUpTime }}</td>
                </tr>
                <tr>
                    <th>Collection Date</th>
                    <td>{{ $booking->collectionDate }}</td>
                </tr>
                <tr>
                    <th>Collection Time</th>
                    <td>{{ $booking->collectionTime }}</td>
                </tr>
                <tr>
                    <th>Target Date</th>
                    <td>{{ $booking->targetDate }}</td>
                </tr>
                <tr>
                    <th>Daily Price</th>
                    <td>{{ $booking->Dprice }}</td>
                </tr>
                <tr>
                    <th>Weekly Price</th>
                    <td>{{ $booking->wprice }}</td>
                </tr>
                <tr>
                    <th>Monthly Price</th>
                    <td>{{ $booking->mprice }}</td>
                </tr>
                <tr>
                    <th>Day Count</th>
                    <td>{{ $booking->day_count }}</td>
                </tr>
                <tr>
                    <th>Week Count</th>
                    <td>{{ $booking->week_count }}</td>
                </tr>
                <tr>
                    <th>Month Count</th>
                    <td>{{ $booking->month_count }}</td>
                </tr>
                <tr>
                    <th>Additional Driver</th>
                    <td>{{ $booking->additional_driver }}</td>
                </tr>
                <tr>
                    <th>Booster Seat</th>
                    <td>{{ $booking->booster_seat }}</td>
                </tr>
                <tr>
                    <th>Child Seat</th>
                    <td>{{ $booking->child_seat }}</td>
                </tr>
                <tr>
                    <th>Exit Permit</th>
                    <td>{{ $booking->exit_permit }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>{{ $booking->status }}</td>
                </tr>
                <tr>
                    <th>Payment Type</th>
                    <td>{{ $booking->payment_type == 1 ? 'Stripe' : ($booking->payment_type == 0 ? 'Twint' : 'Unknown') }}
                    </td>
                </tr>
              </table>
            <a href="{{ route('completecontract.index') }}" class="btn btn-primary">Back to List</a>
        </div>
    </div>
@endsection
