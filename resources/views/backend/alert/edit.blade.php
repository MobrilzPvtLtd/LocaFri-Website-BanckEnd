@extends('backend.layouts.app')

@section('content')
    <div class="card">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4>Edit Alert</h4>
                <a href="{{ route('alert.index') }}" class="btn btn-warning btn-sm">
                    <i class="fas fa-reply"></i>
                </a>
            </div>
        {{-- <div class="card-body">
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('alert.index') }}" enctype="multipart/form-data">
                    Back
                </a>
            </div> --}}
            <div class="row mt-4">
                <div class="col">
                    <div class="container mt-5">
                        <form method="post" action="{{ route('alert.update', $alert->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="form-group mb-2 col-4">
                                    <label for="vehicle_id">Vehicle</label>
                                    <select class="form-control" name="vehicle_id" required>
                                        <option value="">Select Vehicle</option>
                                        @foreach ($vehicles as $vehicle)
                                            <option value="{{ $vehicle->id }}" {{ $alert->vehicle_id == $vehicle->id ? 'selected' : '' }}>
                                                {{ $vehicle->name }} (ID: {{ $vehicle->id }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-2 col-4">
                                    <label for="kilometer">Kilometer</label>
                                    <input type="number" class="form-control" name="kilometer" value="{{ $alert->kilometer }}" required>
                                </div>
                                <div class="form-group mb-2 col-4">
                                    <label for="servicing">Servicing</label>
                                    {{-- <input type="text" class="form-control" name="servicing" value="{{ $alert->servicing }}" required> --}}
                                    <select class="form-control" name="servicing" required>
                                        <option value="service" {{ $alert->servicing == 'service' ? 'selected' : '' }}>servicing</option>
                                        <option value="platesCheck" {{ $alert->servicing == 'platesCheck' ? 'selected' : '' }}>Plates Check</option>
                                        <option value="breakesCheck" {{ $alert->servicing == 'breakesCheck' ? 'selected' : '' }}>Brakes Check</option>
                                    </select>
                                </div>
                                <div class="form-group mb-2 col-4">
                                    <label for="status">Status</label>
                                    <select class="form-control" name="status" required>
                                        <option value="pending" {{ $alert->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="completed" {{ $alert->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                    </select>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary  m-2">Submit</button>
                        </form>
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
