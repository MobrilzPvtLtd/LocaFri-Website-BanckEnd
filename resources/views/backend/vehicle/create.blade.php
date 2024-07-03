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
                                    <label for="city">Type</label>
                                    <input type="text" class="form-control" name="type" value="" placeholder="">
                                </div>
                                <div class="form-group mb-2 col-4">
                                    <label for="desc">Description</label>
                                    <textarea class="form-control" name="desc" placeholder=""></textarea>
                                </div>
                                <div class="form-group mb-2 col-4">
                                    <label for="city">Location</label>
                                    <input type="text" class="form-control" name="location" value="" placeholder="">
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
                                    <label for="city">Body</label>
                                    <input type="text" class="form-control" name="body" value="" placeholder="">
                                </div>
                                <div class="form-group mb-2 col-4">
                                    <label for="city">Seat</label>
                                    <input type="text" class="form-control" name="seat" value="" placeholder="">
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
                                    <input type="text" class="form-control" name="fuel" value="" placeholder="">
                                </div>
                                <div class="form-group mb-2 col-4">
                                    <label for="city">Authorized</label>
                                    <input type="text" class="form-control" name="auth" value="" placeholder="">
                                </div>
                                <div class="form-group mb-2 col-4">
                                    <label for="city">Transmission</label>
                                    <input type="text" class="form-control" name="trans" value="" placeholder="">
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
                                    <label for="featured">Featured</label>
                                    <input type="checkbox" name="featured"  value="1" >

                                </div>
                                <div class="form-group mb-2 col-4">
                                    <label for="interior"> Features</label><br>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="features[]" value="Bluetooth" id="interior_black">
                                        <label class="form-check-label" for="interior_black">Bluetooth</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="features[]" value="Multimedia Player" id="interior_gray">
                                        <label class="form-check-label" for="interior_gray">Multimedia Player</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="features[]" value="Central Lock" id="interior_beige">
                                        <label class="form-check-label" for="interior_beige">Central Lock</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="features[]" value="Sunroof" id="interior_red">
                                        <label class="form-check-label" for="interior_red">Sunroof</label>
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
