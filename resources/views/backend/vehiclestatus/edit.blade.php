@extends('backend.layouts.app')

@section('content')
    <div class="card">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4>Edit Vehicle Status </h4>
                <a href="{{ route('vehiclestatus.index') }}" class="btn btn-warning btn-sm">
                    <i class="fas fa-reply"></i>
                </a>
            </div>
            <div class="card-body">
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('vehiclestatus.index') }}" enctype="multipart/form-data">
                        Back</a>
                </div>
                <div class="row mt-4">
                    <div class="col">
                        <div class="container mt-5">
                            <form method="post" action="{{ route('vehiclestatus.update', $vehiclestatus->id) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row mb-3">
                                    <div class="form-group col-md-4">
                                        <label for="vehicle_id">{{ __('messages.vehicle_name')}}</label>
                                        <select name="vehicle_id" class="form-control" required>
                                            <option value="" disabled>Select Vehicle</option>
                                            @foreach ($vehicles as $vehicle)
                                                <option value="{{ $vehicle->id }}"
                                                    {{ $vehiclestatus->vehicle_id == $vehicle->id ? 'selected' : '' }}>
                                                    {{ $vehicle->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group mb-2 col-4">
                                        <label for="city">Kilometers</label>
                                        <input type="number" class="form-control" name="kilometer"
                                            value="{{ $vehiclestatus->kilometer }}" placeholder="">
                                    </div>
                                    <div class="form-group mb-2 col-4">
                                        <label for="city">{{ __('messages.fuel_level')}}</label>
                                        <input type="Number" class="form-control" name="fule"
                                            value="{{ $vehiclestatus->fule }}" placeholder="">
                                    </div>
                                    <div class="form-group mb-2 col-4">
                                        <label for="city">{{ __('messages.damage_records')}}</label>
                                        <textarea type="text" class="form-control" name="damage" value="" placeholder="">{{ $vehiclestatus->damage }}</textarea>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">{{ __('messages.submit')}}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-7">
                        <div class="float-left">

                        </div>
                    </div>
                    <div class="col-5">
                        <div class="float-end">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
