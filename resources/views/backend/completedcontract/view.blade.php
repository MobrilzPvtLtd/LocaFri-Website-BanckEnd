@extends('backend.layouts.app')

@section('content')
    <div class="card">
        <div class="d-flex justify-content-between">
            <div class="align-self-center">
                <h4 class="card-title p-1">
                    Completed Contract Details
                </h4>
            </div>
            <a href="{{ route('completedcontract.index') }}" class="btn btn-warning"><i class="fas fa-reply fa-fw"></i></a>
        </div>
    </div>
<br>
    <div class="row">
        <div class="col-md-6">
            <div class="card-body">
                <h5><strong>User's Details</strong></h5>
                @if ($booking->checkout)
                    <table class="table">
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
                    </table>
                @endif
                  <br>
                @if ($booking->transaction)
                    <h5><strong>Transaction Details</strong></h5>
                    <table class="table">
                        <tr>
                            <th>Transaction ID</th>
                            <td>{{ $booking->transaction->id }}</td>
                        </tr>
                        <tr>
                            <th>Amount</th>
                            <td>CHF {{ number_format($booking->transaction->amount, 2) }}</td>
                        </tr>
                        <tr>
                            <th>Remaining Amount</th>
                            <td>CHF {{ $booking->transaction->remaining_amount }}</td>
                        </tr>
                        <tr>
                            <th>Currency</th>
                            <td>{{ $booking->transaction->currency }}</td>
                        </tr>
                        <tr>
                            <th>Payment Method</th>
                            <td>{{ $booking->transaction->payment_method }}</td>
                        </tr>
                        <tr>
                            <th>Payment Status</th>
                            <td>{{ $booking->transaction->payment_status }}</td>
                        </tr>
                        {{-- <tr>
                            <th>Full Payment Paid</th>
                            <td>{{ $booking->transaction->full_payment_paid }}</td>
                        </tr> --}}
                    </table>
                @endif
            </div>
        </div>
         <br>
        <div class="col-md-6">
            <div class="card-body">
                <h5><strong>ContractIn Details</strong></h5>
                @if ($booking->is_contract == 2 && $booking->ContractIn)
                    <table class="table">
                        <tr>
                            <th>Postal Code</th>
                            <td>{{ $booking->ContractIn->postal_code }}</td>
                        </tr>
                        <tr>
                            <th>License Photo</th>
                            <td><img src="{{ asset('storage/' . $booking->ContractIn->license_photo) }}" alt="License Photo" style="max-width: 100px;"></td>
                        </tr>
                        <tr>
                            <th>Record Kilometers</th>
                            <td>{{ $booking->ContractIn->record_kilometers }}</td>
                        </tr>
                        <tr>
                            <th>Fuel Level</th>
                            <td>{{ $booking->ContractIn->fuel_level }}</td>
                        </tr>
                        <tr>
                            <th>Vehicle Damage Comments</th>
                            <td>{{ $booking->ContractIn->vehicle_damage_comments }}</td>
                        </tr>
                        <tr>
                            <th>Customer Signature</th>
                            <td><img src="{{ asset('storage/' . $booking->ContractIn->customer_signature) }}" alt="Customer Signature" style="max-width: 100px;"></td>
                        </tr>
                    </table>
                @else
                    <p>No ContractIn Details Available</p>
                @endif
                <br>
                <h5><strong>ContractOut Details</strong></h5>
                @if ($booking->ContractOut)
                    <table class="table">
                        <tr>
                            <th>ContractOut ID</th>
                            <td>{{ $booking->ContractOut->id }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $booking->ContractOut->email }}</td>
                        </tr>
                        <tr>
                            <th>Fuel Level</th>
                            <td>{{ $booking->ContractOut->fuel_level }}</td>
                        </tr>
                        <tr>
                            <th>Kilometers</th>
                            <td>{{ $booking->ContractOut->record_kilometers }}</td>
                        </tr>
                        <tr>
                            <th>Vehicle Damage Comments</th>
                            <td>{{ $booking->ContractOut->vehicle_damage_comments }}</td>
                        </tr>
                        <tr>
                            <th>Customer Signature</th>
                            <td>
                                @if ($booking->ContractOut->customer_signature)
                                    <img src="{{ asset('storage/' . $booking->ContractOut->customer_signature) }}" alt="Customer Signature" style="max-width: 100px;">
                                @else
                                    No signature available
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Fuel Image</th>
                            <td>
                                @if ($booking->ContractOut->fuel_image)
                                    <img src="{{ asset('storage/' . $booking->ContractOut->fuel_image) }}" alt="Fuel Image" style="max-width: 100px;">
                                @else
                                    No fuel image available
                                @endif
                            </td>
                        </tr>
                    </table>
                @else
                    <p>No ContractOut Details Available</p>
                @endif
            </div>
        </div>
    </div>
<br>
    <div class="row">
        <div class="col-md-12">
            <div class="card-body">
                <h5><strong>Booking Information</strong></h5>
                <table class="table">
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
                        <td>{{ $booking->payment_type == 1 ? 'Stripe' : ($booking->payment_type == 0 ? 'Twint' : 'Unknown') }}</td>
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
                    {{-- <tr>
                        <th>Target Date</th>
                        <td>{{ $booking->targetDate }}</td>
                    </tr>
                    <tr>
                        <th>Target Time</th>
                        <td>{{ $booking->targetTime }}</td>
                    </tr> --}}
                </table>
            </div>
        </div>
    </div>
@endsection
