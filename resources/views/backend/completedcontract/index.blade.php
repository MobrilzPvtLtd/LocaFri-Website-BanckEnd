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
                    {{-- <th>Details</th> --}}
                    {{-- <th>Booking Details</th> --}}
                    {{-- <th>Checkout Details</th> --}}
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
                    {{-- Only display bookings where the status is 'successful' --}}
                    @if ($booking->status == 'successful')
                        <tr>
                            {{-- contractOut ID --}}
                            <td>
                                {{-- Check if contractOut is available --}}
                                @if ($booking->contractOut)
                                    {{ $booking->contractOut->id }}
                                @else
                                @endif
                            </td>
                            <td>{{ $booking->total_price }}</td>
                            <td>{{ $booking->pickUpLocation }}</td>
                            <td>{{ $booking->dropOffLocation }}</td>
                            <td>{{ $booking->status }}</td>
                            <td>
                                @if ($booking->payment_type == 1)
                                    Stripe
                                @elseif($booking->payment_type == 0)
                                    Twint
                                @else
                                    Unknown
                                @endif
                            </td>

                            {{-- Action --}}
                            <td>
                                <a href="{{ route('completedcontract.show', $booking->id) }}" class="btn btn-primary">Show</a>

                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
