@extends('backend.layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="pull-right mb-2">
                <a class="btn btn-success" href="{{ route('reservation.create') }}"> Create Reservation</a>
            </div>
            <div class="row mt-4">

                <div class="col">
                    <div class="table-responsive">
                        <table id="datatable" class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Reservation ID</th>
                                    <th scope="col">Customer Name </th>
                                    <th scope="col"> Vehicle Details </th>
                                    <th scope="col"> Rental Date start </th>
                                    <th scope="col"> Rental Date End </th>
                                    <th scope="col"> Contact Method</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reservations as $reservation)
                                <tr>
                                    <td>{{ $reservation->id }}</td>
                                    <td>{{ $reservation->name }}</td>
                                    <td>{{ $reservation->details }}</td>
                                    <td>{{ $reservation->start }}</td>
                                    <td>{{ $reservation->end }}</td>
                                    <td>{{ $reservation->method }}</td>
                                    <td>
                                        <form action="{{ route('reservation.destroy', $reservation->id) }}" method="Post">
                                            <a class="btn btn-primary"
                                                href="{{ route('reservation.edit', $reservation->id) }}">Edit</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
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
