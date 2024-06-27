@extends('backend.layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="pull-right mb-2">
                <a class="btn btn-success" href="{{ route('vehiclestatus.create') }}"> Create vehiclestatus</a>
            </div>
            <div class="row mt-4">

                <div class="col">
                    <div class="table-responsive">
                        <table id="datatable" class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Kilometers </th>
                                    <th scope="col"> Fuel Level </th>
                                    <th scope="col"> Damage Records </th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($vehiclestatus as $vehicles)
                                <tr>
                                    <td>{{ $vehicles->id }}</td>
                                    <td>{{ $vehicles->kilometer }}</td>
                                    <td>{{ $vehicles->fule }}</td>
                                    <td>{{ $vehicles->damage }}</td>
                                    <td>
                                        <form action="{{ route('vehiclestatus.destroy', $vehicles->id) }}" method="Post">
                                            <a class="btn btn-primary"
                                                href="{{ route('vehiclestatus.edit', $vehicles->id) }}">Edit</a>
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
