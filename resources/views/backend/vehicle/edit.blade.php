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
                                    <label for="desc">Description</label>
                                    <textarea class="form-control" name="desc" placeholder="">{{ $vehicle->desc }}</textarea>
                                </div>
                                <div class="form-group mb-2 col-4">
                                    <label for="city">Location</label>
                                    <input type="text" class="form-control" name="location" value="{{ $vehicle->location }}" placeholder="">
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
                                    <input type="text" class="form-control" name="body" value="{{ $vehicle->body }}"
                                        placeholder="">
                                </div>
                                <div class="form-group mb-2 col-4">
                                    <label for="city">Seat</label>
                                    <input type="text" class="form-control" name="seat" value="{{ $vehicle->seat }}"
                                        placeholder="">
                                </div>
                                <div class="form-group mb-2 col-4">
                                    <label for="city">Door</label>
                                    <input type="text" class="form-control" name="door" value="{{ $vehicle->door }}"
                                        placeholder="">
                                </div>
                                <div class="form-group mb-2 col-4">
                                    <label for="city">Luggage</label>
                                    <input type="text" class="form-control" name="luggage"
                                        value="{{ $vehicle->luggage }}" placeholder="">
                                </div>
                                <div class="form-group mb-2 col-4">
                                    <label for="city">Fuel Type</label>
                                    <input type="text" class="form-control" name="fuel" value="{{ $vehicle->fuel }}"
                                        placeholder="">
                                </div>
                                <div class="form-group mb-2 col-4">
                                    <label for="city">Authorized</label>
                                    <input type="text" class="form-control" name="auth" value="{{ $vehicle->auth }}"
                                        placeholder="">
                                </div>
                                <div class="form-group mb-2 col-4">
                                    <label for="city">Transmission</label>
                                    <input type="text" class="form-control" name="trans"
                                        value="{{ $vehicle->trans }}" placeholder="">
                                </div>
                                <div class="form-group mb-2 col-4">
                                    <label for="city">Exterior Color</label>
                                    <input type="text" class="form-control" name="exterior"
                                        value="{{ $vehicle->exterior }}" placeholder="">
                                </div>
                                <div class="form-group mb-2 col-4">
                                    <label for="city">Interior Color</label>
                                    <input type="text" class="form-control" name="interior"
                                        value="{{ $vehicle->interior }}" placeholder="">
                                </div>
                                <div class="form-group mb-2 col-4">
                                    <label for="city">Day Price</label>
                                    <input type="text" class="form-control" name="Dprice"
                                        value="{{ $vehicle->Dprice }}" placeholder="">
                                </div>
                                <div class="form-group mb-2 col-4">
                                    <label for="city">Week Price</label>
                                    <input type="text" class="form-control" name="wprice"
                                        value="{{ $vehicle->wprice }}" placeholder="">
                                </div>
                                <div class="form-group mb-2 col-4">
                                    <label for="city">Month Price</label>
                                    <input type="text" class="form-control" name="mprice"
                                        value="{{ $vehicle->mprice }}" placeholder="">
                                </div>
                                <div class="form-group mb-2 col-4">
                                    <label for="featured">Featured</label>
                                    <input type="checkbox" name="featured" value="1"
                                        {{ $vehicle->featured ? 'checked' : '' }}>
                                </div>
                                <div class="form-group mb-2 col-4">
                                    <label for="interior"> Features</label><br>
                                    {{-- @php
                                        dd($data_feature == 'Multimedia Player');
                                    @endphp --}}
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="features[]"
                                            value="bluetooth" id="interior_bluetooth"
                                            @if (is_array($featuresArray) && in_array('Bluetooth', $featuresArray)) checked @endif>
                                        <label class="form-check-label" for="interior_bluetooth">Bluetooth</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="features[]"
                                            value="multimedia Player" id="interior_multimedia"
                                            @if (is_array($featuresArray) && in_array('Multimedia Player', $featuresArray)) checked @endif>
                                        <label class="form-check-label" for="interior_multimedia">Multimedia
                                            Player</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="features[]"
                                            value="central Lock" id="interior_central_lock"
                                            @if (is_array($featuresArray) && in_array('Central Lock', $featuresArray)) checked @endif>
                                        <label class="form-check-label" for="interior_central_lock">Central Lock</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="features[]"
                                            value="sunroof" id="interior_sunroof"
                                            @if (is_array($featuresArray) && in_array('Sunroof', $featuresArray)) checked @endif>
                                        <label class="form-check-label" for="interior_sunroof">Sunroof</label>
                                    </div>

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
