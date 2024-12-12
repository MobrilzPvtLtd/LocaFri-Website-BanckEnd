@extends('backend.layouts.app')

@push('after-styles')
    <style>
        .img-preview {
            position: relative;
            display: inline-block;
            margin-right: 10px;
            margin-bottom: 10px;
        }

        .preview-img {
            width: 100px;
            height: 100px;
            object-fit: cover;
        }

        .close-btn {
            position: absolute;
            top: 0;
            right: 0;
            background: rgba(255, 0, 0, 0.7);
            color: white;
            border: none;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            text-align: center;
            line-height: 20px;
            /* This ensures the '×' is vertically centered */
            cursor: pointer;
        }

        .close-btn:hover {
            background: red;
        }
    </style>
@endpush

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>{{ __('messages.edit_vehicle_detail') }}</h4>
            <a href="{{ route('vehicle.index') }}" class="btn btn-warning btn-sm">
                <i class="fas fa-reply"></i>
            </a>
        </div>

        <div class="card-body">
            {{-- <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('vehicle.index') }}" enctype="multipart/form-data">
                    {{ __('messages.back') }}</a>
            </div> --}}
            <div class="row mt-4">
                <div class="col">
                    <div class="container mt-5">
                        <form method="post" action="{{ route('vehicle.update', $vehicle->id) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="form-group mb-2 col-4">
                                    <label for="city">{{ __('messages.company') }}</label>
                                    <input type="text" class="form-control" name="name" value="{{ $vehicle->name }}"
                                        placeholder="">
                                </div>
                                <div class="form-group mb-2 col-4">
                                    <label for="city">{{ __('messages.model') }}</label>
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

                                <div class="form-group mb-2 col-12">
                                    <label for="desc">{{ __('messages.description') }}</label>
                                    <textarea class="form-control" name="desc" placeholder="">{{ $vehicle->desc }}</textarea>
                                </div>
                                <div class="form-group mb-2 col-6">
                                    <label for="city">{{ __('messages.location') }}</label>
                                    {{-- <input type="text" class="form-control" name="location"
                                        value="{{ $vehicle->location }}" placeholder=""> --}}
                                    <select name="location" id="location" class="form-control">
                                        <option value="Romont Gare"
                                            {{ isset($vehicle) && $vehicle->location == 'Romont Gare' ? 'selected' : '' }}>
                                            Romont Gare</option>
                                    </select>
                                </div>

                                <div class="form-group mb-2 col-6">
                                    <label for="image">{{ __('messages.brand_image') }}</label>
                                    <input type="file" class="form-control" name="image[]" id="imageUpload" multiple>
                                    <div id="imagePreview" class="mt-2"></div>

                                    @php
                                        $uploadedImages = json_decode($vehicle->image);
                                    @endphp
                                    @if (isset($uploadedImages) && count($uploadedImages) > 0)
                                        <div class="mt-2">
                                            <div class="d-flex flex-wrap gap-2" id="existingImages">
                                                @foreach ($uploadedImages as $image)
                                                    <div class="uploaded-image">
                                                        <div class="img-preview">
                                                            <img src="{{ asset('public/storage/' . $image) }}"
                                                                alt="Brand Image" width="100"
                                                                class="img-thumbnail preview-img">
                                                            <button class="close-btn">×</button>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif

                                    @error('image')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>


                                {{-- <div class="form-group mb-2 col-4">
                                    <label for="body">{{ __('messages.body')}}</label>
                                    <select class="form-control" name="body">
                                        <option value="" disabled {{ $vehicle->body ? '' : 'selected' }}>
                                            Type</option>
                                        <option value="Convertible"
                                            {{ $vehicle->body == 'Convertible' ? 'selected' : '' }}>{{ __('messages.convertible')}}</option>
                                        <option value="Coupe" {{ $vehicle->body == 'Coupe' ? 'selected' : '' }}>{{ __('messages.coupe')}}
                                        </option>
                                        <option value="Exotic Cars"
                                            {{ $vehicle->body == 'Exotic Cars' ? 'selected' : '' }}>{{ __('messages.exotic_cars')}}</option>
                                        <option value="Hatchback" {{ $vehicle->body == 'Hatchback' ? 'selected' : '' }}>
                                            {{ __('messages.hatchback')}}</option>
                                        <option value="Minivan" {{ $vehicle->body == 'Minivan' ? 'selected' : '' }}>Minivan
                                        </option>
                                        <option value="Pickup Truck"
                                            {{ $vehicle->body == 'Pickup Truck' ? 'selected' : '' }}> {{ __('messages.pickup_truck')}}</option>
                                        <option value="Sedan" {{ $vehicle->body == 'Sedan' ? 'selected' : '' }}>{{ __('messages.sedan')}}
                                        </option>
                                        <option value="Sports car" {{ $vehicle->body == 'Sports car' ? 'selected' : '' }}>
                                            {{ __('messages.sports_car')}}</option>
                                        <option value="Station wagon"
                                            {{ $vehicle->body == 'Station wagon' ? 'selected' : '' }}> {{ __('messages.station_wagon')}}
                                        </option>
                                        <option value="SUV" {{ $vehicle->body == 'SUV' ? 'selected' : '' }}>SUV</option>
                                    </select>
                                </div> --}}

                                <div class="form-group mb-2 col-4">
                                    <label for="seat">{{ __('messages.seat') }}</label>
                                    <input type="number" class="form-control" name="seat"
                                        placeholder="Enter number of seats" value="{{ old('seat', $vehicle->seat) }}">
                                </div>

                                <div class="form-group mb-2 col-4">
                                    <label for="door">{{ __('messages.door') }}</label>
                                    <input type="number" class="form-control" name="door"
                                        placeholder="Enter number of doors" value="{{ old('door', $vehicle->door) }}">
                                </div>

                                <div class="form-group mb-2 col-4">
                                    <label for="city">{{ __('messages.luggage') }}</label>
                                    <input type="text" class="form-control" name="luggage"
                                        value="{{ $vehicle->luggage }}" placeholder="">
                                </div>
                                <div class="form-group mb-2 col-4">
                                    <label for="city">{{ __('messages.fuel') }}</label>
                                    <input type="text" class="form-control" name="fuel" value="{{ $vehicle->fuel }}"
                                        placeholder="">
                                </div>
                                {{-- <div class="form-group mb-2 col-4">
                                    <label for="city">{{ __('messages.authorized') }}</label>
                                    <input type="text" class="form-control" name="auth" value="{{ $vehicle->auth }}"
                                        placeholder="">
                                </div> --}}
                                {{-- <div class="form-group mb-2 col-4">
                                    <label for="city">Transmission</label>
                                    <input type="text" class="form-control" name="trans"
                                        value="{{ $vehicle->trans }}" placeholder="">
                                </div> --}}
                                <div class="form-group mb-2 col-4">
                                    <label for="trans">Transmission</label>
                                    <select class="form-control" name="trans" id="trans">
                                        <option value="Manual" {{ $vehicle->trans == 'Manual' ? 'selected' : '' }}>Manual
                                        </option>
                                        {{-- <option value="Automatic" {{ $vehicle->trans == 'Automatic' ? 'selected' : '' }}>Automatic</option> --}}
                                        {{-- <option value="AMT" {{ $vehicle->trans == 'AMT' ? 'selected' : '' }}>AMT</option>
                                        <option value="CVT" {{ $vehicle->trans == 'CVT' ? 'selected' : '' }}>CVT</option>
                                        <option value="DCT" {{ $vehicle->trans == 'DCT' ? 'selected' : '' }}>DCT</option>
                                        <option value="Tiptronic" {{ $vehicle->trans == 'Tiptronic' ? 'selected' : '' }}>Tiptronic</option>
                                        <option value="EV Single-Speed" {{ $vehicle->trans == 'EV Single-Speed' ? 'selected' : '' }}>EV Single-Speed</option> --}}
                                    </select>
                                </div>

                                <div class="form-group mb-2 col-4">
                                    <label for="city">{{ __('messages.exterior_color') }}</label>
                                    <input type="text" class="form-control" name="exterior"
                                        value="{{ $vehicle->exterior }}" placeholder="">
                                </div>
                                <div class="form-group mb-2 col-4">
                                    <label for="city">{{ __('messages.interior_color') }}</label>
                                    <input type="text" class="form-control" name="interior"
                                        value="{{ $vehicle->interior }}" placeholder="">
                                </div>
                                <div class="form-group mb-2 col-4">
                                    <label for="city">{{ __('messages.day_price') }}</label>
                                    <input type="text" class="form-control" name="Dprice"
                                        value="{{ $vehicle->Dprice }}" placeholder="">
                                </div>
                                <div class="form-group mb-2 col-4">
                                    <label for="city">{{ __('messages.week_price') }}</label>
                                    <input type="text" class="form-control" name="wprice"
                                        value="{{ $vehicle->wprice }}" placeholder="">
                                </div>
                                <div class="form-group mb-2 col-4">
                                    <label for="city">{{ __('messages.month_price') }}</label>
                                    <input type="text" class="form-control" name="mprice"
                                        value="{{ $vehicle->mprice }}" placeholder="">
                                </div>
                                <div class="form-group mb-2 col-4">
                                    <label for="city">{{ __('messages.kilometers') }}</label>
                                    <input type="number" class="form-control" name="mitter"
                                        value="{{ $vehicle->mitter }}" placeholder="">
                                </div>

                                <div class="form-group mb-2 col-4">
                                    <label
                                        for="permitted_kilometers_day">{{ __('messages.permitted_kilometers_day') }}</label>
                                    <input type="number" class="form-control" name="permitted_kilometers_day"
                                        value="{{ $vehicle->permitted_kilometers_day }}" placeholder="">
                                </div>

                                <div class="form-group mb-2 col-4">
                                    <label
                                        for="permitted_kilometers_week">{{ __('messages.permitted_kilometers_week') }}</label>
                                    <input type="number" class="form-control" name="permitted_kilometers_week"
                                        value="{{ $vehicle->permitted_kilometers_week }}" placeholder="">
                                </div>

                                <div class="form-group mb-2 col-4">
                                    <label
                                        for="permitted_kilometers_month">{{ __('messages.permitted_kilometers_month') }}</label>
                                    <input type="number" class="form-control" name="permitted_kilometers_week"
                                        value="{{ $vehicle->permitted_kilometers_month }}" placeholder="">
                                </div>
                                {{-- <div class="form-group mb-2 col-4">
                                    <label for="available">Available Time</label>
                                    <input type="time" class="form-control" name="available"
                                        value="{{ $vehicle->available_time ? \Carbon\Carbon::parse($vehicle->available_time)->format('H:i') : '' }}"
                                        placeholder="">
                                </div> --}}

                                <div class="form-group mb-2 col-4">
                                    <label for="status">{{ __('messages.status') }}</label>
                                    <select class="form-control" name="status" id="status">
                                        <option value="" disabled selected>Select Status</option>
                                        <option value="1" {{ $vehicle->status == 1 ? 'selected' : '' }}>
                                            {{ __('messages.active') }}
                                        </option>
                                        <option value="0" {{ $vehicle->status == 0 ? 'selected' : '' }}>
                                            {{ __('messages.inactive') }}
                                        </option>
                                    </select>
                                </div>
                                <br>
                                <div class="form-group mb-2 col-4">
                                    <label for="featured">{{ __('messages.featured') }}</label>
                                    <input type="checkbox" name="featured" value="1"
                                        {{ $vehicle->featured ? 'checked' : '' }}>
                                </div>
                                <div class="form-group mb-2 col-4">
                                    <label for="interior">{{ __('messages.features') }}</label><br>
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
                            <button type="submit" class="btn btn-primary">{{ __('messages.submit') }}</button>
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
@push('after-scripts')
    <script>
        $(document).ready(function() {
            // Handle new image selection
            $("#imageUpload").change(function(event) {
                let files = event.target.files;
                let previewContainer = document.getElementById('imagePreview');

                // Clear any existing previews
                previewContainer.innerHTML = '';

                for (let i = 0; i < files.length; i++) {
                    let file = files[i];

                    // Only process image files
                    if (!file.type.startsWith('image/')) {
                        continue;
                    }

                    let reader = new FileReader();

                    reader.onload = function(e) {
                        let imgDiv = document.createElement('div');
                        imgDiv.classList.add('img-preview');

                        let img = document.createElement('img');
                        img.src = e.target.result;
                        img.classList.add('img-fluid', 'preview-img');

                        let closeBtn = document.createElement('button');
                        closeBtn.innerText = '×';
                        closeBtn.classList.add('close-btn');

                        // Append close button functionality for new images
                        closeBtn.onclick = function() {
                            imgDiv.remove();
                        };

                        imgDiv.appendChild(img);
                        imgDiv.appendChild(closeBtn);
                        previewContainer.appendChild(imgDiv);
                    }

                    reader.readAsDataURL(file);
                }
            });

            // Handle close button for already uploaded images
            $('#existingImages').on('click', '.close-btn', function() {
                $(this).closest('.img-preview').remove();
            });
        });
    </script>
@endpush
