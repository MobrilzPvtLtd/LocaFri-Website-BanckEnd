@extends('frontend.layouts.loca')

@section('title')
    {{ app_name() }} - {!! __('messages.cars') !!}
@endsection
<a href="https://wa.me/41793876020" target="_blank" style="position: fixed; bottom: 20px; right: 20px; z-index: 1000;">
    <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" alt="Chat with us on WhatsApp" style="width: 60px; height: 60px; border-radius: 50%; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);">
</a>


@php
    $pickUpLocation = session()->get('pickUpLocation');
    $dropOffLocation = session()->get('dropOffLocation');
    $pickUpDate = session()->get('pickUpDate');
    // dd($pickUpDate);
@endphp

@section('content')
    <div class="no-bottom no-top zebra" id="content">
        <div id="top"></div>

        <!-- section begin -->
        <section id="subheader" class="jarallax text-light">
            <img src="{{ asset('images/background/2.jpg') }}" class="jarallax-img" alt="">
            <div class="center-y relative text-center">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h1>{!! __('messages.vehicle_fleet') !!}</h1>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </section>
        <!-- section close -->

        <section id="section-car-details">
            <div class="container">
                <div class="row g-5">

                    <div class="col-lg-6">
                        <div id="slider-carousel" class="owl-carousel">
                            <div class="item">
                                {{-- @php
                                    $images = unserialize($vehicles->image);
                                @endphp
                                @if (!empty($images) && is_array($images) && count($images) > 0)
                                    <img src="{{ asset('public/' . $images[0]) }}" alt="Image" class="img-fluid w-100">
                                @else
                                    <p>No images available</p>
                                @endif --}}
                                @if($vehicles->image)
                                    @php
                                        $images = json_decode($vehicles->image);
                                    @endphp

                                    @if($images && count($images) > 0)
                                        <img src="{{ asset('public/storage/' . $images[0]) }}" alt="vehicle" class="img-fluid w-100">
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <h3>{{ $vehicles->name }}</h3>
                        <p>The ({{ $vehicles->name }}){{ $vehicles->desc }}</p>

                        <div class="spacer-10"></div>

                        <h4>{!! __('messages.specifications') !!}</h4>
                        <div class="de-spec">
                            <div class="d-row">
                                <span class="d-title">{!! __('messages.model') !!}</span>
                                <spam class="d-value">{{ $vehicles->model }}</spam>
                            </div>
                            {{-- <div class="d-row">
                                <span class="d-title">{!! __('messages.body') !!}</span>
                                <spam class="d-value">{{ $vehicles->body }}</spam>
                            </div> --}}
                            <div class="d-row">
                                <span class="d-title">{!! __('messages.seat') !!}</span>
                                <spam class="d-value">{{ $vehicles->seat }}</spam>
                            </div>
                            <div class="d-row">
                                <span class="d-title">{!! __('messages.door') !!}</span>
                                <spam class="d-value">{{ $vehicles->door }}</spam>
                            </div>
                            <div class="d-row">
                                <span class="d-title">{!! __('messages.luggage') !!}</span>
                                <spam class="d-value">{{ $vehicles->luggage }}</spam>
                            </div>
                            <div class="d-row">
                                <span class="d-title">{!! __('messages.fuel_type') !!}</span>
                                <spam class="d-value">{{ $vehicles->fuel }}</spam>
                            </div>
                            <div class="d-row de-flex">
                                <span class="d-title">{!! __('messages.authorized_kilometers') !!}</span>
                                <span class="d-value">{{ $vehicles->mitter }} <br>
                                    {{-- 1000kms / 1 week<br>
                                    3000kms / 1 month --}}
                                </span>
                            </div>
                            <div class="d-row">
                                <span class="d-title">{!! __('messages.transmission') !!}</span>
                                <spam class="d-value">{{ $vehicles->trans }}</spam>
                            </div>
                            <div class="d-row">
                                <span class="d-title">{!! __('messages.exterior_color') !!}</span>
                                <spam class="d-value">{{ $vehicles->exterior }}</spam>
                            </div>
                            <div class="d-row">
                                <span class="d-title">{!! __('messages.interior_color') !!}</span>
                                <spam class="d-value">{{ $vehicles->interior }}</spam>
                            </div>
                        </div>

                        <div class="spacer-single"></div>

                        <h4>{!! __('messages.features') !!}</h4>
                        <ul class="ul-style-2">

                            @php
                                $featuresArray = json_decode($vehicles->features);
                            @endphp
                            @if (!empty($featuresArray))
                                <ul>
                                    @foreach ($featuresArray as $feature)
                                        <li>{{ $feature }}</li>
                                    @endforeach
                                </ul>
                            @else
                                <p>{!! __('messages.no_features') !!}</p>
                            @endif
                        </ul>
                    </div>

                    <div class="col-lg-3">
                        <form id='contact_form' method="GET" action="{{ route('reservation') }}">
                            {{-- @csrf --}}
                            <input type="hidden" name="name" value="{{ $vehicles->name }}">
                            <div class="de-price text-center">
                                Prix
                                <h4>
                                    <input type="hidden" name="Dprice" id="Dprice" value="{{ $vehicles->Dprice }}">{{ $vehicles->Dprice }}/ 1 jour<br>
                                    <input type="hidden" name="wprice" id="wprice" value="{{ $vehicles->wprice }}">{{ $vehicles->wprice }}/ 1 semaine<br>
                                    <input type="hidden" name="mprice" id="mprice" value="{{ $vehicles->mprice }}">{{ $vehicles->mprice }} / 1 mois
                                </h4>
                            </div>
                            <div class="spacer-30"></div>
                            <div class="de-box mb25">
                                {{-- <form name="contactForm" id='contact_form' method="post"> --}}
                                <h4>{!! __('messages.booking_car') !!}</h4>

                                <div class="spacer-20"></div>

                                <div class="row">
                                    <div class="col-lg-12 mb20">
                                        <h5>{!! __('messages.pick_up_location') !!}</h5>
                                        <div class="date-time-field">

                                            <select name="pickUpLocation" id="pick_up" required>
                                                {{-- @if(session()->has('pickUpLocation'))
                                                    <option selected value="{{ session()->get('pickUpLocation') }}">
                                                        {{ session()->get('pickUpLocation') }}
                                                    </option>
                                                @else
                                                    <option selected disabled value="">Select pick up</option>
                                                @endif --}}

                                                @foreach (App\Models\Vehicle::where('location', '!=', null)->get() as $location)
                                                    <option value="{{ $location->location }}" {{ $location->location == $pickUpLocation ? 'selected' : '' }}>{{ $location->location }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="jls-address-preview jls-address-preview--hidden">
                                            <div class="jls-address-preview__header">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 mb20">
                                        <h5>{!! __('messages.drop_off_location') !!}</h5>
                                        <div class="date-time-field">
                                            <select name="dropOffLocation" id="Drop_Off" required>
                                                {{-- @if(session()->has('dropOffLocation'))
                                                    <option selected value="{{ session()->get('dropOffLocation') }}">
                                                        {{ session()->get('dropOffLocation') }}
                                                    </option>
                                                @else
                                                    <option selected disabled value="">Select drop off</option>
                                                @endif --}}

                                                @foreach (App\Models\Vehicle::where('location', '!=', null)->get() as $location)
                                                    <option value="{{ $location->location }}" {{ $location->location == $dropOffLocation ? 'selected' : '' }}>{{ $location->location }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="jls-address-preview jls-address-preview--hidden">
                                            <div class="jls-address-preview__header">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 mb20">
                                        <h5>{!! __('messages.pick_up_date_time') !!}</h5>
                                        <div class="date-time-field">
                                            {{-- <input type="text" id="date-picker" name="pickUpDate"
                                                value="{{ session()->get('pickUpDate') }}"> --}}

                                            <input type="text" name="pickUpDate" value="" class="form-control" style="width: 100%;"/>

                                            {{-- <input type="text" name="datetimes" class="form-control mt-4" style="width: 100%;"/> --}}

                                            {{-- <select name="pickUpTime" id="pickup-time">
                                                <option selected disabled value="{{ session()->get('pickUpTime') }}">
                                                    {{ session()->get('pickUpTime') }}</option>
                                                <option selected disabled value=""> Time</option>
                                                <option value="00:00">00:00</option>
                                                <option value="00:30">00:30</option>
                                                <option value="01:00">01:00</option>
                                                <option value="01:30">01:30</option>
                                                <option value="02:00">02:00</option>
                                                <option value="02:30">02:30</option>
                                                <option value="03:00">03:00</option>
                                                <option value="03:30">03:30</option>
                                                <option value="04:00">04:00</option>
                                                <option value="04:30">04:30</option>
                                                <option value="05:00">05:00</option>
                                                <option value="05:30">05:30</option>
                                                <option value="06:00">06:00</option>
                                                <option value="06:30">06:30</option>
                                                <option value="07:00">07:00</option>
                                                <option value="07:30">07:30</option>
                                                <option value="08:00">08:00</option>
                                                <option value="08:30">08:30</option>
                                                <option value="09:00">09:00</option>
                                                <option value="09:30">09:30</option>
                                                <option value="10:00">10:00</option>
                                                <option value="10:30">10:30</option>
                                                <option value="11:00">11:00</option>
                                                <option value="11:30">11:30</option>
                                                <option value="12:00">12:00</option>
                                                <option value="12:30">12:30</option>
                                                <option value="13:00">13:00</option>
                                                <option value="13:30">13:30</option>
                                                <option value="14:00">14:00</option>
                                                <option value="14:30">14:30</option>
                                                <option value="15:00">15:00</option>
                                                <option value="15:30">15:30</option>
                                                <option value="16:00">16:00</option>
                                                <option value="16:30">16:30</option>
                                                <option value="17:00">17:00</option>
                                                <option value="17:30">17:30</option>
                                                <option value="18:00">18:00</option>
                                                <option value="18:30">18:30</option>
                                                <option value="19:00">19:00</option>
                                                <option value="19:30">19:30</option>
                                                <option value="20:00">20:00</option>
                                                <option value="20:30">20:30</option>
                                                <option value="21:00">21:00</option>
                                                <option value="21:30">21:30</option>
                                                <option value="22:00">22:00</option>
                                                <option value="22:30">22:30</option>
                                                <option value="23:00">23:00</option>
                                                <option value="23:30">23:30</option>
                                            </select> --}}
                                        </div>
                                    </div>

                                    {{-- <div class="col-lg-12 mb20">
                                        <h5>Return Date & Time</h5>
                                        <div class="date-time-field">

                                            <input type="text" id="date-picker-2" name="collectionDate"
                                                value="{{ session()->get('collectionDate') }}">
                                            <select name="collectionTime" id="collection-time">
                                                <option selected disabled value="{{ session()->get('collectionTime') }}">
                                                    {{ session()->get('collectionTime') }}</option>
                                                    <option selected disabled value=""> Time</option>
                                                <option value="00:00">00:00</option>
                                                <option value="00:30">00:30</option>
                                                <option value="01:00">01:00</option>
                                                <option value="01:30">01:30</option>
                                                <option value="02:00">02:00</option>
                                                <option value="02:30">02:30</option>
                                                <option value="03:00">03:00</option>
                                                <option value="03:30">03:30</option>
                                                <option value="04:00">04:00</option>
                                                <option value="04:30">04:30</option>
                                                <option value="05:00">05:00</option>
                                                <option value="05:30">05:30</option>
                                                <option value="06:00">06:00</option>
                                                <option value="06:30">06:30</option>
                                                <option value="07:00">07:00</option>
                                                <option value="07:30">07:30</option>
                                                <option value="08:00">08:00</option>
                                                <option value="08:30">08:30</option>
                                                <option value="09:00">09:00</option>
                                                <option value="09:30">09:30</option>
                                                <option value="10:00">10:00</option>
                                                <option value="10:30">10:30</option>
                                                <option value="11:00">11:00</option>
                                                <option value="11:30">11:30</option>
                                                <option value="12:00">12:00</option>
                                                <option value="12:30">12:30</option>
                                                <option value="13:00">13:00</option>
                                                <option value="13:30">13:30</option>
                                                <option value="14:00">14:00</option>
                                                <option value="14:30">14:30</option>
                                                <option value="15:00">15:00</option>
                                                <option value="15:30">15:30</option>
                                                <option value="16:00">16:00</option>
                                                <option value="16:30">16:30</option>
                                                <option value="17:00">17:00</option>
                                                <option value="17:30">17:30</option>
                                                <option value="18:00">18:00</option>
                                                <option value="18:30">18:30</option>
                                                <option value="19:00">19:00</option>
                                                <option value="19:30">19:30</option>
                                                <option value="20:00">20:00</option>
                                                <option value="20:30">20:30</option>
                                                <option value="21:00">21:00</option>
                                                <option value="21:30">21:30</option>
                                                <option value="22:00">22:00</option>
                                                <option value="22:30">22:30</option>
                                                <option value="23:00">23:00</option>
                                                <option value="23:30">23:30</option>
                                            </select>
                                        </div>
                                    </div> --}}

                                    <div class="col-lg-12 mb20">
                                        {{-- <h5>Select Days</h5> --}}
                                        {{-- <div class="date-time-field">
                                            <select name="targetDate" id="pick_up" class="targetDate">
                                                <option selected disabled value="">Pick up Days</option>
                                                <option value="day">Day</option>
                                                <option value="week">Week</option>
                                                <option value="month">Month</option>
                                            </select>
                                        </div> --}}
                                        {{-- <div class="col-md-3 col-sm-3 search-col-padding month section"> --}}
                                            <label>{!! __('messages.month') !!}</label><br>
                                            <div class="d-flex gap-4">
                                                {{-- <button id="minus2">-</button> --}}
                                                <input type="text" id="counter003" name="month_count" value="0" class="form-control quantity-padding" readonly style="width: 100%;">
                                                {{-- <button id="plus2">+</button> --}}
                                            </div>
                                        {{-- </div> --}}

                                        {{-- <div class="col-md-3 col-sm-3 search-col-padding week section"> --}}
                                            <label>{!! __('messages.week') !!}</label><br>
                                            <div class="d-flex gap-4">
                                                {{-- <button id="minus1">-</button> --}}
                                                <input type="text" id="counter002" name="week_count" value="0" class="form-control quantity-padding" readonly style="width: 100%;">
                                                {{-- <button id="plus1">+</button> --}}
                                            </div>
                                        {{-- </div> --}}

                                        {{-- <div class="col-md-3 col-sm-3 search-col-padding day section"> --}}
                                            <label>{!! __('messages.day') !!}</label><br>
                                            <div class="d-flex gap-4">
                                                {{-- <button id="minus">-</button> --}}
                                                <input type="text" name="day_count" id="counter001" value="0" class="form-control quantity-padding"  readonly style="width: 100%; ">
                                                {{-- <button id="plus">+</button> --}}
                                            </div>
                                        {{-- </div> --}}

                                        {{-- <div class="form-check form-switch d-flex gap-4 mt-4">
                                            <input class="form-check-input" type="checkbox" id="additionalDriverCheckbox" name="additional_driver" value="20">
                                            <label class="form-check-label"  for="additionalDriverCheckbox">Additional driver<br>(20.-/per month)</label>
                                        </div> --}}
                                        <div class="form-check form-switch d-flex gap-4 mt-4">
                                            <input
                                                class="form-check-input"
                                                type="checkbox"
                                                id="additionalDriverCheckbox"
                                                name="additional_driver"
                                                value="20"
                                                onchange="toggleAdditionalDriverFields()"
                                            >
                                            <label class="form-check-label" for="additionalDriverCheckbox">
                                                {!! __('messages.additional_driver') !!}<br> 20 {!! __('messages.month') !!}
                                            </label>
                                        </div>

                                        <div id="additionalDriverFields" style="display: none;" class="mt-3">
                                            <div class="mb-2">
                                                <label for="additionalDriverName" class="form-label">{!! __('messages.driver_first_name') !!}</label>
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    id="additionalDriverName"
                                                    name="additional_driver_first_name"
                                                    placeholder="{!! __('messages.first_name') !!}"
                                                >
                                            </div>
                                            <div class="mb-2">
                                                <label for="additionalDriverSurname" class="form-label">{!! __('messages.driver_last_name') !!}</label>
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    id="additionalDriverSurname"
                                                    name="additional_driver_last_name"
                                                    placeholder="{!! __('messages.last_name') !!}"
                                                >
                                            </div>
                                        </div>

                                        <script>
                                            function toggleAdditionalDriverFields() {
                                                const checkbox = document.getElementById('additionalDriverCheckbox');
                                                const additionalDriverFields = document.getElementById('additionalDriverFields');

                                                if (checkbox.checked) {
                                                    additionalDriverFields.style.display = 'block';
                                                } else {
                                                    additionalDriverFields.style.display = 'none';
                                                }
                                            }
                                        </script>


                                        <div class="form-check form-switch d-flex gap-4">
                                            <input class="form-check-input" type="checkbox" id="boosterSeatCheckbox" name="booster_seat" value="20">
                                            <label class="form-check-label" for="boosterSeatCheckbox">{!! __('messages.booster_seat') !!}<br>(20/month)</label>
                                        </div>

                                        <div class="form-check form-switch d-flex gap-4">
                                            <input class="form-check-input" type="checkbox" id="childSeatCheckbox" name="child_seat" value="30">
                                            <label class="form-check-label" for="childSeatCheckbox">{!! __('messages.child_seat') !!}<br>(30/month)</label>
                                        </div>

                                        <div class="form-check form-switch d-flex gap-4">
                                            <input class="form-check-input" type="checkbox" id="exitPermitCheckbox" name="exit_permit" value="149">
                                            <label class="form-check-label" for="exitPermitCheckbox">{!! __('messages.exit_permit') !!}<br>(149/month)</label>
                                        </div>

                                        <div class="form-floating">
                                            <textarea class="form-control"name="message" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
                                            <label for="floatingTextarea2">{!! __('messages.leave_comment') !!}</label>
                                        </div>
                                    </div>
                                </div>

                                <input type='submit' id='send_message' value='{!! __('messages.book_now') !!}' class="btn-main btn-fullwidth">

                                <div class="clearfix"></div>
                                <div class="de-price text-center mt-2">
                                    Total Price
                                    <h4>
                                        <input type="hidden" name="total_price" id="totalPrice" value="0">
                                        <p id="totalPriceDisplay">0</p>
                                        <br>
                                    </h4>
                                </div>
                        </form>
                    </div>

                    <div class="de-box">
                        <h4>{!! __('messages.share') !!}</h4>
                        <div class="de-color-icons">
                            <span><i class="fa fa-twitter fa-lg"></i></span>
                            <span><i class="fa fa-facebook fa-lg"></i></span>
                            <span><i class="fa fa-reddit fa-lg"></i></span>
                            <span><i class="fa fa-linkedin fa-lg"></i></span>
                            <span><i class="fa fa-pinterest fa-lg"></i></span>
                            <span><i class="fa fa-stumbleupon fa-lg"></i></span>
                            <span><i class="fa fa-delicious fa-lg"></i></span>
                            <span><i class="fa fa-envelope fa-lg"></i></span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>


    </div>
    <!-- content close -->

@endsection
{{-- @section('script')
    <script>
        $(document).ready(function() {
            // $('.section').hide();
            var totalPrice = parseFloat($("#totalPrice").val()) || 0;
            console.log(totalPrice);

            var dayVal = parseFloat($("#Dprice").val()) || 0;
            var weekVal = parseFloat($("#wprice").val()) || 0;
            var monthVal = parseFloat($("#mprice").val()) || 0;
            var additionalDriverVal = parseFloat($("#additionalDriverCheckbox").val()) || 0;
            var boosterSeatVal = parseFloat($("#boosterSeatCheckbox").val()) || 0;
            var childSeatVal = parseFloat($("#childSeatCheckbox").val()) || 0;
            var exitPermitVal = parseFloat($("#exitPermitCheckbox").val()) || 0;


            // $(".targetDate").change(function() {
            //     var value = $(this).val();
            //     var totalPrice = totalVal;

            //     $(".section").hide();

            //     if (value == 'day') {
            //         $(".day").show();
            //         totalPrice += dayVal;
            //     } else if (value == 'week') {
            //         $(".week").show();
            //         totalPrice += weekVal;
            //     } else if (value == 'month') {
            //         $(".month").show();
            //         totalPrice += monthVal;
            //     }
            //     updateTotalPrice(value);
            //     // $("#totalPrice").val(totalPrice);
            //     // $("#totalPriceDisplay").text(totalPrice);
            // });

            // function updateTotalPrice(value) {
            //     var dayCount = parseFloat($("#counter001").val()) || 0;
            //     var weekCount = parseFloat($("#counter002").val()) || 0;
            //     var monthCount = parseFloat($("#counter003").val()) || 0;

            //     var totalPrice = totalVal;
            //     if (value == "day") {
            //         totalPrice += (dayCount * dayVal);
            //     } else if (value == "week") {
            //         totalPrice += (weekCount * weekVal);
            //     } else if (value == "month") {
            //         totalPrice += (monthCount * monthVal);
            //     }

            //     if ($("#additionalDriverCheckbox").is(':checked')) {
            //         totalPrice += additionalDriverVal;
            //     } else {
            //         totalPrice = totalPrice;
            //     }

            //     if ($("#boosterSeatCheckbox").is(':checked')) {
            //         totalPrice += boosterSeatVal;
            //     } else {
            //         totalPrice = totalPrice;
            //     }

            //     if ($("#childSeatCheckbox").is(':checked')) {
            //         totalPrice += childSeatVal;
            //     } else {
            //         totalPrice = totalPrice;
            //     }

            //     if ($("#exitPermitCheckbox").is(':checked')) {
            //         totalPrice += exitPermitVal;
            //     } else {
            //         totalPrice = totalPrice;
            //     }

            //     console.log(totalPrice);

            //     $("#totalPrice").val(totalPrice);
            //     $("#totalPriceDisplay").text(totalPrice);
            // }

            // $("#plus").click(function() {
            //     var counter001Val = parseFloat($("#counter001").val()) || 0;
            //     $("#counter001").val(counter001Val);
            //     updateTotalPrice("day");
            // });

            // $("#plus1").click(function() {
            //     var counter002Val = parseFloat($("#counter002").val()) || 0;
            //     $("#counter002").val(counter002Val);
            //     updateTotalPrice("week");
            // });

            // $("#plus2").click(function() {
            //     var counter003Val = parseFloat($("#counter003").val()) || 0;
            //     $("#counter003").val(counter003Val);
            //     updateTotalPrice("month");
            // });

            // $("#minus").click(function() {
            //     var counter001Val = parseFloat($("#counter001").val()) || 0;
            //     if (counter001Val > 0) {
            //         $("#counter001").val(counter001Val);
            //     }
            //     updateTotalPrice("day");
            // });

            // $("#minus1").click(function() {
            //     var counter002Val = parseFloat($("#counter002").val()) || 0;
            //     if (counter002Val > 0) {
            //         $("#counter002").val(counter002Val);
            //     }
            //     updateTotalPrice("week");
            // });

            // $("#minus2").click(function() {
            //     var counter003Val = parseFloat($("#counter003").val()) || 0;
            //     if (counter003Val > 0) {
            //         $("#counter003").val(counter003Val);
            //     }
            //     updateTotalPrice("month");
            // });

            // $("#additionalDriverCheckbox").change(function() {
            //     var currentDateSelection = $(".targetDate").val();
            //     updateTotalPrice(currentDateSelection);
            // });

            // $("#boosterSeatCheckbox").change(function() {
            //     var currentDateSelection = $(".targetDate").val();
            //     updateTotalPrice(currentDateSelection);
            // });

            // $("#childSeatCheckbox").change(function() {
            //     var currentDateSelection = $(".targetDate").val();
            //     updateTotalPrice(currentDateSelection);
            // });

            // $("#exitPermitCheckbox").change(function() {
            //     var currentDateSelection = $(".targetDate").val();
            //     updateTotalPrice(currentDateSelection);
            // });
        });
    </script>
@endsection --}}
