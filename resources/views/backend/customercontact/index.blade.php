@extends('backend.layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="pull-right mb-2">
                <a class="btn btn-success" href="{{ route('customercontact.create') }}"> Create Customercontact</a>
            </div>
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
                                @foreach ($customercontacts as $customer)
                                    <tr>
                                        {{-- <td>{{ $customer->id }}</td>
                                        <td>{{ $customer->name }}</td>
                                        <td>{{ $customer->email }}</td>
                                        <td>{{ $customer->phone }}</td>
                                        <td>{{ $customer->address }}</td>
                                        <td>{{ $customer->massage }}</td> --}}
                                        <td>
                                            <form action="{{ route('customercontact.destroy', $customer->id) }}"
                                                method="Post">
                                                <a class="btn btn-primary"
                                                    href="{{ route('customercontact.edit', $customer->id) }}">Make Contract</a>
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
