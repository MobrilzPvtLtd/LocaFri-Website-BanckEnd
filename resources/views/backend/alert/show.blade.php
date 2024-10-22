@extends('backend.layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <h3>Alert Details</h3>

            <div class="mb-3">
                <strong>ID:</strong> {{ $alert->id }}
            </div>
            <div class="mb-3">
                <strong>Vehicle ID:</strong> {{ $alert->vehicle_id }}
            </div>
            <div class="mb-3">
                <strong>Kilometer:</strong> {{ $alert->kilometer }}
            </div>
            <div class="mb-3">
                <strong>Servicing:</strong> {{ $alert->servicing }}
            </div>
            <div class="mb-3">
                <strong>Status:</strong> {{ $alert->status }}
            </div>

            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('alert.index') }}">Back to Alerts</a>
            </div>
        </div>
    </div>
@endsection
