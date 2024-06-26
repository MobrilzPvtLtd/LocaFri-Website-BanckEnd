@extends('backend.layouts.app')

@section('content')
    <div class="card">
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
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    {{-- <th scope="col">Phone</th>
                                    <th scope="col">Subject</th> --}}
                                    <th scope="col">Message</th>
                                    {{-- <th scope="col">Action</th> --}}
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
