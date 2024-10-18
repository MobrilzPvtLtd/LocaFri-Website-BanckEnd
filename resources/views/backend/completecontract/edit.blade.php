@extends('backend.layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <h4>Edit CheckedIn details</h4>

            <form action="{{ route('completecontract.update', $booking->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Checkout Details --}}
                @if ($booking->checkout)
                    {{-- <h5>Checkout Details</h5> --}}
                    <div class="form-group">
                        <label for="checkout_first_name">First Name</label>
                        <input type="text" class="form-control" id="checkout_first_name" name="checkout_first_name"
                            value="{{ old('checkout_first_name', $booking->checkout->first_name) }}">
                    </div>

                    <div class="form-group">
                        <label for="checkout_last_name">Last Name</label>
                        <input type="text" class="form-control" id="checkout_last_name" name="checkout_last_name"
                            value="{{ old('checkout_last_name', $booking->checkout->last_name) }}">
                    </div>

                    <div class="form-group">
                        <label for="checkout_email">Email</label>
                        <input type="email" class="form-control" id="checkout_email" name="checkout_email"
                            value="{{ old('checkout_email', $booking->checkout->email) }}">
                    </div>

                    <div class="form-group">
                        <label for="checkout_address_first">Address First Line</label>
                        <input type="text" class="form-control" id="checkout_address_first" name="checkout_address_first"
                            value="{{ old('checkout_address_first', $booking->checkout->address_first) }}">
                    </div>

                    <div class="form-group">
                        <label for="checkout_address_last">Address Last Line</label>
                        <input type="text" class="form-control" id="checkout_address_last" name="checkout_address_last"
                            value="{{ old('checkout_address_last', $booking->checkout->address_last) }}">
                    </div>
                @endif

                {{-- Contract Details --}}
                @if ($booking->contract)
                    {{-- <h5>Contract Details</h5> --}}
                    <div class="form-group">
                        <label for="postal_code">Postal Code</label>
                        <input type="text" class="form-control" id="postal_code" name="postal_code"
                            value="{{ old('postal_code', $booking->contract->postal_code) }}">
                    </div>

                    <div class="form-group">
                        <label for="email">Contract Email</label>
                        <input type="email" class="form-control" id="email" name="email"
                            value="{{ old('email', $booking->contract->email) }}">
                    </div>

                    <div class="form-group">
                        <label for="license_photo">License Photo</label>
                        <input type="file" class="form-control-file" id="license_photo" name="license_photo">
                        <img src="{{ $booking->contract->license_photo }}" alt="License Photo" width="100">
                    </div>

                    <div class="form-group">
                        <label for="record_kilometers">Record Kilometers</label>
                        <input type="number" class="form-control" id="record_kilometers" name="record_kilometers"
                            value="{{ old('record_kilometers', $booking->contract->record_kilometers) }}">
                    </div>

                    <div class="form-group">
                        <label for="fuel_level">Fuel Level</label>
                        <input type="text" class="form-control" id="fuel_level" name="fuel_level"
                            value="{{ old('fuel_level', $booking->contract->fuel_level) }}">
                    </div>

                    <div class="form-group">
                        <label for="vehicle_damage_comments">Vehicle Damage Comments</label>
                        <textarea class="form-control" id="vehicle_damage_comments" name="vehicle_damage_comments">{{ old('vehicle_damage_comments', $booking->contract->vehicle_damage_comments) }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="customer_signature">Customer Signature</label>
                        <input type="file" class="form-control-file" id="customer_signature" name="customer_signature">
                        <img src="{{ $booking->contract->customer_signature }}" alt="Customer Signature" width="100">
                    </div>
                @endif
                {{-- Booking Details --}}
                {{-- <h5>Booking Details</h5> --}}
                <div class="form-group">
                    <label for="name">Booking Name</label>
                    <input type="text" class="form-control" id="name" name="name"
                        value="{{ old('name', $booking->name) }}">
                </div>

                <div class="form-group">
                    <label for="total_price">Total Price</label>
                    <input type="number" class="form-control" id="total_price" name="total_price"
                        value="{{ old('total_price', $booking->total_price) }}">
                </div>

                <div class="form-group">
                    <label for="pickUpLocation">Pick Up Location</label>
                    <input type="text" class="form-control" id="pickUpLocation" name="pickUpLocation"
                        value="{{ old('pickUpLocation', $booking->pickUpLocation) }}">
                </div>

                <div class="form-group">
                    <label for="dropOffLocation">Drop Off Location</label>
                    <input type="text" class="form-control" id="dropOffLocation" name="dropOffLocation"
                        value="{{ old('dropOffLocation', $booking->dropOffLocation) }}">
                </div>

                <div class="form-group">
                    <label for="pickUpDate">Pick Up Date</label>
                    <input type="date" class="form-control" id="pickUpDate" name="pickUpDate"
                        value="{{ old('pickUpDate', $booking->pickUpDate) }}">
                </div>

                <div class="form-group">
                    <label for="pickUpTime">Pick Up Time</label>
                    <input type="time" class="form-control" id="pickUpTime" name="pickUpTime"
                        value="{{ old('pickUpTime', $booking->pickUpTime) }}">
                </div>

                <div class="form-group">
                    <label for="collectionDate">Collection Date</label>
                    <input type="date" class="form-control" id="collectionDate" name="collectionDate"
                        value="{{ old('collectionDate', $booking->collectionDate) }}">
                </div>

                <div class="form-group">
                    <label for="collectionTime">Collection Time</label>
                    <input type="time" class="form-control" id="collectionTime" name="collectionTime"
                        value="{{ old('collectionTime', $booking->collectionTime) }}">
                </div>

                <div class="form-group">
                    <label for="targetDate">Target Date</label>
                    <input type="date" class="form-control" id="targetDate" name="targetDate"
                        value="{{ old('targetDate', $booking->targetDate) }}">
                </div>

                <div class="form-group">
                    <label for="Dprice">Daily Price</label>
                    <input type="number" class="form-control" id="Dprice" name="Dprice"
                        value="{{ old('Dprice', $booking->Dprice) }}">
                </div>

                <div class="form-group">
                    <label for="wprice">Weekly Price</label>
                    <input type="number" class="form-control" id="wprice" name="wprice"
                        value="{{ old('wprice', $booking->wprice) }}">
                </div>

                <div class="form-group">
                    <label for="mprice">Monthly Price</label>
                    <input type="number" class="form-control" id="mprice" name="mprice"
                        value="{{ old('mprice', $booking->mprice) }}">
                </div>

                <div class="form-group">
                    <label for="day_count">Day Count</label>
                    <input type="number" class="form-control" id="day_count" name="day_count"
                        value="{{ old('day_count', $booking->day_count) }}">
                </div>

                <div class="form-group">
                    <label for="week_count">Week Count</label>
                    <input type="number" class="form-control" id="week_count" name="week_count"
                        value="{{ old('week_count', $booking->week_count) }}">
                </div>

                <div class="form-group">
                    <label for="month_count">Month Count</label>
                    <input type="number" class="form-control" id="month_count" name="month_count"
                        value="{{ old('month_count', $booking->month_count) }}">
                </div>

                <div class="form-group">
                    <label for="additional_driver">Additional Driver</label>
                    <input type="text" class="form-control" id="additional_driver" name="additional_driver"
                        value="{{ old('additional_driver', $booking->additional_driver) }}">
                </div>

                <div class="form-group">
                    <label for="booster_seat">Booster Seat</label>
                    <input type="text" class="form-control" id="booster_seat" name="booster_seat"
                        value="{{ old('booster_seat', $booking->booster_seat) }}">
                </div>

                <div class="form-group">
                    <label for="child_seat">Child Seat</label>
                    <input type="text" class="form-control" id="child_seat" name="child_seat"
                        value="{{ old('child_seat', $booking->child_seat) }}">
                </div>

                <div class="form-group">
                    <label for="exit_permit">Exit Permit</label>
                    <input type="text" class="form-control" id="exit_permit" name="exit_permit"
                        value="{{ old('exit_permit', $booking->exit_permit) }}">
                </div>

                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="confirmed" {{ $booking->status == 'confirmed' ? 'selected' : '' }}>Confirmed
                        </option>
                        <option value="completed" {{ $booking->status == 'completed' ? 'selected' : '' }}>Completed
                        </option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="payment_type">Payment Method</label>
                    <select name="payment_type" id="payment_type" class="form-control">
                        <option value="1" {{ $booking->payment_type == 1 ? 'selected' : '' }}>Stripe</option>
                        <option value="0" {{ $booking->payment_type == 0 ? 'selected' : '' }}>Twint</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Update Booking</button>
            </form>
        </div>
    </div>
@endsection
