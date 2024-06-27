@extends('frontend.layouts.loca')

@section('title')
    {{ app_name() }} - Rent a car
@endsection

@section('content')
    <div class="no-bottom no-top" id="content">
        <div id="top"></div>
        <section id="section-hero" aria-label="section" class="jarallax">
            <img src="images/background/1.jpg" class="jarallax-img" alt="" />
            <div class="container">
                <div class="f001">
                    <div class=" text-light">
                        <div class="spacer-double "></div>
                        <div class="spacer-double"></div>
                        <h1 class="mb-2">
                            Looking for a <span class="id-color">vehicle</span>? You're at
                            the right place.
                        </h1>
                        <div class="spacer-single"></div>
                    </div>

                    <div class="col-lg-6">
                        <div class="spacer-single sm-hide"></div>
                        <div class="p-4 rounded-3 shadow-soft" data-bgcolor="#ffffff">


                            <form name="contactForm" id='contact_form' method="post">


                                <div class="spacer-20"></div>

                                <div class="row">
                                    <div class="col-lg-6 mb20">
                                        <h5>Pick Up Location</h5>
                                        <div class="date-time-field">
                                            <select name="Pick Up Time" id="pick_up">
                                                <option selected disabled value="Select pick_up">select your pickup location
                                                </option>
                                                <option value="Romont_Gare">Romont Gare</option>
                                            </select>
                                        </div>

                                        <div class="jls-address-preview jls-address-preview--hidden">
                                            <div class="jls-address-preview__header">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 mb20">
                                        <h5>Drop Off Location</h5>
                                        <div class="date-time-field">
                                            <select name="Drop Off Location" id="Drop_Off">
                                                <option selected disabled value="Select drop_off">select your drop Off
                                                    location</option>
                                                <option value="Romont_Gare">Romont Gare</option>
                                            </select>
                                        </div>

                                        <div class="jls-address-preview jls-address-preview--hidden">
                                            <div class="jls-address-preview__header">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 mb20">
                                        <h5>Pick Up Date & Time</h5>
                                        <div class="date-time-field">
                                            <input type="text" id="date-picker" name="Pick Up Date" value="">
                                            <select name="Pick Up Time" id="pickup-time">
                                                <option selected disabled value="Select time">Time</option>
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

                                    <div class="col-lg-6 mb20">
                                        <h5>Return Date & Time</h5>
                                        <div class="date-time-field">
                                            <input type="text" id="date-picker-2" name="Collection Date"
                                                value="">
                                            <select name="Collection Time" id="collection-time">
                                                <option selected disabled value="Select time">Time</option>
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
                                </div>

                                <input type='submit' id='send_message' value='Find a Vehicle'
                                    class="btn-main pull-right">

                                <div class="clearfix"></div>

                            </form>
                        </div>
                    </div>

                    <div class="spacer-double"></div>


                </div>
            </div>
        </section>

        <section aria-label="section" class="pt40 pb40 text-light" data-bgcolor="#111111">
            <div class="wow fadeInRight d-flex">
                <div class="de-marquee-list">
                    <div class="d-item">
                        <span class="d-item-txt">Citadine</span>
                        <span class="d-item-display">
                            <i class="d-item-dot"></i>
                        </span>
                        <span class="d-item-txt">Monospace</span>
                        <span class="d-item-display">
                            <i class="d-item-dot"></i>
                        </span>
                        <span class="d-item-txt">Fourgon</span>
                        <span class="d-item-display">
                            <i class="d-item-dot"></i>
                        </span>
                        <span class="d-item-txt">Mini-bus</span>
                        <span class="d-item-display">
                            <i class="d-item-dot"></i>
                        </span>
                        <span class="d-item-txt">Remorque</span>
                        <span class="d-item-display">
                            <i class="d-item-dot"></i>
                        </span>

                    </div>
                </div>

                <div class="de-marquee-list">
                    <div class="d-item">
                        <span class="d-item-txt">Citadine</span>
                        <span class="d-item-display">
                            <i class="d-item-dot"></i>
                        </span>
                        <span class="d-item-txt">Monospace</span>
                        <span class="d-item-display">
                            <i class="d-item-dot"></i>
                        </span>
                        <span class="d-item-txt">Fourgon</span>
                        <span class="d-item-display">
                            <i class="d-item-dot"></i>
                        </span>
                        <span class="d-item-txt">Mini-bus</span>
                        <span class="d-item-display">
                            <i class="d-item-dot"></i>
                        </span>
                        <span class="d-item-txt">Remorque</span>
                        <span class="d-item-display">
                            <i class="d-item-dot"></i>
                        </span>

                    </div>
                </div>
            </div>
        </section>

        <section aria-label="section">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 offset-lg-3 text-center">
                        <h2>Our Features</h2>
                        <!-- <p>
                              Dolor esse sint officia est voluptate et qui deserunt et est
                              eiusmod cillum mollit sunt nulla cillum sit ut culpa ullamco.
                            </p> -->
                        <div class="spacer-20"></div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-lg-3">
                        <div class="box-icon s2 p-small mb20 wow fadeInRight" data-wow-delay=".5s">
                            <!-- <i class="fa bg-color fa-trophy"></i>
                              <div class="d-inner">
                                <h4>First class services</h4>
                                Est dolore ut laboris eu enim eu veniam nostrud esse laborum
                                duis consequat nostrud id
                              </div> -->
                        </div>
                        <div class="box-icon s2 p-small mb20 wow fadeInL fadeInRight" data-wow-delay=".75s">
                            <i class="fa bg-color fa-road"></i>
                            <div class="d-inner">
                                <h4>24/7 road assistance</h4>
                                <!-- Est dolore ut laboris eu enim eu veniam nostrud esse laborum
                                duis consequat nostrud id -->
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <img src="images/misc/car.png" alt="" class="img-fluid wow fadeInUp" />
                    </div>

                    <div class="col-lg-3">
                        <div class="box-icon s2 d-invert p-small mb20 wow fadeInL fadeInLeft" data-wow-delay="1s">
                            <!-- <i class="fa bg-color fa-tag"></i>
                              <div class="d-inner">
                                <h4>Quality at Minimum Expense</h4>
                                Est dolore ut laboris eu enim eu veniam nostrud esse laborum
                                duis consequat nostrud id
                              </div> -->
                        </div>
                        <div class="box-icon s2 d-invert p-small mb20 wow fadeInL fadeInLeft" data-wow-delay="1.25s">
                            <i class="fa bg-color fa-map-pin"></i>
                            <div class="d-inner">
                                <h4>Free Pick-Up & Drop-Off</h4>
                                <!-- Est dolore ut laboris eu enim eu veniam nostrud esse laborum
                                duis consequat nostrud id -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>




        <section class="text-light jarallax" aria-label="section">
            <img src="images/background/3.jpg" alt="" class="jarallax-img" />
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <h1>Let's Your Adventure Begin</h1>
                        <div class="spacer-20"></div>
                    </div>
                    <div class="col-md-3">
                        <i class="fa fa-trophy de-icon mb20"></i>
                        <h4>First Class Services</h4>
                        <!-- <p>
                              Aliquip consequat excepteur non dolor irure ad irure labore ex
                              eiusmod est duis culpa ex ut minim ut ea.
                            </p> -->
                    </div>
                    <div class="col-md-3">
                        <i class="fa fa-road de-icon mb20"></i>
                        <h4>24/7 road assistance</h4>
                        <!-- <p>
                              Aliquip consequat excepteur non dolor irure ad irure labore ex
                              eiusmod est duis culpa ex ut minim ut ea.
                            </p> -->
                    </div>
                    <div class="col-md-3">
                        <i class="fa fa-map-pin de-icon mb20"></i>
                        <h4>Free Pick-Up & Drop-Off</h4>
                        <!-- <p>
                              Aliquip consequat excepteur non dolor irure ad irure labore ex
                              eiusmod est duis culpa ex ut minim ut ea.
                            </p> -->
                    </div>
                </div>
            </div>
        </section>

        <section id="section-cars">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 offset-lg-3 text-center">
                        <h2>Our Vehicle Fleet</h2>
                        <div class="spacer-20"></div>
                    </div>

                    <div id="items-carousel" class="owl-carousel wow fadeIn">
                        @foreach ($vehicles as $vehicle)
                            <div class="col-lg-12">
                                <div class="de-item mb30">
                                    <div class="d-img">
                                        @php
                                            $images = unserialize($vehicle->image);
                                        @endphp
                                        @if (!empty($images) && is_array($images) && count($images) > 0)
                                            <img src="{{ asset('public/' . $images[0]) }}" alt="Image"
                                                class="img-fluid w-100">
                                        @else
                                            <p>No images available</p>
                                        @endif
                                    </div>
                                    <div class="d-info">
                                        <div class="d-text">
                                            <h4>{{ $vehicle->name }}</h4>
                                            <div class="d-item_like">
                                                <i class="fa fa-heart"></i><span>74</span>
                                            </div>
                                            <div class="d-atr-group">
                                                <span class="d-atr"><img src="images/icons/1.svg"
                                                        alt="" />{{ $vehicle->seat }}</span>
                                                <span class="d-atr"><img src="images/icons/2.svg"
                                                        alt="" />{{ $vehicle->fuel }}</span>
                                                <span class="d-atr"><img src="images/icons/3.svg"
                                                        alt="" />{{ $vehicle->door }}</span>
                                                <span class="d-atr"><img src="images/icons/4.svg"
                                                        alt="" />{{ $vehicle->trans }}</span>
                                            </div>
                                            <div class="d-price">
                                                Prix <span>35.- / 1 jour</span>
                                                <a class="btn-main" href="{{ route('carsdetails', $vehicle->slug) }}">Rent Now</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- <div class="col-lg-12">
                                <div class="de-item mb30">
                                    <div class="d-img">
                                        <img src="images/cars/2-removebg-preview.png" class="img-fluid" alt="" />
                                    </div>
                                    <div class="d-info">
                                        <div class="d-text">
                                            <h4>Car name</h4>
                                            <div class="d-item_like">
                                                <i class="fa fa-heart"></i><span>36</span>
                                            </div>
                                            <div class="d-atr-group">
                                                <span class="d-atr"><img src="images/icons/1.svg" alt="" />7</span>
                                                <span class="d-atr"><img src="images/icons/2.svg" alt="" />Diesel</span>
                                                <span class="d-atr"><img src="images/icons/3.svg" alt="" />5</span>
                                                <span class="d-atr"><img src="images/icons/4.svg" alt="" />Manuel </span>
                                            </div>
                                            <div class="d-price">
                                                Prix <span>45.- / 1 jour</span>
                                                <a class="btn-main" href="car-single.html">Rent Now</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}

                            {{-- <div class="col-lg-12">
                                <div class="de-item mb30">
                                    <div class="d-img">
                                        <img src="images/cars/3-removebg-preview.png" class="img-fluid" alt="" />
                                    </div>
                                    <div class="d-info">
                                        <div class="d-text">
                                            <h4>Car name</h4>
                                            <div class="d-item_like">
                                                <i class="fa fa-heart"></i><span>85</span>
                                            </div>
                                            <div class="d-atr-group">
                                                <span class="d-atr"><img src="images/icons/1.svg" alt="" />5</span>
                                                <span class="d-atr"><img src="images/icons/2.svg" alt="" />Essence</span>
                                                <span class="d-atr"><img src="images/icons/3.svg" alt="" />5</span>
                                                <span class="d-atr"><img src="images/icons/4.svg" alt="" />Automatique
                                                    Car</span>
                                            </div>
                                            <div class="d-price">
                                                Prix <span>45.- / 1 jour</span>
                                                <a class="btn-main" href="car-single.html">Rent Now</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}

                            {{-- <div class="col-lg-12">
                                <div class="de-item mb30">
                                    <div class="d-img">
                                        <img src="images/cars/4-removebg-preview.png" class="img-fluid" alt="" />
                                    </div>
                                    <div class="d-info">
                                        <div class="d-text">
                                            <h4>Car name</h4>
                                            <div class="d-item_like">
                                                <i class="fa fa-heart"></i><span>59</span>
                                            </div>
                                            <div class="d-atr-group">
                                                <span class="d-atr"><img src="images/icons/1.svg" alt="" />5</span>
                                                <span class="d-atr"><img src="images/icons/2.svg" alt="" />Essence </span>
                                                <span class="d-atr"><img src="images/icons/3.svg" alt="" />5</span>
                                                <span class="d-atr"><img src="images/icons/4.svg" alt="" />Automatique</span>
                                            </div>
                                            <div class="d-price">
                                                Prix <span>45.- / 1 jour</span>
                                                <a class="btn-main" href="car-single.html">Rent Now</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}

                            {{-- <div class="col-lg-12">
                                <div class="de-item mb30">
                                    <div class="d-img">
                                        <img src="images/cars/5-removebg-preview.png" class="img-fluid" alt="" />
                                    </div>
                                    <div class="d-info">
                                        <div class="d-text">
                                            <h4>Car name</h4>
                                            <div class="d-item_like">
                                                <i class="fa fa-heart"></i><span>19</span>
                                            </div>
                                            <div class="d-atr-group">
                                                <span class="d-atr"><img src="images/icons/1.svg" alt="" />5</span>
                                                <span class="d-atr"><img src="images/icons/2.svg" alt="" />Essence</span>
                                                <span class="d-atr"><img src="images/icons/3.svg" alt="" />5</span>
                                                <span class="d-atr"><img src="images/icons/4.svg" alt="" />Automatique</span>
                                            </div>
                                            <div class="d-price">
                                                Prix <span>45.- / 1 jour</span>
                                                <a class="btn-main" href="car-single.html">Rent Now</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}

                            {{-- <div class="col-lg-12">
                                <div class="de-item mb30">
                                    <div class="d-img">
                                        <img src="images/cars/6-removebg-preview.png" class="img-fluid" alt="" />
                                    </div>
                                    <div class="d-info">
                                        <div class="d-text">
                                            <h4>Car name</h4>
                                            <div class="d-item_like">
                                                <i class="fa fa-heart"></i><span>79</span>
                                            </div>
                                            <div class="d-atr-group">
                                                <span class="d-atr"><img src="images/icons/1.svg" alt="" />5</span>
                                                <span class="d-atr"><img src="images/icons/2.svg" alt="" />Essence </span>
                                                <span class="d-atr"><img src="images/icons/3.svg" alt="" />5</span>
                                                <span class="d-atr"><img src="images/icons/4.svg" alt="" />Manuel </span>
                                            </div>
                                            <div class="d-price">
                                                Prix <span>35.- / 1 jour</span>
                                                <a class="btn-main" href="car-single.html">Rent Now</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                            {{-- <div class="col-lg-12">
                                <div class="de-item mb30">
                                    <div class="d-img">
                                        <img src="images/cars/7-removebg-preview.png" class="img-fluid" alt="" />
                                    </div>
                                    <div class="d-info">
                                        <div class="d-text">
                                            <h4>Car name</h4>
                                            <div class="d-item_like">
                                                <i class="fa fa-heart"></i><span>59</span>
                                            </div>
                                            <div class="d-atr-group">
                                                <span class="d-atr"><img src="images/icons/1.svg" alt="" />5</span>
                                                <span class="d-atr"><img src="images/icons/2.svg" alt="" />Essence </span>
                                                <span class="d-atr"><img src="images/icons/3.svg" alt="" />5</span>
                                                <span class="d-atr"><img src="images/icons/4.svg" alt="" />Manuel </span>
                                            </div>
                                            <div class="d-price">
                                                Prix <span>40.- / 1 jour</span>
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
        </section>


        <section id="section-call-to-action" class="bg-color-2 pt60 pb60 text-light">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 offset-lg-1">
                        <h2 class="s2">
                            Call us for further information. Rentaly customer care is here
                            to help you anytime.
                        </h2>
                    </div>

                    <div class="col-lg-5 text-lg-center text-sm-center">
                        <div class="phone-num-big">
                            <i class="fa fa-phone"></i>
                            <span class="pnb-text"> Call Us Now </span>
                            <span class="pnb-num"> +41 79 387 60 20</span>
                        </div>
                        <a href="/contact" class="btn-main">Contact Us</a>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
