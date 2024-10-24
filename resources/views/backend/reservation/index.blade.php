@extends('backend.layouts.app')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4>Reservation Details</h4>
        {{-- <a href="{{ route('reservation.index') }}" class="btn btn-warning btn-sm">
            <i class="fas fa-reply"></i>
        </a> --}}
    </div>
        <div class="card-body">
            {{-- Success message area --}}
            <div id="success-message" class="alert alert-success d-none"></div>

            <div class="row mt-4">
                <div class="col">
                    <div class="table-responsive">
                        <table id="datatable" class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Car Name</th>
                                    <th scope="col">Pick Up Location</th>
                                    <th scope="col">Drop Off Location</th>
                                    {{-- <th scope="col">Dprice</th>
                                    <th scope="col">Wprice</th>
                                    <th scope="col">Mprice</th> --}}
                                    <th scope="col">Total Price</th>
                                    {{-- <th scope="col">Days</th>
                                    <th scope="col">Weeks</th>
                                    <th scope="col">Months</th>
                                    <th scope="col">Additional Driver</th>
                                    <th scope="col">Booster Seat</th>
                                    <th scope="col">Child Seat</th>
                                    <th scope="col">Exit Permit</th> --}}

                                    {{-- <th scope="col">Pick Up Date</th>
                                    <th scope="col">Pick Up Time</th>
                                    <th scope="col">Collection Time</th>
                                    <th scope="col">Collection Date</th>
                                    <th scope="col">Target Date</th> --}}
                                    <th scope="col">Status</th>
                                    <th scope="col">Payment Method</th>
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
                                        <td>{{ $booking->pickUpLocation }}</td>
                                        <td>{{ $booking->dropOffLocation }}</td>
                                        {{-- <td>{{ $booking->Dprice }}</td>
                                        <td>{{ $booking->wprice }}</td>
                                        <td>{{ $booking->mprice }}</td> --}}
                                        <td>{{ $booking->total_price }}</td>
                                        {{-- <td>{{ $booking->day_count }}</td>
                                        <td>{{ $booking->week_count }}</td>
                                        <td>{{ $booking->month_count }}</td>
                                        <td>{{ $booking->additional_driver }}</td>
                                        <td>{{ $booking->booster_seat }}</td>
                                        <td>{{ $booking->child_seat }}</td>
                                        <td>{{ $booking->exit_permit }}</td> --}}

                                        {{-- <td>{{ $booking->pickUpDate }}</td>
                                        <td>{{ $booking->pickUpTime }}</td>
                                        <td>{{ $booking->collectionTime }}</td>
                                        <td>{{ $booking->collectionDate }}</td>
                                        <td>{{ $booking->targetDate }}</td> --}}
                                        <td>{{ ucwords($booking->status) }}</td>
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
                                        <td>
                                            <div class="d-flex flex-column flex-md-row justify-content-between">

                                                <button type="button" class="btn btn-success btn-sm bookingAccept"
                                                    data-booking-id="{{ $booking->id }}">Accept</button>
                                                <a class="btn btn-info btn-sm"
                                                    href="{{ route('reservation.show', $booking->id) }}">View</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm "
                                                    data-booking-id="{{ $booking->id }}" id="is_rejected">Reject</button>


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

@push('after-scripts')
    <script>
        $(document).ready(function() {
            $('.bookingAccept').on('click', function() {
                var bookingId = $(this).data('booking-id');
                var row = $(this).closest('tr');

                $.post('{{ route('booking.accept') }}', {
                    booking_id: bookingId,
                    _token: '{{ csrf_token() }}'
                }).done(function(response) {
                    if (response.status) {
                        $.post('/is_viewbooking', {
                            booking_id: bookingId,
                            _token: '{{ csrf_token() }}'
                        }).done(function() {
                            $('#success-message').text(
                                    'Your booking has been accepted and marked as viewed.')
                                .removeClass('d-none');
                            row.remove();
                            setTimeout(function() {
                                window.location.href =
                                    '{{ route('customercontact.index') }}';
                            }, 2000);
                        }).fail(function(error) {
                            console.error('Error updating is_viewbooking:', error);
                        });
                    }
                }).fail(function(error) {
                    console.error('Error:', error);
                });
            });
        });
        $("#is_rejected").click(function() {
            var bookingId = $(this).data('booking-id'); // Fetch the booking ID
            var row = $(this).closest('tr'); // Get the row element to remove it later

            $.ajax({
                url: '/is_rejected',
                type: 'post',
                data: {
                    booking_id: bookingId,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.status) {
                        // Show success message
                        $('#success-message').text('Your booking has been rejected.')
                            .removeClass('d-none');

                        // Remove the row from the table
                        row.remove();

                        // Redirect to rejected.index after 2 seconds
                        setTimeout(function() {
                            window.location.href = '{{ route('reject.index') }}';
                        }, 2000);
                    } else {
                        console.error('Error rejecting booking:', response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.log('An error occurred: ' + error);
                }
            });
        });
    </script>
@endpush
