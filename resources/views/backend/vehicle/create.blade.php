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

                        <form method="POST" action="{{ route('vehicle.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="form-group mb-2 col-4">
                                    <label for="name">Company</label>
                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}"
                                        placeholder="" required>
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-2 col-4">
                                    <label for="model">Model</label>
                                    <input type="text" class="form-control" name="model" value="{{ old('model') }}"
                                        placeholder="" required>
                                    @error('model')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-2 col-4">
                                    <label for="type">Type</label>
                                    <select class="form-control" name="type">
                                        <option value="" disabled {{ old('type') ? '' : 'selected' }}>Select Type
                                        </option>
                                        <option value="Car" {{ old('type') == 'Car' ? 'selected' : '' }}>Car</option>
                                        <option value="Van" {{ old('type') == 'Van' ? 'selected' : '' }}>Van</option>
                                        <option value="Minibus" {{ old('type') == 'Minibus' ? 'selected' : '' }}>Minibus
                                        </option>
                                        <option value="Prestige" {{ old('type') == 'Prestige' ? 'selected' : '' }}>Prestige
                                        </option>
                                    </select>
                                    @error('type')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-2 col-4">
                                    <label for="desc">Description</label>
                                    <textarea class="form-control" name="desc" placeholder="" required>{{ old('desc') }}</textarea>
                                    @error('desc')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-2 col-4">
                                    <label for="location">Location</label>
                                    <select name="location" id="location" class="form-control">
                                        <option value="Romont Gare"
                                            {{ old('location') == 'Romont Gare' ? 'selected' : '' }}>Romont Gare</option>
                                    </select>
                                    @error('location')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- <div class="form-group mb-2 col-4">
                                    <label for="image">Brand Image</label>
                                    <input type="file" class="form-control" name="image[]" multiple required>
                                    @error('image')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div> --}}

                                <div class="form-group mb-2 col-4">
                                    <label for="image">Brand Image</label>
                                    <input type="file" class="form-control" name="image[]" multiple required>

                                    @if (isset($uploadedImages) && count($uploadedImages) > 0)
                                        <div class="mt-2">
                                            <label>Uploaded Images:</label>
                                            <div class="d-flex flex-wrap gap-2">
                                                @foreach ($uploadedImages as $image)
                                                    <div class="uploaded-image">
                                                        <img src="{{ asset('storage/' . $image) }}" alt="Brand Image"
                                                            width="100" class="img-thumbnail">
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif

                                    @error('image')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>


                                <div class="form-group mb-2 col-4">
                                    <label for="body">Body</label>
                                    <select class="form-control" name="body" required>
                                        <option value="" disabled {{ old('body') ? '' : 'selected' }}>Select Body
                                            Type</option>
                                        <option value="Convertible" {{ old('body') == 'Convertible' ? 'selected' : '' }}>
                                            Convertible</option>
                                        <option value="Coupe" {{ old('body') == 'Coupe' ? 'selected' : '' }}>Coupe
                                        </option>
                                        <option value="Exotic Cars" {{ old('body') == 'Exotic Cars' ? 'selected' : '' }}>
                                            Exotic Cars</option>
                                        <option value="Hatchback" {{ old('body') == 'Hatchback' ? 'selected' : '' }}>
                                            Hatchback</option>
                                        <option value="Minivan" {{ old('body') == 'Minivan' ? 'selected' : '' }}>Minivan
                                        </option>
                                        <option value="Pickup Truck" {{ old('body') == 'Pickup Truck' ? 'selected' : '' }}>
                                            Pickup Truck</option>
                                        <option value="Sedan" {{ old('body') == 'Sedan' ? 'selected' : '' }}>Sedan
                                        </option>
                                        <option value="Sports car" {{ old('body') == 'Sports car' ? 'selected' : '' }}>
                                            Sports car</option>
                                        <option value="Station wagon"
                                            {{ old('body') == 'Station wagon' ? 'selected' : '' }}>Station wagon</option>
                                        <option value="SUV" {{ old('body') == 'SUV' ? 'selected' : '' }}>SUV</option>
                                    </select>
                                    @error('body')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>


                                <div class="form-group mb-2 col-4">
                                    <label for="seat">Seat</label>
                                    <input type="text" class="form-control" name="seat" value="" placeholder=" "
                                        value="{{ old('seat') }}">
                                    {{-- <select class="form-control" name="seat">
                                        <option value="" disabled selected>Select Number of Seats</option>
                                        <option value="2 seats">2 seats</option>
                                        <option value="4 seats">4 seats</option>
                                        <option value="6 seats">6 seats</option>
                                        <option value="6+ seats">6+ seats</option>
                                    </select> --}}

                                </div>

                                <div class="form-group mb-2 col-4">
                                    <label for="city">Door</label>
                                    <input type="text" class="form-control" name="door" value="" placeholder=""
                                        value="{{ old('door') }}">

                                </div>

                                {{-- <div class="form-group mb-2 col-4">
                                    <label for="door">Door</label>
                                    <select class="form-control" name="door">
                                        <option value="" disabled selected>Select Number of Doors</option>
                                        <option value="2 ">2 </option>
                                        <option value="4">4</option>
                                        <option value="6">6</option>
                                        <option value="6+ ">6+</option>
                                    </select>
                                </div> --}}

                                <div class="form-group mb-2 col-4">
                                    <label for="city">Luggage</label>
                                    <input type="text" class="form-control" name="luggage"
                                        value="{{ old('luggage') }}"placeholder="">
                                    @error('luggage')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                                <div class="form-group mb-2 col-4">
                                    <label for="city">Fuel</label>
                                    <input type="text" class="form-control" name="fuel" placeholder=""
                                        value="{{ old('fuel') }}">
                                    @error('fuel')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                                <div class="form-group mb-2 col-4">
                                    <label for="city">Authorized</label>
                                    <input type="text" class="form-control" name="auth"
                                        value="{{ old('auth') }}" placeholder="">
                                    @error('auth')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                                {{-- <div class="form-group mb-2 col-4">
                                    <label for="city">Transmission</label>
                                    <input type="text" class="form-control" name="trans" value=""
                                        placeholder="">
                                </div> --}}
                                <div class="form-group mb-2 col-4">
                                    <label for="trans">Transmission</label>
                                    <select class="form-control" name="trans" id="trans" required>
                                        <option value="" disabled {{ old('trans') === null ? 'selected' : '' }}>
                                            Select Transmission</option>
                                        <option value="Manual" {{ old('trans') === 'Manual' ? 'selected' : '' }}>Manual
                                        </option>
                                        <option value="Automatic" {{ old('trans') === 'Automatic' ? 'selected' : '' }}>
                                            Automatic</option>
                                    </select>
                                    @error('trans')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>



                                <div class="form-group mb-2 col-4">
                                    <label for="city">Exterior Color</label>
                                    <input type="text" class="form-control" name="exterior"
                                        value="{{ old('exterior') }}" placeholder="">
                                    @error('exterior')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                                <div class="form-group mb-2 col-4">
                                    <label for="city">Interior Color</label>
                                    <input type="text" class="form-control" name="interior"
                                        value="{{ old('interior') }}" placeholder="">
                                    @error('interior')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                                <div class="form-group mb-2 col-4">
                                    <label for="city">Day Price</label>
                                    <input type="text" class="form-control" name="Dprice"
                                        value="{{ old('Dprice') }}" placeholder="">
                                    @error('Dprice')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                                <div class="form-group mb-2 col-4">
                                    <label for="city">Week Price</label>
                                    <input type="text" class="form-control" name="wprice"
                                        value="{{ old('wprice') }}" placeholder="">
                                    @error('wprice')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                                <div class="form-group mb-2 col-4">
                                    <label for="city">Month Price</label>
                                    <input type="text" class="form-control" name="mprice"
                                        value="{{ old('mprice') }}" placeholder="">
                                    @error('mprice')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>

                                <div class="form-group mb-2 col-4">
                                    <label for="city"> Kilometers</label>
                                    <input type="number" class="form-control" name="mitter"
                                        value="{{ old('mitter') }}" placeholder="">
                                    @error('mitter')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="form-group mb-2 col-4">
                                    <label for="permitted_kilometers_day">Authorized kilometers Day</label>
                                    <input type="text" class="form-control" name="permitted_kilometers_day"
                                        value="{{ old('permitted_kilometers_day') }}" placeholder="">
                                    @error('permitted_kilometers_day')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>

                                <div class="form-group mb-2 col-4">
                                    <label for="permitted_kilometers_week">Authorized kilometers Week</label>
                                    <input type="text" class="form-control" name="permitted_kilometers_week"
                                        value="{{ old('permitted_kilometers_week') }}" placeholder="">
                                    @error('permitted_kilometers_week')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group mb-2 col-4">
                                    <label for="permitted_kilometers_month">Authorized kilometers Month</label>
                                    <input type="text" class="form-control" name="permitted_kilometers_month"
                                        value="{{ old('permitted_kilometers_month') }}" placeholder="">
                                    @error('permitted_kilometers_month')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>



                                <div class="form-group mb-2 col-4">
                                    <label for="city">Available Time</label>
                                    <input type="time" class="form-control" name="available"
                                        value="{{ old('available') }}" placeholder="">
                                    @error('available')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group mb-2 col-4">
                                    <label for="status">Status</label>
                                    <select class="form-control" name="status" id="status" required>
                                        <option value="" disabled {{ old('status') === null ? 'selected' : '' }}>
                                            Select Status</option>
                                        <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active
                                        </option>
                                        <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive
                                        </option>
                                    </select>
                                    @error('status')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="form-group mb-2 col-4">
                                    <label for="featured">Featured</label>
                                    <input type="checkbox" name="featured" value="1"
                                        {{ old('featured') ? 'checked' : '' }}>
                                    @error('featured')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group mb-2 col-4">
                                    <label for="features">Features</label><br>

                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="features[]"
                                            value="Bluetooth" id="feature_bluetooth"
                                            {{ in_array('Bluetooth', old('features', [])) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="feature_bluetooth">Bluetooth</label>
                                    </div>

                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="features[]"
                                            value="Multimedia Player" id="feature_multimedia"
                                            {{ in_array('Multimedia Player', old('features', [])) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="feature_multimedia">Multimedia Player</label>
                                    </div>

                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="features[]"
                                            value="Central Lock" id="feature_central_lock"
                                            {{ in_array('Central Lock', old('features', [])) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="feature_central_lock">Central Lock</label>
                                    </div>

                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="features[]"
                                            value="Sunroof" id="feature_sunroof"
                                            {{ in_array('Sunroof', old('features', [])) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="feature_sunroof">Sunroof</label>
                                    </div>

                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="features[]"
                                            value="trailer_hitch" id="trailer_hitch"
                                            {{ in_array('trailer_hitch', old('features', [])) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="trailer_hitch">Trailer Hitch</label>
                                    </div>

                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="features[]"
                                            value="reversing_camera" id="reversing_camera"
                                            {{ in_array('reversing_camera', old('features', [])) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="reversing_camera">Reversing Camera</label>
                                    </div>

                                    @error('features[]')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
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
