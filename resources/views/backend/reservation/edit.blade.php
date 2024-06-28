@extends('backend.layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('reservation.index') }}" enctype="multipart/form-data">
                    Back</a>
            </div>
            <div class="row mt-4">
                <div class="col">
                    <div class="container mt-5">
                        <form method="post" action="{{ route('reservation.update', $reservation->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="form-group mb-2 col-4">
                                    <label for="city">Customer Name</label>
                                    <input type="text" class="form-control" name="name"  value="{{ $reservation->name }}" placeholder="">
                                </div>

                                <div class="form-group mb-2 col-4">
                                    <label for="city">Vehicle Details</label>
                                    <input type="text" class="form-control" name="details"  value="{{ $reservation->details }}" placeholder="">
                                </div>
                                <div class="form-group mb-2 col-4">
                                    <label for="city">Rental Dates Start</label>
                                    {{-- <label for="city">{{ $reservation->start }}</label> --}}
                                    <input type="Date"class="form-control" name="start" value="{{ $reservation->start }}" placeholder="">
                                </div>
                                <div class="form-group mb-2 col-4">
                                    <label for="city">Rental Dates End</label>
                                    <input type="Date"class="form-control" name="end" value="{{ $reservation->end }}" placeholder="">

                                </div>
                                <div class="form-group mb-2 col-4">
                                    <label for="method">Contact Method</label>
                                    <select class="form-control" name="method">
                                        <option value="{{ $reservation->method }}">{{ $reservation->method }}</option>
                                        <option value="phone">Phone</option>
                                    </select>
                                </div>

                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
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
