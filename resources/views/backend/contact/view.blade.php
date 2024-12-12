@extends('backend.layouts.app')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>{{ __('Contact Messages') }}</h4>
            <a href="{{ route('contact.index') }}" class="btn btn-warning">
                <i class="fas fa-reply fa-fw"></i>
            </a>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5><strong>Name:</strong> {{ $contact->name }}</h5>
                    <h5><strong>Email:</strong> {{ $contact->email }}</h5>
                    <h5><strong>Status:</strong>
                        <span class="badge {{ $contact->status == 'open' ? 'bg-success' : 'bg-danger' }}">
                            {{ ucfirst($contact->status) }}
                        </span>
                    </h5>
                </div>
                <div class="col-md-6">
                    <h5><strong>Date & Time:</strong> {{ $contact->created_at->format('d M Y (h:i a)') }}</h5>
                </div>
            </div>

            <hr>

            <h5 class="mt-4"><strong>Message:</strong></h5>
            <p class="border p-3 rounded" style="white-space: pre-line;">{{ $contact->message }}</p>
        </div>

        <div class="card-footer text-end">
            <a href="{{ route('contact.trash', $contact->id) }}" class="btn btn-danger">
                <i class="fas fa-trash fa-fw"></i> Move to Archives
            </a>
        </div>
    </div>
@endsection
