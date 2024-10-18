@extends('backend.layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="pull-right mb-2">
                <a class="btn btn-success" href="{{ route('vehicle.create') }}"> Create Vehicle</a>
            </div>
            <div class="row mt-4">

                <div class="col">
                    <div class="table-responsive">
                        <table id="datatable" class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Company</th>
                                    <th scope="col">Model</th>
                                    <th scope="col">Type</th>
                                    {{-- <th scope="col">Description</th> --}}
                                    <th scope="col">Location</th>

                                    <th scope="col">Kilometers</th>
                                    {{-- <th scope="col">Body</th> --}}
                                    {{-- <th scope="col">Seat</th> --}}
                                    {{-- <th scope="col">Door</th> --}}
                                    {{-- <th scope="col">Luggage</th> --}}
                                    {{-- <th scope="col">Fuel Type</th> --}}
                                    {{-- <th scope="col">Authorized</th>
                                    <th scope="col">Transmission</th>
                                    <th scope="col">Exterior Color</th>
                                    <th scope="col">Interior Color</th>--}}
                                    {{-- <th scope="col">features</th> --}}
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($vehicles as $vehicle)
                                    <tr>
                                        <td>{{ $vehicle->id }}</td>
                                        <td>
                                            {{-- @php
                                                $images = unserialize($vehicle->image);
                                            @endphp
                                            @if (!empty($images) && is_array($images) && count($images) > 0)
                                                <img src="{{ asset('public/' . $images[0]) }}" alt="Image"
                                                    class="img-fluid w-100">
                                            @else
                                                <p>No images available</p>
                                            @endif --}}
                                            @if($vehicle->image)
                                                @php
                                                    $images = json_decode($vehicle->image);
                                                @endphp

                                                @if($images && count($images) > 0)
                                                    <img src="{{ asset('public/storage/' . $images[0]) }}" alt="vehicle" class="img-fluid" width="80px">
                                                @endif
                                            @endif
                                        </td>
                                        <td>{{ $vehicle->name }}</td>
                                        <td>{{ $vehicle->model }}</td>
                                        <td>{{ $vehicle->type }}</td>
                                        {{-- <td>{{ $vehicle->desc }}</td> --}}
                                        <td>{{ $vehicle->location }}</td>

                                        <td>{{ $vehicle->mitter }}</td>
                                        {{-- <td>{{ $vehicle->body }}</td>
                                        <td>{{ $vehicle->seat }}</td>
                                        <td>{{ $vehicle->door }}</td>
                                        <td>{{ $vehicle->luggage }}</td>
                                        <td>{{ $vehicle->fuel }}</td>
                                        <td>{{ $vehicle->auth }}</td>
                                        <td>{{ $vehicle->trans }}</td>
                                        <td>{{ $vehicle->exterior }}</td>
                                        <td>{{ $vehicle->interior }}</td> --}}
                                        {{-- <td>
                                            @php
                                                $featuresArray = json_decode($vehicle->features);
                                            @endphp
                                            @if (!empty($featuresArray))
                                                <ul>
                                                    @foreach ($featuresArray as $feature)
                                                        <li>{{ $feature }}</li>
                                                    @endforeach
                                                </ul>
                                            @else
                                                <p>No features available</p>
                                            @endif
                                        </td> --}}

                                        <td>
                                            @if ($vehicle->status == 1)
                                                Active
                                            @else
                                                Inactive
                                            @endif
                                        </td>
                                        <td>
                                            <form action="{{ route('vehicle.destroy', $vehicle->id) }}" method="Post">
                                                   <a class="btn btn-primary btn-sm"
                                                    href="{{ route('vehicle.edit', $vehicle->id) }}">Edit</a>
                                                    <a class="btn btn-info  btn-sm"
                                                    href="{{ route('vehicle.show', $vehicle->id) }}">View</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
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
