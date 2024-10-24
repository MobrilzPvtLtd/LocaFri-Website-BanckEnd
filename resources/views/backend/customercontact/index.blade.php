@extends('backend.layouts.app')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4>Accepted Reservations List</h4>
    </div>
        <div class="card-body">
            <div class="row mt-4">
                <div class="col">
                    <div class="table-responsive">
                        <table id="datatable" class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Car Name</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Pick Up Location</th>
                                    <th scope="col">Drop Off Location</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Payment Method</th>
                                    {{-- <th scope="col">Contract Details</th>
                                    <th scope="col">Checkout Details</th>   --}}
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bookings as $booking)
                                    @php
                                        $tran = App\Models\Transaction::where('order_id', $booking->id)->first();
                                        // dd($tran->payment_method);
                                    @endphp
                                    <tr>
                                        <td>{{ $booking->id }}</td>
                                        <td>{{ $booking->name }}</td>
                                        <td>{{ $booking->total_price }}</td>
                                        <td>{{ $booking->pickUpLocation }}</td>
                                        <td>{{ $booking->dropOffLocation }}</td>
                                        <td>{{ $booking->status }}</td>
                                        <td>
                                            @if(isset($tran->payment_method))
                                            <span style="background-color: #b1d994;padding: 5px;">
                                                {{ ucwords($tran->payment_method) }}
                                            </span>
                                            @else
                                            <span style="background-color: #e8857d;padding: 5px;">
                                                Unpaid
                                            </span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($booking->is_contract == 1)
                                                <button type="button" class="btn btn-primary make-contract-btn"
                                                    data-booking-id="{{ $booking->id }}" disabled>
                                                    Contract Created
                                                </button>
                                            @elseif ($booking->is_contract == 2)
                                                <button type="button"
                                                    class="btn btn-success text-white confirm-contract-btn"
                                                    data-booking-id="{{ $booking->id }}">
                                                    Confirm
                                                </button>
                                            @else
                                                <button type="button" class="btn btn-primary make-contract-btn"
                                                    data-booking-id="{{ $booking->id }}">
                                                    Make Contract
                                                </button>
                                            @endif
                                            <a class="btn btn-info btn-md"
                                                href="{{ route('customercontact.show', $booking->id) }}">View Details</a>
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

@push('after-scripts')
    <script>
        $(document).ready(function() {
            // Handle "Make Contract" button
            $('.make-contract-btn').on('click', function() {
                var bookingId = $(this).data('booking-id');
                var button = $(this);

                $.ajax({
                    url: '/api/contract',
                    type: 'POST',
                    data: {
                        booking_id: bookingId,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        console.log(response.booking);
                        if (response.booking.is_contract == 1) {
                            button.text('Contract Created');
                            button.prop('disabled', true);
                        } else {
                            alert('Failed to create contract.');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log('An error occurred: ' + error);
                    }
                });
            });

            // Handle "Confirm" button
            $('.confirm-contract-btn').on('click', function() {
                var bookingId = $(this).data('booking-id');
                var button = $(this); // Reference to the clicked button

                $.ajax({
                    url: '{{ route('confirm.contract') }}', // Define a backend route for contract confirmation
                    type: 'POST',
                    data: {
                        booking_id: bookingId,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        console.log(response);
                        button.text('Confirmed'); // Change button text
                        button.prop('disabled', true); // Disable the button

                        // Show success message
                        $('#success-message').text('Booking confirmed successfully!')
                            .removeClass('d-none');

                        setTimeout(function() {
                            window.location.href =
                                '{{ route('completecontract.index') }}';
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
