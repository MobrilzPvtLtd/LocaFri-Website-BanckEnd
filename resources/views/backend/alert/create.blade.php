@extends('backend.layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="pull-right mb-2">
                <a class="btn btn-success" href="{{ route('alert.index') }}">{{ __('messages.alerts')}}</a>
            </div>
            <div class="row mt-4">
                <div class="col">
                    <div class="container mt-5">

                        {{-- Create Alert Form --}}
                        <form method="POST" action="{{ route('alert.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                {{-- Vehicle Selection --}}
                                <div class="form-group mb-2 col-4">
                                    <label for="vehicle_id">{{ __('messages.vehicle_name')}}</label>
                                    <select class="form-control" name="vehicle_id" required>
                                        <option value="">Select Vehicle</option>
                                        @foreach ($vehicles as $vehicle)
                                            <option value="{{ $vehicle->id }}" {{ old('vehicle_id') == $vehicle->id ? 'selected' : '' }}>
                                                {{ $vehicle->name }} (ID: {{ $vehicle->id }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('vehicle_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                {{-- Kilometer Input --}}
                                <div class="form-group mb-2 col-4">
                                    <label for="kilometer">Kilometer</label>
                                    <input type="number" class="form-control" name="kilometer" value="{{ old('kilometer') }}" placeholder="Enter kilometer" required>
                                    @error('kilometer')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                {{-- Servicing Input --}}
                                <div class="form-group mb-2 col-4">
                                    <label for="servicing">Servicing</label>
                                    <select class="form-control" name="servicing" required>
                                        <option value="service" {{ old('servicing', 'service') == 'service' ? 'selected' : '' }}>{{ __('messages.servicing')}}</option>
                                        <option value="platesCheck" {{ old('servicing') == 'platesCheck' ? 'selected' : '' }}>{{ __('messages.plates_check')}}</option>
                                        <option value="breakesCheck" {{ old('servicing') == 'breakesCheck' ? 'selected' : '' }}>{{ __('messages.brakes_check')}}</option>
                                    </select>

                                    {{-- <input type="text" class="form-control" name="servicing" value="{{ old('servicing') }}" placeholder="Enter servicing details" required> --}}
                                    @error('servicing')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                {{-- Status Input --}}
                                <div class="form-group mb-2 col-4">
                                    <label for="status">{{ __('messages.status')}}</label>
                                    <select class="form-control" name="status" required>
                                        <option value="pending" {{ old('status', 'pending') == 'pending' ? 'selected' : '' }}>{{ __('messages.pending')}}</option>
                                        <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>{{ __('messages.completed')}}</option>
                                    </select>
                                    @error('status')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            {{-- Submit Button --}}
                            <button type="submit" class="btn btn-primary">{{ __('messages.submit')}}</button>
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
