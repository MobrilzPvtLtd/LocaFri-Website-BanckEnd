@extends ('backend.layouts.app')
@section('content')
    <div class="card">
        <div class="card-body">

            <div class="pull-right mb-2">
                <a class="btn btn-success" href="{{ route('vehicle.index') }}">Vehicle</a>
            </div>
            <div class="row mt-4">
                <div class="col">
                    <div class="container mt-5">

                        <form method="POST" action="{{ route('vehicle.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="form-group mb-2 col-4">
                                    <label for="city">Company</label>
                                    <input type="text" class="form-control" name="name" value="" placeholder="">
                                </div>
                                <div class="form-group mb-2 col-4">
                                    <label for="city">Model</label>
                                    <input type="text" class="form-control" name="model" value="" placeholder="">
                                </div>
                                <div class="form-group mb-2 col-4">
                                    <label for="type">Type</label>
                                    <select class="form-control" name="type">
                                        <option value="" disabled selected>Select Type</option>
                                        <option value="Car">Car</option>
                                        <option value="Van">Van</option>
                                        <option value="Minibus">Minibus</option>
                                        <option value="Prestige">Prestige</option>
                                    </select>
                                </div>

                                <div class="form-group mb-2 col-4">
                                    <label for="desc">Description</label>
                                    <textarea class="form-control" name="desc" placeholder=""></textarea>
                                </div>
                                <div class="form-group mb-2 col-4">
                                    <label for="city">Location</label>
                                    <input type="text" class="form-control" name="location" value=""
                                        placeholder="">
                                </div>
                                <div class="form-group mb-2 col-4">
                                    <label for="city">Brand Image</label>
                                    <input type="file" class="form-control" name="image[]" value="" placeholder=""
                                        multiple>
                                </div>
                                <div class="form-group mb-2 col-4">
                                    <label for="city">Kilometers</label>
                                    <input type="number" class="form-control" name="mitter" value="" placeholder="">
                                </div>
                                <div class="form-group mb-2 col-4">
                                    <label for="body">Body</label>
                                    <select class="form-control" name="body">
                                        <option value="" disabled selected>Select Body Type</option>
                                        <option value="Convertible">Convertible</option>
                                        <option value="Coupe">Coupe</option>
                                        <option value="Exotic Cars">Exotic Cars</option>
                                        <option value="Hatchback">Hatchback</option>
                                        <option value="Minivan">Minivan</option>
                                        <option value="Pickup Truck">Pickup Truck</option>
                                        <option value="Sedan">Sedan</option>
                                        <option value="Sports car">Sports car</option>
                                        <option value="Station wagon">Station wagon</option>
                                        <option value="SUV">SUV</option>
                                    </select>
                                </div>

                                <div class="form-group mb-2 col-4">
                                    <label for="seat">Seat</label>
                                    <select class="form-control" name="seat">
                                        <option value="" disabled selected>Select Number of Seats</option>
                                        <option value="2 seats">2 seats</option>
                                        <option value="4 seats">4 seats</option>
                                        <option value="6 seats">6 seats</option>
                                        <option value="6+ seats">6+ seats</option>
                                    </select>
                                </div>

                                <div class="form-group mb-2 col-4">
                                    <label for="city">Door</label>
                                    <input type="text" class="form-control" name="door" value="" placeholder="">
                                </div>
                                <div class="form-group mb-2 col-4">
                                    <label for="city">Luggage</label>
                                    <input type="text" class="form-control" name="luggage" value="" placeholder="">
                                </div>
                                <div class="form-group mb-2 col-4">
                                    <label for="city">Fuel Type</label>
                                    <input type="text" class="form-control" name="fuel" value=""
                                        placeholder="">
                                </div>
                                <div class="form-group mb-2 col-4">
                                    <label for="city">Authorized</label>
                                    <input type="text" class="form-control" name="auth" value=""
                                        placeholder="">
                                </div>
                                <div class="form-group mb-2 col-4">
                                    <label for="city">Transmission</label>
                                    <input type="text" class="form-control" name="trans" value=""
                                        placeholder="">
                                </div>
                                <div class="form-group mb-2 col-4">
                                    <label for="city">Exterior Color</label>
                                    <input type="text" class="form-control" name="exterior" value=""
                                        placeholder="">
                                </div>
                                <div class="form-group mb-2 col-4">
                                    <label for="city">Interior Color</label>
                                    <input type="text" class="form-control" name="interior" value=""
                                        placeholder="">
                                </div>
                                <div class="form-group mb-2 col-4">
                                    <label for="city">Day Price</label>
                                    <input type="text" class="form-control" name="Dprice" value=""
                                        placeholder="">
                                </div>
                                <div class="form-group mb-2 col-4">
                                    <label for="city">Week Price</label>
                                    <input type="text" class="form-control" name="wprice" value=""
                                        placeholder="">
                                </div>
                                <div class="form-group mb-2 col-4">
                                    <label for="city">Month Price</label>
                                    <input type="text" class="form-control" name="mprice" value=""
                                        placeholder="">
                                </div>
                                <div class="form-group mb-2 col-4">
                                    <label for="city">Available Time</label>
                                    <input type="time" class="form-control" name="available" value=""
                                        placeholder="">
                                </div>
                                <div class="form-group mb-2 col-4">
                                    <label for="status">Status</label>
                                    <select class="form-control" name="status" id="status">
                                        <option value="" disabled selected>Select Status</option>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                                <div class="form-group mb-2 col-4">
                                    <label for="featured">Featured</label>
                                    <input type="checkbox" name="featured" value="1">

                                </div>
                                <div class="form-group mb-2 col-4">
                                    <label for="features">Features</label><br>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="features[]"
                                            value="Bluetooth" id="feature_bluetooth">
                                        <label class="form-check-label" for="feature_bluetooth">Bluetooth</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="features[]"
                                            value="Multimedia Player" id="feature_multimedia">
                                        <label class="form-check-label" for="feature_multimedia">Multimedia Player</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="features[]"
                                            value="Central Lock" id="feature_central_lock">
                                        <label class="form-check-label" for="feature_central_lock">Central Lock</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="features[]"
                                            value="Sunroof" id="feature_sunroof">
                                        <label class="form-check-label" for="feature_sunroof">Sunroof</label>
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
