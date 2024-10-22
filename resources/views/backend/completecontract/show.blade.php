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
    <div class="row">
        <div class="col-md-4">
            <div class="card-body">
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
                            <th>Address Line 1</th>
                            <td>{{ $booking->checkout->address_first }}</td>
                        </tr>
                        <tr>
                            <th>Address Line 2</th>
                            <td>{{ $booking->checkout->address_last }}</td>
                        </tr>
                    @else
                        <tr>
                            <td colspan="2">
                                <h5>No Checkout Details Available</h5>
                            </td>
                        </tr>
                    @endif

                    {{-- Contract Details --}}
                    @if ($booking->contract)
                        <tr>
                            <th>Contract ID</th>
                            <td>{{ $booking->contract->id }}</td>
                        </tr>
                        <tr>
                            <th>License Photo</th>
                            <td><img src="{{ asset('storage/' . $booking->contract->license_photo) }}" alt="License Photo" style="max-width: 100px;"></td>
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
                            <td><img src="{{ asset('storage/' . $booking->contract->customer_signature) }}" alt="Customer Signature" style="max-width: 100px;"></td>
                        </tr>
                        <tr>
                            <th>Vehicle Images</th>
                            <td><img src="{{ asset('storage/' . $booking->contract->vehicle_images) }}" alt="Vehicle Image" style="max-width: 100px;"></td>
                        </tr>
                    @else
                        <tr>
                            <td colspan="2">
                                <h5>No Contract Details Available</h5>
                            </td>
                        </tr>
                    @endif

                    {{-- ContractOut Details --}}
                    @if ($booking->contractOut)
                        <tr>
                            <th>ContractOut ID</th>
                            <td>{{ $booking->contractOut->id }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $booking->contractOut->email }}</td>
                        </tr>
                        <tr>
                            <th>Fuel Level</th>
                            <td>{{ $booking->contractOut->fuel_level }}</td>
                        </tr>
                        <tr>
                            <th>Kilometers</th>
                            <td>{{ $booking->contractOut->record_kilometers }}</td>
                        </tr>
                        <tr>
                            <th>Vehicle Damage Comments</th>
                            <td>{{ $booking->contractOut->vehicle_damage_comments }}</td>
                        </tr>
                        <tr>
                            <th>Customer Signature</th>
                            <td><img src="{{ asset('storage/' . $booking->contractOut->customer_signature) }}" alt="Customer Signature" style="max-width: 100px;"></td>
                        </tr>
                        <tr>
                            <th>Odometer Image</th>
                            <td><img src="{{ asset('storage/' . $booking->contractOut->odometer_image) }}" alt="Odometer Image" style="max-width: 100px;"></td>
                        </tr>
                    @else
                        <tr>
                            <td colspan="2">
                                <h5>No ContractOut Details Available</h5>
                            </td>
                        </tr>
                    @endif
                </table>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card-body">
                <table class="table table-bordered">
                    {{-- Booking Information --}}
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
                        <td>
                            @if (isset($tran->payment_method))
                                <span style="background-color: #b1d994;padding: 5px;">
                                    {{ ucwords($tran->payment_method) }}
                                </span>
                            @else
                                <span style="background-color: #e8857d;padding: 5px;">
                                    Unpaid
                                </span>
                            @endif
                        </td>
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
                </table>
            </div>
        </div>
    </div>
@endsection
