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
                    @php
                        $tran = App\Models\Transaction::where('order_id', $booking->id)->first();
                        // dd($tran->payment_method);
                    @endphp
                    <tr>
                        <td>{{ $booking->id }}</td>
                        <td>{{ $booking->total_price }}</td>
                        <td>{{ $booking->pickUpLocation }}</td>
                        <td>{{ $booking->dropOffLocation }}</td>
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
                            <a href="{{ route('completedcontract.show', $booking->id) }}" class="btn btn-primary">Show</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
