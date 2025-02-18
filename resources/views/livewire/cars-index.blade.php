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
                    <h4>{!! __('messages.price') !!}(CHF)</h4>
                    <div class="price-input">
                        <div class="field">
                            <span>Min</span>
                            <input type="number" class="input-min" min="{{ $dayPrice }}" value="{{ $dayPrice }}">
                        </div>
                        <div class="field">
                            <span>Max</span>
                            <input type="number" class="input-max" min="{{ $dayPrice }}"
                                value="{{ $maxPrice }}">
                        </div>
                    </div>
                    <div class="slider">
                        <div class="progress"></div>
                    </div>
                    <div class="range-input" wire:click="updateSearchPrice($event.target.value)">
                        <input type="range" class="range-min" min="{{ $dayPrice }}" max="{{ $maxPrice }}"
                            value="{{ $dayPrice }}" step="1">

                        <input type="range" class="range-max" min="{{ $dayPrice }}" max="{{ $maxPrice }}"
                            value="{{ $maxPrice }}" step="1">
                    </div>
                </div>
                <div class="item_filter_group">
                    <h4>{!! __('messages.vehicle_type') !!}</h4>
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
                            <input id="vehicle_type_3" wire:model.live="minibus" type="checkbox" value="vehicle_type_3">
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
                    <h4>Transmission</h4>
                    <div class="de_form">
                        <div class="de_checkbox">
                            <input id="trans1" wire:model.live="trans1" type="checkbox" value="trans1">
                            <label for="trans1">Automatic</label>
                        </div>

                        <div class="de_checkbox">
                            <input id="trans2" wire:model.live="trans2" type="checkbox" value="trans2">
                            <label for="trans2">Manual</label>
                        </div>
                    </div>
                </div>
                {{-- <div class="item_filter_group">
                    <h4>Car Seats</h4>
                    <div class="de_form">
                        @foreach ($availableSeats as $seat)
                            <div class="de_checkbox">
                                if(seat.count=0)
                                <input id="seat_{{ $seat }}" wire:model.live="selectedSeats" type="checkbox"
                                    value="{{ $seat }}">
                                <label for="seat_{{ $seat }}">{{ $seat }}
                                    {!! __('messages.seat') !!}</label>
                            </div>
                        @endforeach
                    </div>
                </div> --}}
                <div class="item_filter_group">
                    <h4>Car Seats</h4>
                    <div class="de_form">
                        @foreach ($availableSeats as $seat)
                            @if ($seat != 0)
                                <div class="de_checkbox">
                                    <input id="seat_{{ $seat }}" wire:model.live="selectedSeats"
                                        type="checkbox" value="{{ $seat }}">
                                    <label for="seat_{{ $seat }}">{{ $seat }}
                                        {!! __('messages.seat') !!}</label>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>

            </div>
            <div class="col-lg-9">
                <div class="row">
                    @foreach ($vehicles as $vehicle)
                        <div class="col-md-4  col-lg-6 col-xl-6 col-xxl-4 ">
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
                                @endif
                                --}}
                                    @if ($vehicle->image)
                                        @php
                                            $images = json_decode($vehicle->image);
                                        @endphp

                                        @if ($images && count($images) > 0)
                                            <img src="{{ asset('public/storage/' . $images[0]) }}" alt="vehicle"
                                                class="img-fluid w-100">
                                        @endif
                                    @endif
                                </div>
                                <div class="d-info">
                                    <div class="d-text">
                                        <h4>{{ $vehicle->name }}</h4>
                                        <div class="d-atr-group d-flex justify-content-between">
                                            @if ($vehicle->seat !== 0 && $vehicle->seat !== null)
                                                <span class="d-atr"><img src="images/icons/1.svg"
                                                        alt="">{{ $vehicle->seat }}</span>
                                            @endif

                                            <span class="d-atr"><img src="images/icons/2.svg"
                                                    alt="">{{ $vehicle->fuel }}</span>

                                            @if ($vehicle->door !== 0 && $vehicle->door !== null)
                                                <span class="d-atr"><img src="images/icons/3.svg"
                                                        alt="">{{ $vehicle->door }}</span>
                                            @endif

                                            <span class="d-atr"><img src="images/icons/4.svg"
                                                    alt="">{{ $vehicle->trans }}</span>
                                        </div>

                                        {{-- @if ($vehicles->seat !== 0 && $vehicles->seat !== null)
                                            <div class="d-row">
                                                <span class="d-title">{!! __('messages.seat') !!}</span>
                                                <span class="d-value">{{ $vehicles->seat }}</span>
                                            </div>
                                        @endif

                                        @if ($vehicles->door !== 0 && $vehicles->door !== null)
                                            <div class="d-row">
                                                <span class="d-title">{!! __('messages.door') !!}</span>
                                                <spam class="d-value">{{ $vehicles->door }}</spam>
                                            </div>
                                        @endif cars details --}}

                                        <div class="d-price">
                                            Prix
                                            <div class="d-flex justify-content-between">
                                                <div>
                                                    <span>
                                                        {{ round($vehicle->Dprice) }} CHF {!! __('messages.per_day') !!}
                                                    </span>
                                                </div>
                                                {{-- <form action="{{ route('carsdetails-post') }}" method="post">
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
                                                </form> --}}

                                                <a type="submit" class="btn-main"
                                                    href="{{ route('carsdetails', $vehicle->slug) }}">{!! __('messages.rent_now') !!}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
</section>
