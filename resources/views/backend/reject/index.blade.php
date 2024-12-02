@extends('backend.layouts.app')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>{{ __('messages.list_rejected_reservation') }}</h4>
            {{-- <a href="{{ route('reservation.index') }}" class="btn btn-warning btn-sm">
            <i class="fas fa-reply"></i> --}}
            {{-- </a> --}}
        </div>
        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table id="datatable" class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">{{ __('messages.user_name') }}</th>
                                <th scope="col">{{ __('messages.vehicle_name') }}</th>
                                {{-- <th scope="col">Dprice</th>
                                    <th scope="col">Wprice</th>
                                    <th scope="col">Mprice</th> --}}
                                {{-- <th scope="col">Days</th>
                                <th scope="col">Weeks</th> --}}
                                {{-- <th scope="col">Months</th> --}}
                                {{-- <th scope="col">Additional Driver</th> --}}
                                {{-- <th scope="col">Booster Seat</th> --}}
                                {{-- <th scope="col">Child Seat</th> --}}
                                {{-- <th scope="col">Exit Permit</th> --}}
                                <th scope="col">{{ __('messages.pick_up_location') }}</th>
                                <th scope="col">{{ __('messages.drop_off_location') }}</th>
                                <th scope="col">Total {{ __('messages.price') }}</th>
                                {{-- <th scope="col">Pick Up Date</th> --}}
                                {{-- <th scope="col">Pick Up Time</th> --}}
                                {{-- <th scope="col">Collection Time</th> --}}
                                {{-- <th scope="col">Collection Date</th> --}}
                                {{-- <th scope="col">Target Date</th> --}}
                                 <th scope="col">{{ __('messages.reservation') }} {{ __('messages.status') }}</th>
                                <th scope="col">{{ __('messages.payment_methods') }}</th>
                                <th scope="col">Action</th>
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
                                    <td>{{ $booking->checkout->first_name ?? 'N/A' }}
                                        {{ $booking->checkout->last_name ?? '' }}</td>
                                    <td>{{ $booking->name }}</td>
                                    {{-- <td>{{ $booking->Dprice }}</td>
                                        <td>{{ $booking->wprice }}</td>
                                        <td>{{ $booking->mprice }}</td> --}}

                                    {{-- <td>{{ $booking->day_count }}</td>
                                        <td>{{ $booking->week_count }}</td>
                                        <td>{{ $booking->month_count }}</td>
                                        <td>{{ $booking->additional_driver }}</td>
                                        <td>{{ $booking->booster_seat }}</td>
                                        <td>{{ $booking->child_seat }}</td>
                                        <td>{{ $booking->exit_permit }}</td> --}}
                                    <td>{{ $booking->pickUpLocation }}</td>
                                    <td>{{ $booking->dropOffLocation }}</td>
                                    <td>{{ $booking->total_price }}</td>
                                    {{-- <td>{{ $booking->pickUpDate }}</td> --}}
                                    {{-- <td>{{ $booking->pickUpTime }}</td> --}}
                                    {{-- <td>{{ $booking->collectionTime }}</td> --}}
                                    {{-- <td>{{ $booking->collectionDate }}</td> --}}
                                    {{-- <td>{{ $booking->targetDate }}</td> --}}
                                    <td>
                                        {{-- <p><strong>Reservation Status:</strong> --}}
                                            @if ($booking->is_rejected == 1)
                                            {{ __('messages.rejected') }}
                                            @else
                                            {{ __('messages.pending') }}
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
                                        <div class="d-flex flex-column flex-md-row justify-content-between">
                                            <form action="{{ route('reject.addBack', $booking->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-primary btn-sm">  {{ __('messages.addBack') }}</button>
                                            </form>
                                            <form action="{{ route('customercontact.destroy', $booking->id) }}"
                                                method="POST">
                                                <a class="btn btn-info btn-sm "
                                                    href="{{ route('reject.show', $booking->id) }}">{{ __('messages.view') }} </a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">{{ __('messages.delete') }}</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
