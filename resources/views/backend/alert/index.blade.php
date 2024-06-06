@extends('backend.layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="pull-right mb-2">
                <a class="btn btn-success" href="{{ route('alert.create') }}"> Create Alert</a>
            </div>
            <div class="row mt-4">

                <div class="col">
                    <div class="table-responsive">
                        <table id="datatable" class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Alert ID</th>
                                    <th scope="col">Service </th>
                                    <th scope="col">Plates Change</th>
                                    <th scope="col">Brakes Check </th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($alerts as $alert)
                                    <tr>
                                        <td>{{ $alert->id }}</td>
                                        <td>{{ $alert->service }}</td>
                                        <td>{{ $alert->plates }}</td>
                                        <td>{{ $alert->brakes }}</td>

                                        <td>
                                            <form action="{{ route('alert.destroy', $alert->id) }}" method="Post">
                                                <a class="btn btn-primary"
                                                    href="{{ route('alert.edit', $alert->id) }}">Edit</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
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
