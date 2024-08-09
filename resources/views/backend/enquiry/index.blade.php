@extends('backend.layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            {{-- <div class="pull-right mb-2">
                <a class="btn btn-success" href="{{ route('country.create') }}"> Create Country</a>
            </div> --}}
            <div class="row mt-4">
                <div class="col">
                    <div class="table-responsive">
                        <table id="datatable" class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col"> Name</th>
                                    <th scope="col">Dprice</th>
                                    <th scope="col">Wprice</th>
                                    <th scope="col">Mprice</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Days</th>
                                    <th scope="col">Weeks</th>
                                    <th scope="col">Months</th>
                                    <th scope="col">additional_driver</th>
                                    <th scope="col">booster_seat</th>
                                    <th scope="col">child_seat</th>
                                    <th scope="col">exit_permit</th>
                                    <th scope="col">pickUpLocation</th>
                                    <th scope="col">dropOffLocation</th>
                                    <th scope="col">pickUpDate</th>
                                    <th scope="col">pickUpTime</th>
                                    <th scope="col">collectionTime</th>
                                    <th scope="col">collectionDate</th>
                                    <th scope="col">targetDate</th>
                                    <th scope="col">status</th>
                                    <th scope="col">payment_type</th>
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
                                            {{-- <form action="{{ route('reservation.accept') }}" method="POST"
                                                style="display: inline;">
                                                @csrf
                                                <input type="hidden" name="booking_id" value="{{ $booking->id }}">
                                            </form> --}}
                                            <button type="button" id="bookingAccept" class="btn btn-success btn-sm" data-booking-id="{{ $booking->id }}">Accept</button>

                                            <a class="btn btn-primary btn-sm" href="">Keybox</a>
                                            <form action="" method="POST" style="display: inline;">
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
            $('#bookingAccept').on('click', function() {
                var bookingId = $(this).data('booking-id');
                console.log('Booking ID:', bookingId);

                $.ajax({
                    type: 'POST',
                    url: '{{ route('reservation.accept') }}',
                    data: {
                        booking_id: bookingId, // Adjust key if necessary
                        _token: '{{ csrf_token() }}' // Include CSRF token for Laravel
                    },
                    success: function(response) {
                        console.log('Success:', response);
                        // Handle success scenario, e.g., show a message or update UI
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                        // Handle error scenario, e.g., show an error message
                    }
                });
            });
        });

    </script>
@endpush
