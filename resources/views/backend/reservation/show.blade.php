@extends('backend.layouts.app')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Reservation Details</h4>
            <a href="{{ route('reservation.index') }}" class="btn btn-warning btn-sm">
                <i class="fas fa-reply"></i>
            </a>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5>{{ __('messages.booking_information') }}</h5>
                    @php
                        // Fetch the transaction linked to the booking
                        $tran = App\Models\Transaction::where('order_id', $booking->id)->first();
                    @endphp

                    @if ($booking->checkout)
                        <p><strong>{{ __('messages.first_name') }}:</strong> {{ $booking->checkout->first_name }}</p>
                        <p><strong>{{ __('messages.last_name') }}:</strong> {{ $booking->checkout->last_name }}</p>
                        <p><strong>Email:</strong> {{ $booking->checkout->email }}</p>
                        <p><strong>{{ __('messages.adresse_1') }}:</strong> {{ $booking->checkout->address_first }}</p>
                        <p><strong>{{ __('messages.adresse_1') }}:</strong> {{ $booking->checkout->address_last }}</p>
                    @else
                        <h5>{{ __('messages.create_contract_details_not_available') }}</h5>
                    @endif

                    {{-- <p><strong>Booking ID:</strong> {{ $booking->id }}</p> --}}
                    <p><strong>{{ __('messages.vehicle_name') }}:</strong> {{ $booking->name }}</p>
                    <p><strong>{{ __('messages.pick_up_location') }}:</strong> {{ $booking->pickUpLocation }}</p>
                    <p><strong>{{ __('messages.drop_off_location') }}:</strong> {{ $booking->dropOffLocation }}</p>
                    <p><strong>{{ __('messages.reservation') }} {{ __('messages.status') }}:</strong> {{ ucwords($booking->status) }}</p>
                    <p><strong>Total Price:</strong> CHF {{ $booking->total_price }}</p>

                    <p><strong>{{ __('messages.payment_methods') }}:</strong>
                        @if (isset($tran->payment_method))
                            <span style="background-color: #b1d994; padding: 5px;">
                                {{ ucwords($tran->payment_method) }}
                            </span>
                        @else
                            <span style="background-color: #e8857d; padding: 5px;">
                                {{ __('messages.unpaid') }}
                            </span>
                        @endif
                    </p>
                    @if ($booking->transaction)
                        <p><strong>{{ __('messages.payment')}} {{ __('messages.status')}}:</strong>
                            @if ($booking->transaction->full_payment_paid)
                                <span class="">{{ __('messages.full_paid')}}</span>
                            @else
                                <span class="">{{ __('messages.partial_paid')}}</span>
                            @endif
                        </p>

                        <p><strong>{{ __('messages.amount_paid')}}:</strong>
                            CHF
                            {{ number_format($booking->transaction->full_payment_paid ? $booking->total_price : $booking->transaction->amount, 2) }}
                        </p>

                        <p><strong>{{ __('messages.remaining_amount')}}:</strong>
                            CHF
                            {{ $booking->transaction->full_payment_paid ? '0.00' : number_format($booking->transaction->remaining_amount, 2) }}
                        </p>
                    @endif

                </div>

                <div class="col-md-6">
                    <h5>{{ __('messages.additional_booking_information')}}</h5>
                    <p><strong>{{ __('messages.pick_up_date') }}:</strong>
                        {{ \Carbon\Carbon::parse($booking->pickUpDate)->format('d M Y') }}
                    </p>
                    <p><strong>{{ __('messages.pick_up_time') }}:</strong>
                        {{ \Carbon\Carbon::parse($booking->pickUpTime)->format('h:i A') }}
                    </p>
                    <p><strong>{{ __('messages.collection_date') }}:</strong>
                        {{ \Carbon\Carbon::parse($booking->collectionDate)->format('d M Y') }}
                    </p>
                    <p><strong>{{ __('messages.collection_time') }}:</strong>
                        {{ \Carbon\Carbon::parse($booking->collectionTime)->format('h:i A') }}
                    </p>
    
                    <p><strong>{{ __('messages.additional_driver')}}:</strong> {{ $booking->additional_driver }}</p>
                    <p><strong>{{ __('messages.booster_seat')}}:</strong> {{ $booking->booster_seat }}</p>
                    <p><strong>{{ __('messages.child_seat')}}:</strong> {{ $booking->child_seat }}</p>
                    <p><strong>{{ __('messages.exit_permit')}}:</strong> {{ $booking->exit_permit }}</p>
                    <p><strong>{{ __('messages.daily')}} {{ __('messages.price')}}:</strong> CHF {{ $booking->Dprice }}</p>
                    <p><strong>{{ __('messages.weekly')}} {{ __('messages.price')}}:</strong>CHF {{ $booking->wprice }}</p>
                    <p><strong>{{ __('messages.monthly')}} {{ __('messages.price')}}:</strong>CHF {{ $booking->mprice }}</p>
                    <p><strong>{{ __('messages.days_count')}}:</strong> {{ $booking->day_count }}</p>
                    <p><strong>{{ __('messages.weeks_count')}}:</strong> {{ $booking->week_count }}</p>
                    <p><strong>{{ __('messages.months_count')}}:</strong> {{ $booking->month_count }}</p>
                </div>


            </div>
            {{-- <div class="mt-4">
                <a href="{{ route('reservation.index') }}" class="btn btn-secondary">Back to List</a>
            </div> --}}
        </div>
    </div>
@endsection
