<section id="section-cars">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                @php
                    $vehicle = App\Models\Vehicle::get();
                    $dayPrice = PHP_INT_MAX;
                    $maxPrice = 0;
                    foreach ($vehicle as $key => $value) {
                        if ($value->Dprice < $dayPrice) {
                            $dayPrice = $value->Dprice;
                        }
                        if ($value->mprice > $maxPrice) {
                            $maxPrice = $value->mprice;
                        }
                    }
                @endphp
                <div class="item_filter_group">
                    <h4>Price (CHF)</h4>
                    <div class="price-input">
                        <div class="field">
                            <span>Min</span>
                            <input type="number" class="input-min" min="{{ $dayPrice }}" value="{{ $dayPrice }}">
                        </div>
                        <div class="field">
                            <span>Max</span>
                            <input type="number" class="input-max" min="{{ $dayPrice }}" value="{{ $maxPrice }}">
                        </div>
                    </div>
                    <div class="slider">
                        <div class="progress"></div>
                    </div>
                    <div class="range-input" wire:click="updateSearchPrice($event.target.value)">
                        <input type="range" class="range-min" min="{{ $dayPrice }}" max="{{ $maxPrice }}" value="{{ $dayPrice }}" step="1">

                        <input type="range" class="range-max" min="{{ $dayPrice }}" max="{{ $maxPrice }}" value="{{ $maxPrice }}" step="1">
                    </div>
                </div>

                <div class="item_filter_group">
                    <h4>Vehicle Type</h4>
                    <div class="de_form">
                        <div class="de_checkbox">
                            <input id="vehicle_type_1" wire:model.live="car" type="checkbox" value="type">
                            <label for="vehicle_type_1">Car</label>
                        </div>

                        <div class="de_checkbox">
                            <input id="vehicle_type_2" wire:model.live="van" type="checkbox" value="vehicle_type_2">
                            <label for="vehicle_type_2">Van</label>
                        </div>

                        <div class="de_checkbox">
                            <input id="vehicle_type_3" wire:model.live="minibus" type="checkbox"
                                value="vehicle_type_3">
                            <label for="vehicle_type_3">Minibus</label>
                        </div>

                        <div class="de_checkbox">
                            <input id="vehicle_type_4" wire:model.live="prestige" type="checkbox"
                                value="vehicle_type_4">
                            <label for="vehicle_type_4">Prestige</label>
                        </div>

                    </div>
                </div>

                <div class="item_filter_group">
                    <h4>Car Body Type</h4>
                    <div class="de_form">
                        <div class="de_checkbox">
                            <input id="car_body_type_1" wire:model.live="convertible" type="checkbox"
                                value="car_body_type_1">
                            <label for="car_body_type_1">Convertible</label>
                        </div>

                        <div class="de_checkbox">
                            <input id="car_body_type_2" wire:model.live="coupe" type="checkbox"
                                value="car_body_type_2">
                            <label for="car_body_type_2">Coupe</label>
                        </div>

                        <div class="de_checkbox">
                            <input id="car_body_type_3" wire:model.live="exoticcars" type="checkbox"
                                value="car_body_type_3">
                            <label for="car_body_type_3">Exotic Cars</label>
                        </div>

                        <div class="de_checkbox">
                            <input id="car_body_type_4" wire:model.live="hatchback" type="checkbox"
                                value="car_body_type_4">
                            <label for="car_body_type_4">Hatchback</label>
                        </div>

                        <div class="de_checkbox">
                            <input id="car_body_type_5" wire:model.live="minivan" type="checkbox"
                                value="car_body_type_5">
                            <label for="car_body_type_5">Minivan</label>
                        </div>

                        <div class="de_checkbox">
                            <input id="car_body_type_6" wire:model.live="pickuptruck" type="checkbox"
                                value="car_body_type_6">
                            <label for="car_body_type_6">Pickup Truck</label>
                        </div>

                        <div class="de_checkbox">
                            <input id="car_body_type_7" wire:model.live="sedan" type="checkbox"
                                value="car_body_type_7">
                            <label for="car_body_type_7">Sedan</label>
                        </div>

                        <div class="de_checkbox">
                            <input id="car_body_type_8" wire:model.live="sportscar" type="checkbox"
                                value="car_body_type_8">
                            <label for="car_body_type_8">Sports Car</label>
                        </div>

                        <div class="de_checkbox">
                            <input id="car_body_type_9"wire:model.live="stationwagon" type="checkbox"
                                value="car_body_type_9">
                            <label for="car_body_type_9">Station Wagon</label>
                        </div>

                        <div class="de_checkbox">
                            <input id="car_body_type_10" wire:model.live="suv" type="checkbox"
                                value="car_body_type_10">
                            <label for="car_body_type_10">SUV</label>
                        </div>

                    </div>
                </div>

                <div class="item_filter_group">
                    <h4>Car Seats</h4>
                    <div class="de_form">
                        <div class="de_checkbox">
                            <input id="car_seat_1" wire:model.live="seats2" type="checkbox" value="car_seat_1">
                            <label for="car_seat_1">3 seats</label>
                        </div>

                        <div class="de_checkbox">
                            <input id="car_seat_2" wire:model.live="seats4" type="checkbox" value="car_seat_2">
                            <label for="car_seat_2">4 seats</label>
                        </div>

                        <div class="de_checkbox">
                            <input id="car_seat_3" wire:model.live="seats6" type="checkbox" value="car_seat_3">
                            <label for="car_seat_3">5 seats</label>
                        </div>

                        <div class="de_checkbox">
                            <input id="car_seat_4" wire:model.live="seats6plus" type="checkbox"
                                value="car_seat_4">
                            <label for="car_seat_4">9 seats</label>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-lg-9">
                <div class="row">
                    @foreach ($vehicles as $vehicle)
                        <div class="col-xl-4 col-lg-6">
                            <div class="de-item mb30">
                                <div class="d-img">
                                    {{-- @php
                                        $images = unserialize($vehicle->image);
                                    @endphp
                                    @if (!empty($images) && is_array($images) && count($images) > 0)
                                        <img src="{{ asset('public/' . $images[0]) }}" alt="Image"
                                            class="img-fluid w-100">
                                    @else
                                        <p>No images available</p>
                                    @endif --}}
                                    @if($vehicle->image)
                                        @php
                                            $images = json_decode($vehicle->image);
                                        @endphp

                                        @if($images && count($images) > 0)
                                            <img src="{{ asset('public/storage/' . $images[0]) }}" alt="vehicle" class="img-fluid w-100">
                                        @endif
                                    @endif
                                </div>
                                <div class="d-info">
                                    <div class="d-text">
                                        <h4>{{ $vehicle->name }}</h4>
                                        <div class="d-item_like">
                                            <i class="fa fa-heart"></i><span>25</span>
                                        </div>
                                        <div class="d-atr-group">
                                            <span class="d-atr"><img src="images/icons/1.svg"
                                                    alt="">{{ $vehicle->seat }}</span>
                                            <span class="d-atr"><img src="images/icons/2.svg"
                                                    alt="">{{ $vehicle->fuel }}
                                            </span>
                                            <span class="d-atr"><img src="images/icons/3.svg"
                                                    alt="">{{ $vehicle->door }}</span>
                                            <span class="d-atr"><img src="images/icons/4.svg"
                                                    alt="">{{ $vehicle->trans }}</span>
                                        </div>
                                        <div class="d-price">
                                            Prix <span>35.-/1 jour</span>
                                            <form action="{{ route('carsdetails-post') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="slug"
                                                    value="{{ $vehicle->slug }}">
                                                <input type="hidden" name="pickUpLocation"
                                                    value="{{ session()->get('pickUpLocation') }}">
                                                <input type="hidden" name="dropOffLocation"
                                                    value="{{ session()->get('dropOffLocation') }}">
                                                <input type="hidden" name="pickUpDate"
                                                    value="{{ session()->get('pickUpDate') }}">
                                                <input type="hidden" name="pickUpTime"
                                                    value="{{ session()->get('pickUpTime') }}">
                                                <input type="hidden" name="collectionDate"
                                                    value="{{ session()->get('collectionDate') }}">
                                                <input type="hidden" name="collectionTime"
                                                    value="{{ session()->get('collectionTime') }}">
                                                <button type="submit" class="btn-main"
                                                    href="{{ route('carsdetails-post') }}">Rent Now</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- <div class="col-xl-4 col-lg-6">
                                        <div class="de-item mb30">
                                            <div class="d-img">
                                                <img src="images/cars/2-removebg-preview.png" class="img-fluid" alt="">
                                            </div>
                                            <div class="d-info">
                                                <div class="d-text">
                                                    <h4>Car name</h4>
                                                    <div class="d-item_like">
                                                        <i class="fa fa-heart"></i><span>79</span>
                                                    </div>
                                                    <div class="d-atr-group">
                                                        <span class="d-atr"><img src="images/icons/1.svg" alt="">7</span>
                                                        <span class="d-atr"><img src="images/icons/2.svg" alt="">Diesel.</span>
                                                        <span class="d-atr"><img src="images/icons/3.svg" alt="">5</span>
                                                        <span class="d-atr"><img src="images/icons/4.svg" alt="">Manuel</span>
                                                    </div>
                                                    <div class="d-price">
                                                        Prix <span>45.-/1 jour</span>
                                                        <a class="btn-main" href="car-single.html">Rent Now</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}

                        {{-- <div class="col-xl-4 col-lg-6">
                                        <div class="de-item mb30">
                                            <div class="d-img">
                                                <img src="images/cars/3-removebg-preview.png" class="img-fluid" alt="">
                                            </div>
                                            <div class="d-info">
                                                <div class="d-text">
                                                    <h4>Car name</h4>
                                                    <div class="d-item_like">
                                                        <i class="fa fa-heart"></i><span>55</span>
                                                    </div>
                                                    <div class="d-atr-group">
                                                        <span class="d-atr"><img src="images/icons/1.svg" alt="">5</span>
                                                        <span class="d-atr"><img src="images/icons/2.svg" alt="">Essence</span>
                                                        <span class="d-atr"><img src="images/icons/3.svg" alt="">5</span>
                                                        <span class="d-atr"><img src="images/icons/4.svg" alt="">Automatique</span>
                                                    </div>
                                                    <div class="d-price">
                                                        Prix <span>45.-/1 jour</span>
                                                        <a class="btn-main" href="car-single.html">Rent Now</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}

                        {{-- <div class="col-xl-4 col-lg-6">
                                        <div class="de-item mb30">
                                            <div class="d-img">
                                                <img src="images/cars/4-removebg-preview.png" class="img-fluid" alt="">
                                            </div>
                                            <div class="d-info">
                                                <div class="d-text">
                                                    <h4>Car name</h4>
                                                    <div class="d-item_like">
                                                        <i class="fa fa-heart"></i><span>89</span>
                                                    </div>
                                                    <div class="d-atr-group">
                                                        <span class="d-atr"><img src="images/icons/1.svg" alt="">5</span>
                                                        <span class="d-atr"><img src="images/icons/2.svg" alt="">Essence </span>
                                                        <span class="d-atr"><img src="images/icons/3.svg" alt="">5</span>
                                                        <span class="d-atr"><img src="images/icons/4.svg" alt="">Automatique</span>
                                                    </div>
                                                    <div class="d-price">
                                                        Prix <span>45.-/1 jour</span>
                                                        <a class="btn-main" href="car-single.html">Rent Now</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}

                        {{-- <div class="col-xl-4 col-lg-6">
                                        <div class="de-item mb30">
                                            <div class="d-img">
                                                <img src="images/cars/5-removebg-preview.png" class="img-fluid" alt="">
                                            </div>
                                            <div class="d-info">
                                                <div class="d-text">
                                                    <h4>Car name</h4>
                                                    <div class="d-item_like">
                                                        <i class="fa fa-heart"></i><span>87</span>
                                                    </div>
                                                    <div class="d-atr-group">
                                                        <span class="d-atr"><img src="images/icons/1.svg" alt="">5</span>
                                                        <span class="d-atr"><img src="images/icons/2.svg" alt="">Essence</span>
                                                        <span class="d-atr"><img src="images/icons/3.svg" alt="">5</span>
                                                        <span class="d-atr"><img src="images/icons/4.svg" alt="">Automatique</span>
                                                    </div>
                                                    <div class="d-price">
                                                        Prix <span>45.-/1 jour</span>
                                                        <a class="btn-main" href="car-single.html">Rent Now</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}

                        {{-- <div class="col-xl-4 col-lg-6">
                                        <div class="de-item mb30">
                                            <div class="d-img">
                                                <img src="images/cars/6-removebg-preview.png" class="img-fluid" alt="">
                                            </div>
                                            <div class="d-info">
                                                <div class="d-text">
                                                    <h4>Car name</h4>
                                                    <div class="d-item_like">
                                                        <i class="fa fa-heart"></i><span>37</span>
                                                    </div>
                                                    <div class="d-atr-group">
                                                        <span class="d-atr"><img src="images/icons/1.svg" alt="">5</span>
                                                        <span class="d-atr"><img src="images/icons/2.svg" alt="">Essence </span>
                                                        <span class="d-atr"><img src="images/icons/3.svg" alt="">5</span>
                                                        <span class="d-atr"><img src="images/icons/4.svg" alt="">Manuel </span>
                                                    </div>
                                                    <div class="d-price">
                                                        Prix <span>35.-/1 jour</span>
                                                        <a class="btn-main" href="car-single.html">Rent Now</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}

                        {{-- <div class="col-xl-4 col-lg-6">
                                        <div class="de-item mb30">
                                            <div class="d-img">
                                                <img src="images/cars/7-removebg-preview.png" class="img-fluid" alt="">
                                            </div>
                                            <div class="d-info">
                                                <div class="d-text">
                                                    <h4>Car name</h4>
                                                    <div class="d-item_like">
                                                        <i class="fa fa-heart"></i><span>39</span>
                                                    </div>
                                                    <div class="d-atr-group">
                                                        <span class="d-atr"><img src="images/icons/1.svg" alt="">5</span>
                                                        <span class="d-atr"><img src="images/icons/2.svg" alt="">Essence </span>
                                                        <span class="d-atr"><img src="images/icons/3.svg" alt="">5</span>
                                                        <span class="d-atr"><img src="images/icons/4.svg" alt="">Manuel </span>
                                                    </div>
                                                    <div class="d-price">
                                                        Prix <span>40.-/1 jour</span>
                                                        <a class="btn-main" href="car-single.html">Rent Now</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}

                        {{-- <div class="col-xl-4 col-lg-6">
                                        <div class="de-item mb30">
                                            <div class="d-img">
                                                <img src="images/cars/12-removebg-preview.png" class="img-fluid" alt="">
                                            </div>
                                            <div class="d-info">
                                                <div class="d-text">
                                                    <h4>Car name</h4>
                                                    <div class="d-item_like">
                                                        <i class="fa fa-heart"></i><span>23</span>
                                                    </div>
                                                    <div class="d-atr-group">
                                                        <span class="d-atr"><img src="images/icons/1.svg" alt="">9</span>
                                                        <span class="d-atr"><img src="images/icons/2.svg" alt="">Diesel.</span>
                                                        <span class="d-atr"><img src="images/icons/3.svg" alt="">5</span>
                                                        <span class="d-atr"><img src="images/icons/4.svg" alt="">Manuel </span>
                                                    </div>
                                                    <div class="d-price">
                                                        Prix <span>89.-/1 jour</span>
                                                        <a class="btn-main" href="car-single.html">Rent Now</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}

                        {{-- <div class="col-xl-4 col-lg-6">
                                        <div class="de-item mb30">
                                            <div class="d-img">
                                                <img src="images/cars/8-removebg-preview.png" class="img-fluid" alt="">
                                            </div>
                                            <div class="d-info">
                                                <div class="d-text">
                                                    <h4>Car name</h4>
                                                    <div class="d-item_like">
                                                        <i class="fa fa-heart"></i><span>63</span>
                                                    </div>
                                                    <div class="d-atr-group">
                                                        <span class="d-atr"><img src="images/icons/1.svg" alt="">5</span>
                                                        <span class="d-atr"><img src="images/icons/2.svg" alt="">Essence</span>
                                                        <span class="d-atr"><img src="images/icons/3.svg" alt="">5</span>
                                                        <span class="d-atr"><img src="images/icons/4.svg" alt="">Manuel </span>
                                                    </div>
                                                    <div class="d-price">
                                                        Prix <span>35.-/1 jour</span>
                                                        <a class="btn-main" href="car-single.html">Rent Now</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}

                        {{-- <div class="col-xl-4 col-lg-6">
                                        <div class="de-item mb30">
                                            <div class="d-img">
                                                <img src="images/cars/9-removebg-preview.png" class="img-fluid" alt="">
                                            </div>
                                            <div class="d-info">
                                                <div class="d-text">
                                                    <h4>Car name</h4>
                                                    <div class="d-item_like">
                                                        <i class="fa fa-heart"></i><span>45</span>
                                                    </div>
                                                    <div class="d-atr-group">
                                                        <span class="d-atr"><img src="images/icons/1.svg" alt="">5</span>
                                                        <span class="d-atr"><img src="images/icons/2.svg" alt="">Essence </span>
                                                        <span class="d-atr"><img src="images/icons/3.svg" alt="">5</span>
                                                        <span class="d-atr"><img src="images/icons/4.svg" alt="">Automatique</span>
                                                    </div>
                                                    <div class="d-price">
                                                        Prix <span>45.-/1 jour</span>
                                                        <a class="btn-main" href="car-single.html">Rent Now</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}

                        {{-- <div class="col-xl-4 col-lg-6">
                                        <div class="de-item mb30">
                                            <div class="d-img">
                                                <img src="images/cars/10-removebg-preview.png" class="img-fluid" alt="">
                                            </div>
                                            <div class="d-info">
                                                <div class="d-text">
                                                    <h4>Car name</h4>
                                                    <div class="d-item_like">
                                                        <i class="fa fa-heart"></i><span>61</span>
                                                    </div>
                                                    <div class="d-atr-group">
                                                        <span class="d-atr"><img src="images/icons/1.svg" alt="">5</span>
                                                        <span class="d-atr"><img src="images/icons/2.svg" alt="">Diesel</span>
                                                        <span class="d-atr"><img src="images/icons/3.svg" alt="">5</span>
                                                        <span class="d-atr"><img src="images/icons/4.svg" alt="">Automatique</span>
                                                    </div>
                                                    <div class="d-price">
                                                        Prix <span>45.-/1 jour</span>
                                                        <a class="btn-main" href="car-single.html">Rent Now</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}

                        {{-- <div class="col-xl-4 col-lg-6">
                                        <div class="de-item mb30">
                                            <div class="d-img">
                                                <img src="images/cars/11-removebg-preview.png" class="img-fluid" alt="">
                                            </div>
                                            <div class="d-info">
                                                <div class="d-text">
                                                    <h4>Car name</h4>
                                                    <div class="d-item_like">
                                                        <i class="fa fa-heart"></i><span>61</span>
                                                    </div>
                                                    <div class="d-atr-group">
                                                        <span class="d-atr"><img src="images/icons/1.svg" alt="">5</span>
                                                        <span class="d-atr"><img src="images/icons/2.svg" alt="">Essence </span>
                                                        <span class="d-atr"><img src="images/icons/3.svg" alt="">5</span>
                                                        <span class="d-atr"><img src="images/icons/4.svg" alt="">Automatique </span>
                                                    </div>
                                                    <div class="d-price">
                                                        Prix <span>45.-/1 jour</span>
                                                        <a class="btn-main" href="car-single.html">Rent Now</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}

                        {{-- <div class="col-xl-4 col-lg-6">
                                        <div class="de-item mb30">
                                            <div class="d-img">
                                                <img src="images/cars/car_14-removebg-preview.png" class="img-fluid" alt="">
                                            </div>
                                            <div class="d-info">
                                                <div class="d-text">
                                                    <h4>Car name</h4>
                                                    <div class="d-item_like">
                                                        <i class="fa fa-heart"></i><span>61</span>
                                                    </div>
                                                    <div class="d-atr-group">
                                                        <span class="d-atr"><img src="images/icons/1.svg" alt="">3</span>
                                                        <span class="d-atr"><img src="images/icons/2.svg" alt="">Diesel</span>
                                                        <span class="d-atr"><img src="images/icons/3.svg" alt="">5</span>
                                                        <span class="d-atr"><img src="images/icons/4.svg" alt="">Manuel </span>
                                                    </div>
                                                    <div class="d-price">
                                                        Prix <span>80.-/1 jour</span>
                                                        <a class="btn-main" href="car-single.html">Rent Now</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}

                        {{-- <div class="col-xl-4 col-lg-6">
                                        <div class="de-item mb30">
                                            <div class="d-img">
                                                <img src="images/cars/car_8-removebg-preview.png" class="img-fluid" alt="">
                                            </div>
                                            <div class="d-info">
                                                <div class="d-text">
                                                    <h4>Car name</h4>
                                                    <div class="d-item_like">
                                                        <i class="fa fa-heart"></i><span>69</span>
                                                    </div>
                                                    <div class="d-atr-group">
                                                        <span class="d-atr"><img src="images/icons/1.svg" alt="">3</span>
                                                        <!-- <span class="d-atr"><img src="images/icons/2.svg" alt="">2</span>
                                                                <span class="d-atr"><img src="images/icons/3.svg" alt="">4</span>
                                                                <span class="d-atr"><img src="images/icons/4.svg" alt="">Exotic Car</span> -->
                                                    </div>
                                                    <div class="d-price">
                                                        Prix <span>30.-/1 jour</span>
                                                        <a class="btn-main" href="car-single.html">Rent Now</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</section>
