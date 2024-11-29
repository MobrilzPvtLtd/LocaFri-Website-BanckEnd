@extends('backend.layouts.app')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>{{ __('messages.vehicle_status_details')}}</h4>
        </div>
        <div class="card-body">
            <div class="pull-right mb-2">
                <a class="btn btn-success" href="{{ route('vehiclestatus.create') }}">{{ __('messages.create_vehicle_status')}}</a>
            </div>
            <div class="row mt-4">
                <div class="col">
                    <div class="table-responsive">
                        <table id="datatable" class="table table-hover">
                            <thead>
                                <tr>
                                    {{-- <th scope="col">ID</th> --}}
                                    <th scope="col">{{ __('messages.vehicle_name')}} </th>
                                    <th scope="col">Kilometers</th>
                                    <th scope="col">{{ __('messages.fuel_level')}}</th>
                                    <th scope="col">{{ __('messages.damage_records')}}</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($vehiclestatus as $status)
                                    <tr>
                                        {{-- <td>{{ $status->id }}</td> --}}
                                        <td>{{ $status->vehicle ? $status->vehicle->name : 'No Vehicle Assigned' }}</td>
                                        <td>{{ $status->kilometer }}</td>
                                        <td>{{ $status->fule }}</td>
                                        <td>{{ $status->damage }}</td>
                                        <td>
                                            <form action="{{ route('vehiclestatus.destroy', $status->id) }}" method="POST">
                                                <a class="btn btn-primary"
                                                    href="{{ route('vehiclestatus.edit', $status->id) }}">{{ __('messages.edit')}} </a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">{{ __('messages.delete')}}</button>
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
