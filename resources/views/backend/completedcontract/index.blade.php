@extends('backend.layouts.app')

@section('content')
    <h4>Completed Contracts</h4>

    @if ($bookings->isEmpty())
        <p>No completed contracts found.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Total Price</th>
                    <th>Pick Up Location</th>
                    <th>Drop Off Location</th>
                    <th>Status</th>
                    <th>Payment Method</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bookings as $booking)
                    <tr>
                        <td>{{ $booking->id }}</td>
                        <td>{{ $booking->total_price }}</td>
                        <td>{{ $booking->pickUpLocation }}</td>
                        <td>{{ $booking->dropOffLocation }}</td>
                        <td>{{ $booking->status }}</td>
                        <td>
                            @if ($booking->payment_type == 0)
                                Stripe
                            @elseif($booking->payment_type == 1)
                                Twint
                            @else
                                Unknown
                            @endif
                        </td>

                        <td>
                            <a href="{{ route('completedcontract.show', $booking->id) }}" class="btn btn-primary">Show</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
