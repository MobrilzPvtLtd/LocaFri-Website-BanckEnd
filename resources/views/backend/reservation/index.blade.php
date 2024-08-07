@extends('backend.layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            {{-- <div class="pull-right mb-2">
                <a class="btn btn-success" href="{{ route('reservation.create') }}"> Create Reservation</a>
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
                                @if (Session::has('success'))
                                    <div class="alert alert-success">
                                        {{ Session::get('success') }}
                                    </div>
                                @endif
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
                                        {{-- <form action="{{ route('reservation.destroy', $reservation->id) }}" method="Post">
                                            <a class="btn btn-primary"
                                                href="{{ route('reservation.edit', $reservation->id) }}">Edit</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form> --}}
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
