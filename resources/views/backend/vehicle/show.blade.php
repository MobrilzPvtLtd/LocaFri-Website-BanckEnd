@extends('backend.layouts.app')

@section('content')
<div class="card">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Vehicle Details</h4>
            <a href="{{ route('vehicle.index') }}" class="btn btn-warning btn-sm">
                <i class="fas fa-reply"></i>
            </a>
        </div>
    <div class="card-body">
        <div class="pull-right mb-2">
            <a class="btn btn-success" href="{{ route('vehicle.index') }}">Back to Vehicle List</a>
        </div>
        <h2 class="card-title">{{ $vehicle->name }}</h2>

        <div class="row mt-4">
            <div class="col-md-4">
                @if ($vehicle->image)
                    <img src="{{ asset($vehicle->image) }}" alt="{{ $vehicle->name }}" class="img-fluid">
                @else
                    <img src="{{ asset('images/default-vehicle.png') }}" alt="Default Vehicle Image" class="img-fluid">
                @endif
            </div>
            <div class="col-md-8">
                <ul class="list-group">
                    <li class="list-group-item"><strong>Model:</strong> {{ $vehicle->model }}</li>
                    <li class="list-group-item"><strong>Type:</strong> {{ $vehicle->type }}</li>
                    <li class="list-group-item"><strong>Description:</strong> {{ $vehicle->desc }}</li>
                    <li class="list-group-item"><strong>Location:</strong> {{ $vehicle->location }}</li>
                    <li class="list-group-item"><strong>Mileage:</strong> {{ number_format($vehicle->mitter, 2) }} km</li>
                    <li class="list-group-item"><strong>Body:</strong> {{ $vehicle->body }}</li>
                    <li class="list-group-item"><strong>Seats:</strong> {{ $vehicle->seat }}</li>
                    <li class="list-group-item"><strong>Doors:</strong> {{ $vehicle->door }}</li>
                    <li class="list-group-item"><strong>Luggage Capacity:</strong> {{ $vehicle->luggage }}</li>
                    <li class="list-group-item"><strong>Fuel Type:</strong> {{ $vehicle->fuel }}</li>
                    <li class="list-group-item"><strong>Price (Daily):</strong> ${{ number_format($vehicle->Dprice, 2) }}</li>
                    <li class="list-group-item"><strong>Price (Weekly):</strong> ${{ number_format($vehicle->wprice, 2) }}</li>
                    <li class="list-group-item"><strong>Price (Monthly):</strong> ${{ number_format($vehicle->mprice, 2) }}</li>
                    <li class="list-group-item"><strong>Permitted Kilometer (Daily):</strong> ${{ number_format($vehicle->permitted_kilometers_day, 2) }}</li>
                    <li class="list-group-item"><strong>Permitted Kilometer (Weekly):</strong> ${{ number_format($vehicle->permitted_kilometers_week, 2) }}</li>
                    <li class="list-group-item"><strong>Permitted Kilometer (Monthly):</strong> ${{ number_format($vehicle->permitted_kilometers_month, 2) }}</li>
                    <li class="list-group-item"><strong>Status:</strong> {{ $vehicle->status ? 'Available' : 'Not Available' }}</li>

                </ul>
            </div>
        </div>

        <div class="mt-4">
            <h4>Features</h4>
            <p>{{ $vehicle->features }}</p>
        </div>

        <div class="mt-4">
            <h4>Additional Information</h4>
            <ul class="list-group">
                <li class="list-group-item"><strong>Exterior Color:</strong> {{ $vehicle->exterior }}</li>
                <li class="list-group-item"><strong>Interior Color:</strong> {{ $vehicle->interior }}</li>
                <li class="list-group-item"><strong>Transmission:</strong> {{ $vehicle->trans }}</li>
                <li class="list-group-item"><strong>Authentication:</strong> {{ $vehicle->auth }}</li>
            </ul>
        </div>
    </div>
</div>
@endsection
