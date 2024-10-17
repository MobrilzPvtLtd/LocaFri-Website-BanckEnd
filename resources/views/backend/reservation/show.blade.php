@extends('backend.layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Booking Details</h4>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th scope="col">Booking ID</th>
                    <td>{{ $booking->id }}</td>
                </tr>
                <tr>
                    <th scope="col">Car Name</th>
                    <td>{{ $booking->name }}</td>
                </tr>
                <tr>
                    <th scope="col">Pick Up Location</th>
                    <td>{{ $booking->pickUpLocation }}</td>
                </tr>
                <tr>
                    <th scope="col">Drop Off Location</th>
                    <td>{{ $booking->dropOffLocation }}</td>
                </tr>
                <tr>
                    <th scope="col">Total Price</th>
                    <td>{{ $booking->total_price }}</td>
                </tr>
                <tr>
                    <th scope="col">Status</th>
                    <td>{{ $booking->status }}</td>
                </tr>
                <tr>
                    <th scope="col">Payment Type</th>
                    <td>
                        @if($booking->payment_type == 1)
                            <span>Stripe</span>
                        @elseif($booking->payment_type == 0)
                            <span>Twint</span>
                        @else
                            <span>Unknown</span>
                        @endif
                    </td>
                </tr>

                {{-- Optional fields that were commented off --}}
                <tr>
                    <th scope="col">Pick Up Date</th>
                    <td>{{ $booking->pickUpDate }}</td>
                </tr>
                <tr>
                    <th scope="col">Pick Up Time</th>
                    <td>{{ $booking->pickUpTime }}</td>
                </tr>
                <tr>
                    <th scope="col">Collection Date</th>
                    <td>{{ $booking->collectionDate }}</td>
                </tr>
                <tr>
                    <th scope="col">Collection Time</th>
                    <td>{{ $booking->collectionTime }}</td>
                </tr>
                <tr>
                    <th scope="col">Target Date</th>
                    <td>{{ $booking->targetDate }}</td>
                </tr>
                <tr>
                    <th scope="col">Additional Driver</th>
                    <td>{{ $booking->additional_driver }}</td>
                </tr>
                <tr>
                    <th scope="col">Booster Seat</th>
                    <td>{{ $booking->booster_seat }}</td>
                </tr>
                <tr>
                    <th scope="col">Child Seat</th>
                    <td>{{ $booking->child_seat }}</td>
                </tr>
                <tr>
                    <th scope="col">Exit Permit</th>
                    <td>{{ $booking->exit_permit }}</td>
                </tr>
                <tr>
                    <th scope="col">Day Count</th>
                    <td>{{ $booking->day_count }}</td>
                </tr>
                <tr>
                    <th scope="col">Week Count</th>
                    <td>{{ $booking->week_count }}</td>
                </tr>
                <tr>
                    <th scope="col">Month Count</th>
                    <td>{{ $booking->month_count }}</td>
                </tr>
            </table>
        </div>
        <div class="card-footer">
           <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('reservation.index') }}">Back to Reservations</a>
            </div>
        </div>
    </div>
@endsection
