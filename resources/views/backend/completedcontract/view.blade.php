@extends('backend.layouts.app')

@section('content')
    <div class="card">
        <div class="d-flex justify-content-between">
            <div class="align-self-center">
                <h4 class="card-title p-1">{{ __('messages.completed_contract')}} {{ __('messages.details')}}</h4>
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
                <h5 class="mt-4">{{ __('messages.booking_information') }}</h5>
                @if ($booking->checkout)
                <p><strong>{{ __('messages.first_name') }}:</strong> {{ $booking->checkout->first_name }}</p>
                <p><strong>{{ __('messages.last_name') }}:</strong> {{ $booking->checkout->last_name }}</p>
                <p><strong>Email:</strong> {{ $booking->checkout->email }}</p>
                <p><strong>{{ __('messages.adresse_1') }}:</strong> {{ $booking->checkout->address_first }}</p>
                <p><strong>{{ __('messages.adresse_2') }}:</strong> {{ $booking->checkout->address_last }}</p>
            @else
                <h5>{{ __('messages.create_contract_details_not_available') }}</h5>
            @endif
            <p><strong>{{ __('messages.vehicle_name') }}:</strong> {{ $booking->name }}</p>
            <p><strong>{{ __('messages.pick_up_location') }}:</strong> {{ $booking->pickUpLocation }}</p>
            <p><strong>{{ __('messages.drop_off_location') }}:</strong> {{ $booking->dropOffLocation }}</p>
            <p><strong>{{ __('messages.reservation') }} {{ __('messages.status') }}:</strong>
                    @if ($booking->is_contract == 1)
                    {{ __('messages.submit_check_in') }}
                    @elseif ($booking->is_contract == 2)
                    {{ __('messages.check_in_submitted') }}
                    @else
                    {{ __('messages.accepted_bookings') }}
                    @endif
                </p>
                <p><strong>Total {{ __('messages.price') }}:</strong> CHF {{ $booking->total_price }}</p>

                <p><strong>{{ __('messages.payment_methods') }}:</strong>
                    @if (isset($booking->transaction->payment_method))
                        <span style="background-color: #b1d994;padding: 5px;">
                            {{ ucwords($booking->transaction->payment_method) }}
                        </span>
                    @else
                        <span style="background-color: #e8857d;padding: 5px;">
                            {{ __('messages.unpaid') }}
                        </span>
                    @endif
                </p>

                @if ($booking->transaction)
                    <p><strong>{{ __('messages.payment') }} {{ __('messages.status') }}:</strong>
                        @if ($booking->transaction->full_payment_paid)
                        {{ __('messages.full_paid') }}
                        @else
                        {{ __('messages.partial_paid') }}
                        @endif
                    </p>

                    <p><strong>{{ __('messages.amount_paid') }}:</strong> CHF
                        {{ number_format($booking->transaction->full_payment_paid ? $booking->total_price : $booking->transaction->amount, 2) }}
                    </p>

                    <p><strong>{{ __('messages.remaining_amount') }}:</strong> CHF
                        {{ $booking->transaction->full_payment_paid ? '0.00' : number_format($booking->transaction->remaining_amount, 2) }}
                    </p>
                @endif

                <p><strong>{{ __('messages.additional_driver') }}:</strong> CHF {{ $booking->additional_driver }}
                </p>
                <p><strong>{{ __('messages.booster_seat') }}:</strong> CHF {{ $booking->booster_seat }}</p>
                <p><strong>{{ __('messages.child_seat') }}:</strong> CHF {{ $booking->child_seat }}</p>
                <p><strong>{{ __('messages.exit_permit') }}:</strong> CHF {{ $booking->exit_permit }}</p>
                <p><strong>{{ __('messages.daily') }} {{ __('messages.price') }}:</strong> CHF
                    {{ $booking->Dprice }}</p>
                <p><strong>{{ __('messages.weekly') }} {{ __('messages.price') }}:</strong> CHF
                    {{ $booking->wprice }}</p>
                <p><strong>{{ __('messages.monthly') }} {{ __('messages.price') }}:</strong> CHF
                    {{ $booking->mprice }}</p>
                <p><strong>{{ __('messages.days_count') }}:</strong> {{ $booking->day_count }}</p>
                <p><strong>{{ __('messages.weeks_count') }}:</strong> {{ $booking->week_count }}</p>
                <p><strong>{{ __('messages.months_count') }}:</strong> {{ $booking->month_count }}</p>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card-body">
                <h5>{{ __('messages.contract_details') }}</h5>
                @if ($booking->is_contract == 2 && $booking->ContractIn)
                    <p><strong>{{ __('messages.postal_code') }}:</strong> {{ $booking->ContractIn->postal_code }}</p>
                    <p><strong>{{ __('messages.license_photo') }}:</strong></p>
                    <img src="{{ $booking->ContractIn->license_photo }}" alt="License Photo"
                        style="max-width: 100%; height: auto;" />
                    <p><strong>{{ __('messages.record_kilometers') }}:</strong> {{ $booking->ContractIn->record_kilometers }}</p>
                    <p><strong>{{ __('messages.fuel_level') }}:</strong> {{ $booking->ContractIn->fuel_level }}</p>
                    <p><strong>{{ __('messages.vehicle_damage_comments') }}:</strong> {{ $booking->ContractIn->vehicle_damage_comments }}
                    </p>
                    <p><strong>{{ __('messages.customer_signature') }}:</strong></p>
                    <img src="{{ $booking->ContractIn->customer_signature }}" alt="Customer Signature"
                        style="max-width: 100%; height: auto;" />
                @else
                    <p>{{ __('messages.no_contract_details_available') }}</p>
                @endif
                <h5 class="mt-4"><strong>{{ __('messages.contract_out') }} {{ __('messages.details') }}</strong></h5>
                @if ($booking->contractOut)
                    <p><strong>{{ __('messages.contract_out_id') }}:</strong> {{ $booking->contractOut->id }}</p>
                    <p><strong>Email:</strong> {{ $booking->contractOut->email }}</p>
                    <p><strong>{{ __('messages.fuel_level') }}:</strong> {{ $booking->contractOut->fuel_level }}</p>
                    <p><strong>Kilometers:</strong> {{ $booking->contractOut->record_kilometers }}</p>
                    <p><strong>{{ __('messages.vehicle_damage_comments') }}:</strong> {{ $booking->contractOut->vehicle_damage_comments }}
                    </p>
                    <p><strong>{{ __('messages.customer_signature') }}:</strong> <img
                            src="{{ asset('storage/' . $booking->contractOut->customer_signature) }}"
                            alt="Customer Signature" style="max-width: 100px;"></p>
                    <p><strong>{{ __('messages.odometer_image') }}:</strong> <img
                            src="{{ asset('storage/' . $booking->contractOut->odometer_image) }}" alt="Odometer Image"
                            style="max-width: 100px;"></p>
                @else
                    <p><strong>{{ __('messages.no_contract_out_details') }}</strong></p>
                @endif

                </div>
            </div>
        </div>
    </div>
    <br>
@endsection
