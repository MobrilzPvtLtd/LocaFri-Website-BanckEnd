@extends('backend.layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <h4> Customer Details[Booking Approved] </h4>
            <table class="table table-bordered">


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
                        <th>Address Line 1</th>
                        <td>{{ $booking->checkout->address_first }}</td>
                    </tr>
                    <tr>
                        <th>Address Line 2</th>
                        <td>{{ $booking->checkout->address_last }}</td>
                    </tr>
                    {{-- </table> --}}
                @else
                    <h5> create-contract Details are not Available</h5>
                @endif
                <tr>
                    <th>ID</th>
                    <td>{{ $booking->id }}</td>
                </tr>
                <tr>
                    <th>Car Name</th>
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
                    <th>Status</th>
                    <td>{{ $booking->status }}</td>
                </tr>
                <tr>
                    <th>Payment Method</th>
                    <td>{{ $booking->payment_type == 1 ? 'Stripe' : ($booking->payment_type == 0 ? 'Twint' : 'Unknown') }}
                    </td>
                </tr>
                @if ($booking->is_contract == 2 && $booking->contract)
                    <h4> Contract Details </h4>
                    <tr>
                        <th>License Photo</th>
                        <td><img src="{{ $booking->contract->license_photo }}" alt="License Photo" /></td>
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
                        <td><img src="{{ $booking->contract->customer_signature }}" alt="Customer Signature" /></td>
                    </tr>
                @endif



                {{-- Other details --}}
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
                    <th>Pick Up Date</th>
                    <td>{{ $booking->pickUpDate }}</td>
                </tr>
                <tr>
                    <th>Pick Up Time</th>
                    <td>{{ $booking->pickUpTime }}</td>
                </tr>
                <tr>
                    <th>Collection Time</th>
                    <td>{{ $booking->collectionTime }}</td>
                </tr>
                <tr>
                    <th>Collection Date</th>
                    <td>{{ $booking->collectionDate }}</td>
                </tr>
                <tr>
                    <th>Target Date</th>
                    <td>{{ $booking->targetDate }}</td>
                </tr>
            </table>
            <a href="{{ route('customercontact.index') }}" class="btn btn-primary">Back to List</a>
        </div>
    </div>
@endsection
