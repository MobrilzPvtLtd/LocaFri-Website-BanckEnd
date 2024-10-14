@extends('backend.layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <h3>Alert Details</h3>

            <div class="mb-3">
                <strong>ID:</strong> {{ $alerrt->id }}
            </div>
            <div class="mb-3">
                <strong>Vehicle ID:</strong> {{ $alerrt->vehicle_id }}
            </div>
            <div class="mb-3">
                <strong>Kilometer:</strong> {{ $alerrt->kilometer }}
            </div>
            <div class="mb-3">
                <strong>Servicing:</strong> {{ $alerrt->servicing }}
            </div>
            <div class="mb-3">
                <strong>Status:</strong> {{ $alerrt->status }}
            </div>

            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('alerrt.index') }}">Back to Alerts</a>
            </div>
        </div>
    </div>
@endsection
