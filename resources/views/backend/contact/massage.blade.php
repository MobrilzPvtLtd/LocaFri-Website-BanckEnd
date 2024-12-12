@extends('backend.layouts.app')

@section('content')
    <div class="card">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4>{{ __('messages.contact_inquiries_details') }}</h4>

                <a href="{{ route('contact.trash') }}" class="btn btn-warning">
                    <i class="fas fa-share fa-fw"></i> View Archives
                </a>
            </div>
            <div class="card-body">
                <div class="row mt-4">
                    <div class="col">
                        <div class="table-responsive">
                            <table id="datatable" class="table table-hover">
                                <thead>
                                    <tr>
                                        {{-- <th scope="col">Id</th> --}}
                                        <th scope="col">{{ __('messages.name') }}</th>
                                        <th scope="col">Email</th>
                                        {{-- <th scope="col">Phone</th>
                                        <th scope="col">Subject</th> --}}
                                        <th scope="col">{{ __('messages.message') }}</th>

                                        <th scope="col">{{ __('messages.date_time') }}</th>
                                        <th scope="col">{{ __('messages.status') }}</th>
                                        {{-- <th scope="col"> Actions</th> --}}

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($contacts as $contact)
                                        <tr>
                                            {{-- <td>{{ $contacts->id }}</td> --}}
                                            <td>{{ $contact->name }}</td>
                                            <td>{{ $contact->email }}</td>
                                            {{-- <td>{{ $contact->phone }}</td>
                                            <td>{{ $contact->sub }}</td> --}}
                                            {{-- <td>{{ $contact->message }}</td> --}}
                                            <td class="text-truncate" style="max-width: 300px;">{{ $contact->message }}</td>
                                            <td>{{ $contact->created_at->format('d M Y (h:i a)') }}</td>
                                            <td>
                                                <form action="{{ route('contact.update', $contact->id) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <select name="status"
                                                        class="form-select text-white {{ $contact->status == 'open' ? 'bg-success' : 'bg-danger' }}"
                                                        onchange="this.form.submit()">
                                                        <option value="open"
                                                            {{ $contact->status == 'open' ? 'selected' : '' }}>Open
                                                        </option>
                                                        <option value="close"
                                                            {{ $contact->status == 'close' ? 'selected' : '' }}>Close
                                                        </option>
                                                    </select>
                                                </form>
                                            </td>
                                            {{-- <td>
                                                <div class="card-footer text-end">

                                                    <a class="btn btn-info btn-sm "
                                                        href="{{ route('contact.view', $contact->id) }}">{{ __('messages.view') }}
                                                    </a>
                                                </div>
                                            </td> --}}
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
