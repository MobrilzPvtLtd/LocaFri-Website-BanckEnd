@extends('backend.layouts.app')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Edit Vehicle Detail</h4>
            <a href="{{ route('vehicle.index') }}" class="btn btn-warning btn-sm">
                <i class="fas fa-reply"></i>
            </a>
        </div>

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
                                    <label for="type">Type</label>
                                    <select class="form-control" name="type">
                                        <option value="" disabled {{ $vehicle->type ? '' : 'selected' }}>Select Type
                                        </option>
                                        <option value="Car" {{ $vehicle->type == 'Car' ? 'selected' : '' }}>Car</option>
                                        <option value="Van" {{ $vehicle->type == 'Van' ? 'selected' : '' }}>Van</option>
                                        <option value="Minibus" {{ $vehicle->type == 'Minibus' ? 'selected' : '' }}>Minibus
                                        </option>
                                        <option value="Prestige" {{ $vehicle->type == 'Prestige' ? 'selected' : '' }}>
                                            Prestige</option>
                                    </select>
                                </div>

                                <div class="form-group mb-2 col-4">
                                    <label for="desc">Description</label>
                                    <textarea class="form-control" name="desc" placeholder="">{{ $vehicle->desc }}</textarea>
                                </div>
                                <div class="form-group mb-2 col-4">
                                    <label for="city">Location</label>
                                    {{-- <input type="text" class="form-control" name="location"
                                        value="{{ $vehicle->location }}" placeholder=""> --}}
                                    <select name="location" id="location" class="form-control">
                                        <option value="Switzerland"
                                            {{ isset($vehicle) && $vehicle->location == 'Switzerland' ? 'selected' : '' }}>
                                            Switzerland</option>
                                    </select>
                                </div>

                                <div class="form-group mb-2 col-4">
                                    <label for="city">Brand Image</label>
                                    <input type="file" class="form-control" name="image[]" value="{{ $vehicle->image }}"
                                        placeholder="" multiple>
                                </div>
                                <div class="form-group mb-2 col-4">
                                    <label for="city">Kilometers</label>
                                    <input type="number" class="form-control" name="mitter"
                                        value="{{ $vehicle->mitter }}" placeholder="">
                                </div>
                                <div class="form-group mb-2 col-4">
                                    <label for="body">Body</label>
                                    <select class="form-control" name="body">
                                        <option value="" disabled {{ $vehicle->body ? '' : 'selected' }}>Select Body
                                            Type</option>
                                        <option value="Convertible"
                                            {{ $vehicle->body == 'Convertible' ? 'selected' : '' }}>Convertible</option>
                                        <option value="Coupe" {{ $vehicle->body == 'Coupe' ? 'selected' : '' }}>Coupe
                                        </option>
                                        <option value="Exotic Cars"
                                            {{ $vehicle->body == 'Exotic Cars' ? 'selected' : '' }}>Exotic Cars</option>
                                        <option value="Hatchback" {{ $vehicle->body == 'Hatchback' ? 'selected' : '' }}>
                                            Hatchback</option>
                                        <option value="Minivan" {{ $vehicle->body == 'Minivan' ? 'selected' : '' }}>Minivan
                                        </option>
                                        <option value="Pickup Truck"
                                            {{ $vehicle->body == 'Pickup Truck' ? 'selected' : '' }}>Pickup Truck</option>
                                        <option value="Sedan" {{ $vehicle->body == 'Sedan' ? 'selected' : '' }}>Sedan
                                        </option>
                                        <option value="Sports car" {{ $vehicle->body == 'Sports car' ? 'selected' : '' }}>
                                            Sports car</option>
                                        <option value="Station wagon"
                                            {{ $vehicle->body == 'Station wagon' ? 'selected' : '' }}>Station wagon
                                        </option>
                                        <option value="SUV" {{ $vehicle->body == 'SUV' ? 'selected' : '' }}>SUV</option>
                                    </select>
                                </div>
                                <div class="form-group mb-2 col-4">
                                    <label for="seat">Seat</label>
                                    <select class="form-control" name="seat">
                                        <option value="" disabled {{ $vehicle->seat ? '' : 'selected' }}>Select
                                            Number of Seats</option>
                                        <option value="2 seats" {{ $vehicle->seat == '2 seats' ? 'selected' : '' }}>2 seats
                                        </option>
                                        <option value="4 seats" {{ $vehicle->seat == '4 seats' ? 'selected' : '' }}>4 seats
                                        </option>
                                        <option value="6 seats" {{ $vehicle->seat == '6 seats' ? 'selected' : '' }}>6 seats
                                        </option>
                                        <option value="6+ seats" {{ $vehicle->seat == '6+ seats' ? 'selected' : '' }}>6+
                                            seats</option>
                                    </select>
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
                                    <label for="city">Fuel</label>
                                    <input type="text" class="form-control" name="fuel"
                                        value="{{ $vehicle->fuel }}" placeholder="">
                                </div>
                                <div class="form-group mb-2 col-4">
                                    <label for="city">Authorized</label>
                                    <input type="text" class="form-control" name="auth"
                                        value="{{ $vehicle->auth }}" placeholder="">
                                </div>
                                {{-- <div class="form-group mb-2 col-4">
                                    <label for="city">Transmission</label>
                                    <input type="text" class="form-control" name="trans"
                                        value="{{ $vehicle->trans }}" placeholder="">
                                </div> --}}
                                <div class="form-group mb-2 col-4">
                                    <label for="trans">Transmission</label>
                                    <select class="form-control" name="trans" id="trans">
                                        <option value="Manual" {{ $vehicle->trans == 'Manual' ? 'selected' : '' }}>Manual</option>
                                        {{-- <option value="Automatic" {{ $vehicle->trans == 'Automatic' ? 'selected' : '' }}>Automatic</option> --}}
                                        {{-- <option value="AMT" {{ $vehicle->trans == 'AMT' ? 'selected' : '' }}>AMT</option>
                                        <option value="CVT" {{ $vehicle->trans == 'CVT' ? 'selected' : '' }}>CVT</option>
                                        <option value="DCT" {{ $vehicle->trans == 'DCT' ? 'selected' : '' }}>DCT</option>
                                        <option value="Tiptronic" {{ $vehicle->trans == 'Tiptronic' ? 'selected' : '' }}>Tiptronic</option>
                                        <option value="EV Single-Speed" {{ $vehicle->trans == 'EV Single-Speed' ? 'selected' : '' }}>EV Single-Speed</option> --}}
                                    </select>
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
                                    <label for="permitted_kilometers_day">Permitted kilometersd  Day</label>
                                    <input type="text" class="form-control" name="permitted_kilometers_day"
                                        value="{{ $vehicle->permitted_kilometers_day}}" placeholder="">
                                </div>

                                <div class="form-group mb-2 col-4">
                                    <label for="permitted_kilometers_week">Permitted kilometers Week</label>
                                    <input type="text" class="form-control" name="permitted_kilometers_week"
                                        value="{{ $vehicle->permitted_kilometers_week}}" placeholder="">
                                </div>

                                <div class="form-group mb-2 col-4">
                                    <label for="permitted_kilometers_month">Permitted Kilometers Month</label>
                                    <input type="text" class="form-control" name="permitted_kilometers_week"
                                        value="{{ $vehicle->permitted_kilometers_month}}" placeholder="">
                                </div>





                                {{-- <div class="form-group mb-2 col-4">
                                    <label for="available">Available Time</label>
                                    <input type="time" class="form-control" name="available"
                                        value="{{ $vehicle->available_time ? \Carbon\Carbon::parse($vehicle->available_time)->format('H:i') : '' }}"
                                        placeholder="">
                                </div> --}}

                                <div class="form-group mb-2 col-4">
                                    <label for="status">Status</label>
                                    <select class="form-control" name="status" id="status">
                                        <option value="" disabled selected>Select Status</option>
                                        <option value="1" {{ $vehicle->status == 1 ? 'selected' : '' }}>Active
                                        </option>
                                        <option value="0" {{ $vehicle->status == 0 ? 'selected' : '' }}>Inactive
                                        </option>
                                    </select>
                                </div>
                                <br>
                                <div class="form-group mb-2 col-4">
                                    <label for="featured">Featured</label>
                                    <input type="checkbox" name="featured" value="1"
                                        {{ $vehicle->featured ? 'checked' : '' }}>
                                </div>
                                <div class="form-group mb-2 col-4">
                                    <label for="interior"> Features</label><br>
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
