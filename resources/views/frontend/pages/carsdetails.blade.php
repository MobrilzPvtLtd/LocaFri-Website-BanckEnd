@extends('frontend.layouts.loca')

@section('title')
    {{ app_name() }} - Cars
@endsection

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
                            <h1>Vehicle Fleet</h1>
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
                                @php
                                    $images = unserialize($vehicles->image);
                                @endphp
                                @if (!empty($images) && is_array($images) && count($images) > 0)
                                    <img src="{{ asset('public/' . $images[0]) }}" alt="Image" class="img-fluid w-100">
                                @else
                                    <p>No images available</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <h3>{{ $vehicles->name }}</h3>
                        <p>The ({{ $vehicles->name }}){{ $vehicles->desc }}</p>

                        <div class="spacer-10"></div>

                        <h4>Specifications</h4>
                        <div class="de-spec">
                            <div class="d-row">
                                <span class="d-title">Body </span>
                                <spam class="d-value">{{ $vehicles->body }}</spam>
                            </div>
                            <div class="d-row">
                                <span class="d-title">Seat</span>
                                <spam class="d-value">{{ $vehicles->seat }} seats</spam>
                            </div>
                            <div class="d-row">
                                <span class="d-title">Door</span>
                                <spam class="d-value">{{ $vehicles->door }} doors</spam>
                            </div>
                            <div class="d-row">
                                <span class="d-title">Luggage</span>
                                <spam class="d-value">{{ $vehicles->luggage }}</spam>
                            </div>
                            <div class="d-row">
                                <span class="d-title">Fuel Type</span>
                                <spam class="d-value">{{ $vehicles->fuel }}</spam>
                            </div>
                            <div class="d-row de-flex">
                                <span class="d-title">Authorized kilometers</span>
                                <span class="d-value">{{ $vehicles->mitter }} kms / 1 month<br>
                                    {{-- 1000kms / 1 week<br>
                                    3000kms / 1 month --}}
                                </span>
                            </div>
                            <div class="d-row">
                                <span class="d-title">Transmission</span>
                                <spam class="d-value">{{ $vehicles->trans }}</spam>
                            </div>
                            <div class="d-row">
                                <span class="d-title">Exterior Color</span>
                                <spam class="d-value">{{ $vehicles->exterior }}</spam>
                            </div>
                            <div class="d-row">
                                <span class="d-title">Interior Color</span>
                                <spam class="d-value">{{ $vehicles->interior }}</spam>
                            </div>
                        </div>

                        <div class="spacer-single"></div>

                        <h4>Features</h4>
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
                                <p>No features available</p>
                            @endif

                        </ul>
                    </div>

                    <div class="col-lg-3">
                        <form name="contactForm" id='contact_form' method="post" action="{{ route('booking') }}">
                            @csrf
                            <input type="hidden" name="name" value="{{ $vehicles->name }}">
                            <div class="de-price text-center">
                                Prix
                                <h4> <input type="hidden" name="Dprice"
                                        value="{{ $vehicles->Dprice }}">{{ $vehicles->Dprice }}.- / 1 jour<br>
                                    <input type="hidden" name="wprice"
                                        value="{{ $vehicles->wprice }}">{{ $vehicles->wprice }}.- / 1 semaine<br>
                                    <input type="hidden" name="mprice"
                                        value="{{ $vehicles->mprice }}">{{ $vehicles->mprice }}.- / 1 mois
                                </h4>
                            </div>
                            <div class="spacer-30"></div>
                            <div class="de-box mb25">
                                {{-- <form name="contactForm" id='contact_form' method="post"> --}}
                                <h4>Booking this car</h4>

                                <div class="spacer-20"></div>

                                <div class="row">
                                    <div class="col-lg-12 mb20">
                                        <h5>Pick Up Location</h5>
                                        <div class="date-time-field">
                                            <select name="pickUpLocation" id="pick_up">
                                                <option selected disabled value="Select pick_up">
                                                    {{ session()->get('pickUpLocation') }}</option>
                                                <option value="{{ session()->get('pickUpLocation') }}">
                                                    {{ session()->get('pickUpLocation') }}</option>
                                            </select>
                                        </div>

                                        <div class="jls-address-preview jls-address-preview--hidden">
                                            <div class="jls-address-preview__header">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 mb20">
                                        <h5>Drop Off Location</h5>
                                        <div class="date-time-field">
                                            <select name="dropOffLocation" id="Drop_Off">
                                                <option selected disabled value="Select drop_off">
                                                    {{ session()->get('dropOffLocation') }}</option>
                                                <option value="{{ session()->get('dropOffLocation') }}">
                                                    {{ session()->get('dropOffLocation') }}</option>
                                            </select>
                                        </div>

                                        <div class="jls-address-preview jls-address-preview--hidden">
                                            <div class="jls-address-preview__header">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 mb20">
                                        <h5>Pick Up Date & Time</h5>
                                        <div class="date-time-field">
                                            <input type="text" id="date-picker" name="pickUpDate"
                                                value="{{ session()->get('pickUpDate') }}">
                                            <select name="pickUpTime" id="pickup-time">
                                                <option selected disabled value="{{ session()->get('pickUpTime') }}">
                                                    {{ session()->get('pickUpTime') }}</option>
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
                                    </div>

                                    <div class="col-lg-12 mb20">
                                        <h5>Return Date & Time</h5>
                                        <div class="date-time-field">

                                            <input type="text" id="date-picker-2" name="collectionDate"
                                                value="{{ session()->get('collectionDate') }}">
                                            <select name="collectionTime" id="collection-time">
                                                <option selected disabled value="{{ session()->get('collectionTime') }}">
                                                    {{ session()->get('collectionTime') }}</option>
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
                                    </div>

                                    <div class="col-lg-12 mb20">
                                        <h5>Select Days</h5>
                                        <div class="date-time-field">
                                            <select name="pickUpLocation" id="pick_up" onchange="showOptions()">
                                                <option selected disabled value="">Pick up Days</option>
                                                <option value="day">Day</option>
                                                <option value="week">Week</option>
                                                <option value="month">Month</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3 col-sm-3 search-col-padding">
                                            <label>Days</label><br>
                                            <div class="d-flex gap-4"><button id="minus">-</button>
                                                <input id="counter001" name="adult_count" value="1"
                                                    class="form-control quantity-padding"><button id="plus">+</button>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-3 search-col-padding">
                                            <label>Week</label><br>
                                            <div class="d-flex gap-4"><button id="minus1">-</button>
                                                <input id="counter002" name="adult_count" value="1"
                                                    class="form-control quantity-padding"><button id="plus1">+</button>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-3 search-col-padding d-flex">
                                            <label>Month</label><br>
                                            <div class="d-flex gap-4"><button id="minus2">-</button>
                                                <input id="counter003" name="adult_count" value="1"
                                                    class="form-control quantity-padding"><button id="plus2">+</button>
                                            </div>
                                        </div>
                                        <div class="form-check form-switch d-flex gap-4">
                                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                            <label class="form-check-label" for="flexSwitchCheckDefault">Additional driver<br>(20.-/ per month)
                                            </label>
                                        </div>
                                        <div class="form-check form-switch d-flex gap-4">
                                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                            <label class="form-check-label" for="flexSwitchCheckDefault">Child booster seat<br>(20.-/month)</label>
                                        </div>
                                        <div class="form-check form-switch d-flex gap-4">
                                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                            <label class="form-check-label" for="flexSwitchCheckDefault">Child seat<br>(30.-/month)</label>
                                        </div>
                                        <div class="form-check form-switch d-flex gap-4">
                                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                            <label class="form-check-label" for="flexSwitchCheckDefault">Exit permit<br>(149.-/month)</label>
                                        </div>
                                        <div class="form-floating">
                                            <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
                                            <label for="floatingTextarea2">Leave a comment here</label>
                                          </div>
                                    </div>

                                </div>



                                <input type='submit' id='send_message' value='Book Now' class="btn-main btn-fullwidth">

                                <div class="clearfix"></div>
                                <div class="de-price text-center mt-2">
                                    Total Price
                                    <h4> <input type="hidden" name="Dprice"
                                            value="{{ $vehicles->Dprice }}">10000<br>
                                    </h4>
                                </div>

                        </form>
                    </div>

                    <div class="de-box">
                        <h4>Share</h4>
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
