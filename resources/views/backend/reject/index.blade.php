@extends('backend.layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            {{-- <div class="pull-right mb-2">
                <a class="btn btn-success" href="{{ route('customercontact.create') }}">Create Customercontact</a>
            </div> --}}
            <div class="row mt-4">
                <div class="col">
                    <div class="table-responsive">
                        <table id="datatable" class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Name</th>
                                    {{-- <th scope="col">Dprice</th>
                                    <th scope="col">Wprice</th>
                                    <th scope="col">Mprice</th> --}}
                                    <th scope="col">Total Price</th>
                                    {{-- <th scope="col">Days</th>
                                    <th scope="col">Weeks</th> --}}
                                    {{-- <th scope="col">Months</th> --}}
                                    {{-- <th scope="col">Additional Driver</th> --}}
                                    {{-- <th scope="col">Booster Seat</th> --}}
                                    {{-- <th scope="col">Child Seat</th> --}}
                                    {{-- <th scope="col">Exit Permit</th> --}}
                                    <th scope="col">Pick Up Location</th>
                                    <th scope="col">Drop Off Location</th>
                                    <th scope="col">Pick Up Date</th>
                                    {{-- <th scope="col">Pick Up Time</th> --}}
                                    {{-- <th scope="col">Collection Time</th> --}}
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
                                        <td>{{ $booking->pickUpLocation }}</td>
                                        <td>{{ $booking->dropOffLocation }}</td>
                                        <td>{{ $booking->pickUpDate }}</td>
                                        {{-- <td>{{ $booking->pickUpTime }}</td> --}}
                                        {{-- <td>{{ $booking->collectionTime }}</td> --}}
                                        <td>{{ $booking->collectionDate }}</td>
                                        <td>{{ $booking->targetDate }}</td>
                                        <td>{{ $booking->status }}</td>
                                        <td>
                                            @if ($booking->payment_type == 1)
                                            <span>Stripe</span>
                                        @elseif($booking->payment_type == 0)
                                            <span>Twint</span>
                                        @else
                                            <span>Unknown</span>
                                        @endif
                                    </td>
                                        <td>
                                            <form action="{{ route('reject.addBack', $booking->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-primary btn-sm">Add Back</button>
                                            </form>

                                            <form action="{{ route('customercontact.destroy', $booking->id) }}"
                                                method="POST">
                                                <a class="btn btn-info btn-sm "
                                                    href="{{ route('reject.show', $booking->id) }}">View </a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
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
    </div>
@endsection
