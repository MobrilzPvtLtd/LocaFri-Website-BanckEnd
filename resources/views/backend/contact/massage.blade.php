@extends('backend.layouts.app')

@section('content')
    <div class="card">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4>{{ __('messages.contact_inquiries_details') }}</h4>
            </div>
            <div class="card-body">
                {{-- <div class="pull-right mb-2">
                <a class="btn btn-success" href="{{ route('country.create') }}"> Create Country</a>
            </div> --}}
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
                                        <th scope="col">Action</th>

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
                                            <td>{{ $contact->message }}</td>
                                            <td>{{ $contact->created_at->format('d M Y (h:i a)') }}</td>
                                            {{-- <td>
                                                <form action="{{ route('contacts.update', $contact->id) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <select name="status"
                                                        class="form-select text-white {{ $contact->status == 'open' ? 'bg-danger' : 'bg-success' }}"
                                                        onchange="this.form.submit()">
                                                        <option value="open"
                                                            {{ $contact->status == 'open' ? 'selected' : '' }}>
                                                            Open
                                                        </option>
                                                        <option value="close"
                                                            {{ $contact->status == 'close' ? 'selected' : '' }}>
                                                            Close
                                                        </option>
                                                    </select>
                                                </form>
                                            </td> --}}
                                            <td>
                                                <form action="{{ route('contacts.update', $contact->id) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <select name="status"
                                                        class="form-select text-white {{ $contact->status == 'open' ? 'bg-danger' : ($contact->status == 'close' ? 'bg-success' : '') }}"
                                                        style="width: 120px;" onchange="this.form.submit()">
                                                        <option value="open"
                                                            {{ $contact->status == 'open' ? 'selected' : '' }}>{{ __('messages.open') }}</option>
                                                        <option value="close"
                                                            {{ $contact->status == 'close' ? 'selected' : '' }}>{{ __('messages.close') }}
                                                        </option>
                                                    </select>
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
