@extends('backend.layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row mt-4">
                <div class="col">
                    <div class="table-responsive">
                        <table id="datatable" class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Dprice</th>
                                    <th scope="col">Wprice</th>
                                    <th scope="col">Mprice</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Days</th>
                                    <th scope="col">Weeks</th>
                                    <th scope="col">Months</th>
                                    <th scope="col">Additional Driver</th>
                                    <th scope="col">Booster Seat</th>
                                    <th scope="col">Child Seat</th>
                                    <th scope="col">Exit Permit</th>
                                    <th scope="col">Pick Up Location</th>
                                    <th scope="col">Drop Off Location</th>
                                    <th scope="col">Pick Up Date</th>
                                    <th scope="col">Pick Up Time</th>
                                    <th scope="col">Collection Time</th>
                                    <th scope="col">Collection Date</th>
                                    <th scope="col">Target Date</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Payment Type</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bookings as $booking)
                                    <tr>
                                        <td>{{ $booking->id }}</td>
                                        <td>{{ $booking->name }}</td>
                                        <td>{{ $booking->Dprice }}</td>
                                        <td>{{ $booking->wprice }}</td>
                                        <td>{{ $booking->mprice }}</td>
                                        <td>{{ $booking->total_price }}</td>
                                        <td>{{ $booking->day_count }}</td>
                                        <td>{{ $booking->week_count }}</td>
                                        <td>{{ $booking->month_count }}</td>
                                        <td>{{ $booking->additional_driver }}</td>
                                        <td>{{ $booking->booster_seat }}</td>
                                        <td>{{ $booking->child_seat }}</td>
                                        <td>{{ $booking->exit_permit }}</td>
                                        <td>{{ $booking->pickUpLocation }}</td>
                                        <td>{{ $booking->dropOffLocation }}</td>
                                        <td>{{ $booking->pickUpDate }}</td>
                                        <td>{{ $booking->pickUpTime }}</td>
                                        <td>{{ $booking->collectionTime }}</td>
                                        <td>{{ $booking->collectionDate }}</td>
                                        <td>{{ $booking->targetDate }}</td>
                                        <td>{{ $booking->status }}</td>
                                        <td>{{ $booking->payment_type }}</td>
                                        <td>
                                            <button type="button" class="btn btn-success btn-sm bookingAccept"
                                                data-booking-id="{{ $booking->id }}">Accept</button>
                                            <a class="btn btn-primary btn-sm" href="#">Keybox</a>
                                            <form action="{{ route('enquiry.destroy', $booking->id) }}" method="POST"
                                                style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                                            </form>
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
                        <!-- Any additional content you want to add -->
                    </div>
                </div>
                <div class="col-5">
                    <div class="float-end">
                        <!-- Any additional content you want to add -->
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

                $.ajax({
                    type: 'POST',
                    url: '{{ route('reservation.accept') }}',
                    data: {
                        booking_id: bookingId,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        console.log('Success:', response);
                        if (response.status) {
                            window.location.href = '{{ route('reservation.index') }}';
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                    }
                });
            });
        });
    </script>
@endpush
