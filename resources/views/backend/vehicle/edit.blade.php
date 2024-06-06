@extends('backend.layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('vehicle.index') }}" enctype="multipart/form-data">
                    Back</a>
            </div>
            <div class="row mt-4">
                <div class="col">
                    <div class="container mt-5">
                        <form method="post" action="{{ route('vehicle.update', $vehicle->id) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="form-group mb-2 col-4">
                                    <label for="city">Company</label>
                                    <input type="text" class="form-control" name="name" value="{{ $vehicle->name }}"
                                        placeholder="">
                                </div>
                                <div class="form-group mb-2 col-4">
                                    <label for="city">Model</label>
                                    <input type="text" class="form-control" name="model" value="{{ $vehicle->model }}"
                                        placeholder="">
                                </div>
                                <div class="form-group mb-2 col-4">
                                    <label for="city">Type</label>
                                    <input type="text" class="form-control" name="type" value="{{ $vehicle->type }}"
                                        placeholder="">
                                </div>
                                <div class="form-group mb-2 col-4">
                                    <label for="city">Brand Image</label>
                                    <input type="file" class="form-control" name="image[]" value="{{ $vehicle->image }}"
                                        placeholder="" multiple>
                                </div>
                                <div class="form-group mb-2 col-4">
                                    <label for="city">Kilometers</label>
                                    <input type="number" class="form-control" name="mitter" value="{{ $vehicle->mitter }}"
                                        placeholder="">
                                </div>
                                <div class="form-group mb-2 col-4">
                                    <label for="city">Body</label>
                                    <input type="text" class="form-control" name="body" value="{{ $vehicle->body }}" placeholder="">
                                </div>
                                <div class="form-group mb-2 col-4">
                                    <label for="city">Seat</label>
                                    <input type="text" class="form-control" name="seat" value="{{ $vehicle->seat }}" placeholder="">
                                </div>
                                <div class="form-group mb-2 col-4">
                                    <label for="city">Door</label>
                                    <input type="text" class="form-control" name="door" value="{{ $vehicle->door }}" placeholder="">
                                </div>
                                <div class="form-group mb-2 col-4">
                                    <label for="city">Luggage</label>
                                    <input type="text" class="form-control" name="luggage" value="{{ $vehicle->luggage }}" placeholder="">
                                </div>
                                <div class="form-group mb-2 col-4">
                                    <label for="city">Fuel Type</label>
                                    <input type="text" class="form-control" name="fuel" value="{{ $vehicle->fuel }}" placeholder="">
                                </div>
                                <div class="form-group mb-2 col-4">
                                    <label for="city">Authorized</label>
                                    <input type="text" class="form-control" name="auth" value="{{ $vehicle->auth }}" placeholder="">
                                </div>
                                <div class="form-group mb-2 col-4">
                                    <label for="city">Transmission</label>
                                    <input type="text" class="form-control" name="trans" value="{{ $vehicle->trans }}" placeholder="">
                                </div>
                                <div class="form-group mb-2 col-4">
                                    <label for="city">Exterior Color</label>
                                    <input type="text" class="form-control" name="exterior" value="{{ $vehicle->exterior }}"
                                        placeholder="">
                                </div>
                                <div class="form-group mb-2 col-4">
                                    <label for="city">Interior Color</label>
                                    <input type="text" class="form-control" name="interior" value="{{ $vehicle->interior }}"
                                        placeholder="">
                                </div>
                                <div class="form-group mb-2 col-4">
                                    <label for="featured">Featured</label>
                                    <input type="checkbox" name="featured" value="1" {{ $vehicle->featured ? 'checked' : '' }}>
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
