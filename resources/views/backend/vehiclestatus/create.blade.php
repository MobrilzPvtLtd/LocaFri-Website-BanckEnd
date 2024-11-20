@extends ('backend.layouts.app')
@section('content')
    <div class="card">
        <div class="card-body">

            <div class="pull-right mb-2">
                <a class="btn btn-success" href="{{ route('vehiclestatus.index') }}">vehiclestatus</a>
            </div>
            <div class="row mt-4">
                <div class="col">
                    <div class="container mt-5">

                        <form method="POST" action="{{ route('vehiclestatus.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="form-group mb-4 col-8">
                                    <label for="city">Vehicle Name</label>
                                    <select name="vehicle_id" class="form-control" required>
                                        <option value="" disabled selected>Select Vehicle</option>
                                        @foreach ($vehicles as $vehicle)
                                            <option value="{{ $vehicle->id }}">{{ $vehicle->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="form-group mb-4 col-8">
                                        <label for="city">Kilometers</label>
                                        <input type="number" class="form-control" name="kilometer" value=""
                                            placeholder="">
                                    </div>
                                    <div class="form-group mb-4 col-8">
                                        <label for="city">Fuel Level</label>
                                        <input type="Number" class="form-control" name="fule" value=""
                                            placeholder="">
                                    </div>
                                    <div class="form-group mb-4 col-8">
                                        <label for="city">Damage Records</label>
                                        <textarea class="form-control" name="damage" placeholder=""></textarea>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary mb-0 col-1">Submit</button>
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
