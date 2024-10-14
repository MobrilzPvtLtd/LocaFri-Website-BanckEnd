@extends('backend.layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="pull-right mb-2">
                <a class="btn btn-success" href="{{ route('alerrt.create') }}"> Create Alert</a>
            </div>
            <div class="row mt-4">
                <div class="col">
                    <div class="table-responsive">
                        <table id="datatable" class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Vehicle</th>
                                    <th scope="col">Kilometer</th>
                                    <th scope="col">Servicing</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($alerrts as $alerrt)
                                    <tr>
                                        <td>{{ $alerrt->id }}</td>
                                        {{-- Display related vehicle's name or plate number instead of vehicle_id --}}
                                        <td>{{ $alerrt->vehicle->name ?? 'No vehicle' }}</td>
                                        <td>{{ $alerrt->kilometer }}</td>
                                        <td>{{ $alerrt->servicing }}</td>
                                        <td>{{ $alerrt->status }}</td>
                                        <td>
                                            <form action="{{ route('alerrt.destroy', $alerrt->id) }}" method="POST">
                                                <a class="btn btn-primary" href="{{ route('alerrt.edit', $alerrt->id) }}">Edit</a>
                                                {{-- <a class="btn btn-primary" href="{{ route('alerrt.show', $alerrt->id) }}">View</a> --}}
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
                    <div class="float-left"></div>
                </div>
                <div class="col-5">
                    <div class="float-end"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
