@extends('backend.layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="pull-right mb-2">
                <a class="btn btn-success" href="{{ route('alert.create') }}">{{ __('messages.complete_contract')}}</a>
            </div>
            <div class="row mt-4">
                <div class="col">
                    <div class="table-responsive">
                        <table id="datatable" class="table table-hover">
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
                                    {{-- <th scope="col">{{ __('messages.complete_contract')}}Payment Status</th> --}}
                                    {{-- <th scope="col">Contract Status</th>
                                    <th scope="col">Checkout Info</th> --}}
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
                                        <td>{{ $booking->name }}</td>
                                        <td>{{ $booking->total_price }}</td>
                                        <td>{{ $booking->pickUpLocation }}</td>
                                        <td>{{ $booking->dropOffLocation }}</td>
                                        <td>
                                        @if ($booking->is_confirm == 1)
                                            {{ __('messages.check_in_accepted') }}
                                        @elseif ($booking->is_confirm == 2)
                                            {{ __('messages.checkout_submitted') }}
                                        @else
                                        {{ __('messages.pending') }}
                                        @endif</td>

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
                                        {{-- <td>{{ $tran->payment_status}}</td> --}}

                                        <td>
                                            @if($booking->is_confirm == 2)
                                                <button type="button" class="btn btn-success text-white complete-contract-btn" data-booking-id="{{ $booking->id }}" value="complete">
                                                    {{ __('messages.complete') }}
                                                </button>
                                            @endif
                                            <a class="btn btn-info btn-md"
                                                href="{{ route('completecontract.show', $booking->id) }}"> {{ __('messages.view_details') }}</a>
                                            {{-- <a class="btn btn-primary btn-md"
                                                href="{{ route('completecontract.edit', $booking->id) }}">Edit Details</a> --}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-7">
                    <div class="float-left">
                        {{-- Add any pagination or additional content here --}}
                    </div>
                </div>
                <div class="col-5">
                    <div class="float-end">
                        {{-- Add any action buttons if needed --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('after-scripts')
    <script>
        $(document).ready(function() {
            $('.complete-contract-btn').on('click', function() {
                var bookingId = $(this).data('booking-id');
                var btnVal = $(this).val();
                var button = $(this);

                $.ajax({
                    url: '{{ route('confirm.contract') }}',
                    type: 'POST',
                    data: {
                        booking_id: bookingId,
                        btnVal: btnVal,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        // if (response.is_complete == 1) {
                        //     window.location.href = '{{ route('completedcontract.index') }}';
                        // }
                        setTimeout(function() {
                            window.location.href =
                                '{{ route('completedcontract.index') }}';
                        }, 2000);
                    },
                    error: function(xhr, status, error) {
                        console.log('An error occurred: ' + error);
                    }
                });
            });
        });
    </script>
@endpush
