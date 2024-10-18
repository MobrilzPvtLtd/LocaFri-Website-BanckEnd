@extends('backend.layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="pull-right mb-2">
                <a class="btn btn-success" href="{{ route('alerrt.create') }}">Complete Contract</a>
            </div>
            <div class="row mt-4">
                <div class="col">
                    <div class="table-responsive">
                        <table id="datatable" class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Total Price</th>
                                    <th scope="col">Pick Up Location</th>
                                    <th scope="col">Drop Off Location</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Payment Method</th>
                                    {{-- <th scope="col">Contract Status</th>
                                    <th scope="col">Checkout Info</th> --}}
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bookings as $booking)
                                    <tr>
                                        <td>{{ $booking->id }}</td>
                                        <td>{{ $booking->name }}</td>
                                        <td>{{ $booking->total_price }}</td>
                                        <td>{{ $booking->pickUpLocation }}</td>
                                        <td>{{ $booking->dropOffLocation }}</td>
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
                                            <a class="btn btn-info btn-md"
                                                href="{{ route('completecontract.show', $booking->id) }}">View Details</a>
                                            <a class="btn btn-primary btn-md"
                                                href="{{ route('completecontract.edit', $booking->id) }}">Edit Details</a>

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
