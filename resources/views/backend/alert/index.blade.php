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
                                    <th scope="col">ID</th>
                                    <th scope="col">{{ __('messages.vehicle_name')}}</th>
                                    <th scope="col">Kilometer</th>
                                    <th scope="col">Service</th>
                                    <th scope="col">{{ __('messages.status')}}</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($alerts as $alert)
                                    <tr>
                                        @php
                                            ($alert->vahicleName);
                                        @endphp
                                        <td>{{ $alert->id }}</td>
                                        <td>{{ $alert->vahicleName->name ?? 'No vehicle' }}</td>
                                        <td>{{ $alert->kilometer }}</td>
                                        <td>{{ $alert->servicing }}</td>
                                        <td>
                                            <span class="{{ $alert->status == 'pending' ? 'btn btn-warning btn-sm' : 'btn btn-success btn-sm' }}">
                                                {{ $alert->status }}
                                            </span>
                                        </td>
                                        <td>
                                            <form action="{{ route('alert.destroy', $alert->id) }}" method="POST">
                                                <a class="btn btn-primary btn-sm" href="{{ route('alert.edit', $alert->id) }}">{{ __('messages.edit')}}</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">{{ __('messages.delete')}}</button>
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
                    <div class="float-left"></div>
                </div>
                <div class="col-5">
                    <div class="float-end"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
