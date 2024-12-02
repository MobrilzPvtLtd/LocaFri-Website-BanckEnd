@extends('backend.layouts.app')

@section('content')
    <h4>{{ __('messages.completed_contract') }}</h4>

    @if ($bookings->isEmpty())
        <p>{{ __('messages.no_completed_contract') }}</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th scope="col">{{ __('messages.vehicle_name') }}</th>
                    <th>Total {{ __('messages.price') }}</th>
                    <th>{{ __('messages.pick_up_location') }}</th>
                    <th>{{ __('messages.drop_off_location') }}</th>
                    <th>{{ __('messages.reservation') }} {{ __('messages.status') }}</th>
                    <th>{{ __('messages.payment') }} {{ __('messages.status') }}</th>
                    <th>{{ __('messages.payment_methods') }}</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bookings as $booking)
                    @php
                        $tran = App\Models\Transaction::where('order_id', $booking->id)->first();
                        // dd($tran->payment_method);
                    @endphp
                    {{-- <tr> --}}
                    <tr class="{{ $loop->first ? 'table-primary' : '' }}">
                        <td>{{ $booking->id }}</td>
                        <td>{{ $booking->name }}</td>
                        <td>{{ $booking->total_price }}</td>
                        <td>{{ $booking->pickUpLocation }}</td>
                        <td>{{ $booking->dropOffLocation }}</td>
                        <td>{{ ucwords($booking->status) }}</td>
                        <td>
                            <p>
                                @if ($booking->transaction->full_payment_paid)
                                {{ __('messages.full_paid') }}
                                @else
                                {{ __('messages.partial_paid') }}
                                @endif
                            </p>
                        </td>

                        <td>
                            @if (isset($tran->payment_method))
                                <span style="background-color: #b1d994;padding: 5px;">
                                    {{ ucwords($tran->payment_method) }}
                                </span>
                            @else
                                <span style="background-color: #e8857d;padding: 5px;">
                                    {{ __('messages.unpaid') }}
                                </span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('completedcontract.show', $booking->id) }}"
                                class="btn btn-primary">{{ __('messages.view') }}</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
