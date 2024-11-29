@extends('backend.layouts.app')

@section('content')
<div class="card">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>{{ __('messages.vehicle_detail')}}</h4>
            <a href="{{ route('vehicle.index') }}" class="btn btn-warning btn-sm">
                <i class="fas fa-reply"></i>
            </a>
        </div>
    <div class="card-body">
        <div class="pull-right mb-2">
            <a class="btn btn-success" href="{{ route('vehicle.index') }}">{{ __('messages.back')}}</a>
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
                    <li class="list-group-item"><strong>{{ __('messages.model')}}:</strong> {{ $vehicle->model }}</li>
                    <li class="list-group-item"><strong>Type:</strong> {{ $vehicle->type }}</li>
                    <li class="list-group-item"><strong>{{ __('messages.description')}}:</strong> {{ $vehicle->desc }}</li>
                    <li class="list-group-item"><strong>{{ __('messages.location')}}:</strong> {{ $vehicle->location }}</li>
                    <li class="list-group-item"><strong>Mileage:</strong> {{ number_format($vehicle->mitter, 2) }} km</li>
                    <li class="list-group-item"><strong>{{ __('messages.body')}}:</strong> {{ $vehicle->body }}</li>
                    <li class="list-group-item"><strong>{{ __('messages.seats')}}:</strong> {{ $vehicle->seat }}</li>
                    <li class="list-group-item"><strong>{{ __('messages.doors')}}:</strong> {{ $vehicle->door }}</li>
                    <li class="list-group-item"><strong>{{ __('messages.luggage')}}:</strong> {{ $vehicle->luggage }}</li>
                    <li class="list-group-item"><strong>{{ __('messages.fuel')}} Type:</strong> {{ $vehicle->fuel }}</li>
                    <li class="list-group-item"><strong>{{ __('messages.price')}} ({{ __('messages.daily')}}):</strong> CHF {{ number_format($vehicle->Dprice, 2) }}</li>
                    <li class="list-group-item"><strong>{{ __('messages.price')}} ({{ __('messages.weekly')}}):</strong> CHF {{ number_format($vehicle->wprice, 2) }}</li>
                    <li class="list-group-item"><strong>{{ __('messages.price')}}   ({{ __('messages.monthly')}}):</strong> CHF {{ number_format($vehicle->mprice, 2) }}</li>
                    <li class="list-group-item"><strong>{{ __('messages.permitted_kilometers_day')}} ({{ __('messages.daily')}}):</strong> Kms {{ number_format($vehicle->permitted_kilometers_day) }}</li>
                    <li class="list-group-item"><strong>{{ __('messages.permitted_kilometers_week')}} ({{ __('messages.weekly')}}):</strong>Kms {{ number_format($vehicle->permitted_kilometers_week) }}</li>
                    <li class="list-group-item"><strong>{{ __('messages.permitted_kilometers_month')}} ({{ __('messages.monthly')}}):</strong> kms {{ number_format($vehicle->permitted_kilometers_month) }}</li>
                    <li class="list-group-item"><strong>{{ __('messages.status')}}:</strong> {{ $vehicle->status ? 'Available' : 'Not Available' }}</li>

                </ul>
            </div>
        </div>

        <div class="mt-4">
            <h4>{{ __('messages.features')}}</h4>
            <p>{{ $vehicle->features }}</p>
        </div>

        <div class="mt-4">
            <h4>{{ __('messages.additional_information')}}</h4>
            <ul class="list-group">
                <li class="list-group-item"><strong>{{ __('messages.exterior_color')}}:</strong> {{ $vehicle->exterior }}</li>
                <li class="list-group-item"><strong>{{ __('messages.interior_color')}}:</strong> {{ $vehicle->interior }}</li>
                <li class="list-group-item"><strong>Transmission:</strong> {{ $vehicle->trans }}</li>
                <li class="list-group-item"><strong> {{ __('messages.authentication')}}:</strong> {{ $vehicle->auth }}</li>
            </ul>
        </div>
    </div>
</div>
@endsection
