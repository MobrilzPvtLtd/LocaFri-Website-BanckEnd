@extends('frontend.layouts.loca')

@section('title')
    {{ app_name() }} - Cars
@endsection

<a href="https://wa.me/41793876020" target="_blank" style="position: fixed; bottom: 20px; right: 20px; z-index: 1000;">
    <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" alt="Chat with us on WhatsApp" style="width: 60px; height: 60px; border-radius: 50%; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);">
</a>


@section('content')
    <style>
        .form-border input[type=email],
        input[type=number] {
            padding: 8px;
            margin-bottom: 10px;
            border: none;
            border: solid 2px #eeeeee;
            background: rgba(0, 0, 0, .025);
            border-radius: 6px;
            -moz-border-radius: 6px;
            -webkit-border-radius: 6px;
            height: auto;
            box-shadow: none;
            -moz-box-shadow: none;
            -webkit-box-shadow: none;
            color: #333;
        }
    </style>
    <div class="no-bottom no-top" id="content">
        <div id="top"></div>

        <!-- section begin -->
        <section id="subheader" class="jarallax text-light">
            <img src="images/background/subheader.jpg" class="jarallax-img" alt="">
            <div class="center-y relative text-center">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h1>{!! __('messages.contact_us') !!}</h1>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </section>
        <!-- section close -->


        <section aria-label="section">
            <div class="container">
                <div class="row g-custom-x">

                    <div class="col-lg-8 mb-sm-30">

                        <h3>{!! __('messages.question') !!}</h3>

                        <form name="contactForm" id="contact_form" class="form-border" method="post"
                            action="{{ route('contact.submit') }}">
                            @csrf
                            <div class="row">
                                @include('flash::alert-message')
                                <div class="col-md-4 mb10">
                                    <div class="field-set">
                                        <input type="text" name="name" id="name" class="form-control"
                                            placeholder="{!! __('messages.your_name') !!}" required>
                                    </div>
                                </div>
                                <div class="col-md-4 mb10">
                                    <div class="field-set">
                                        <input type="email" name="email" id="email" class="form-control"
                                            placeholder="{!! __('messages.your_email') !!}" required>
                                    </div>
                                </div>
                                {{-- <div class="col-md-4 mb10">
                                    <div class="field-set">
                                        <input type="number" name="phone" id="phone" class="form-control"
                                            placeholder="Your Phone" required>
                                    </div>
                                </div> --}}
                            </div>

                            <div class="field-set mb20">
                                <textarea name="message" id="message" class="form-control" placeholder="{!! __('messages.your_message') !!}" required></textarea>
                            </div>
                            <div class="g-recaptcha" data-sitekey="copy-your-site-key-here"></div>
                            <div id='submit' class="mt20">
                                <input type='submit' id='send_message' value='{!! __('messages.send_message') !!}' class="btn-main">
                            </div>

                            <div id="success_message" class='success'>
                                {{ __('messages.message_sent_success') }}
                            </div>
                            <div id="error_message" class='error'>
                                {{ __('messages.message_sent_error') }}
                            </div>
                        </form>
                    </div>

                    <div class="col-lg-4">

                        <div class="de-box mb30">
                            <h4>{!! __('messages.office') !!}</h4>
                            <address class="s1">
                                <span><i class="id-color fa fa-map-marker fa-lg"></i>Romont Gare</span>
                                <span><i class="id-color fa fa-phone fa-lg"></i>+41 79 387 60 20</span>
                                <span><i class="id-color fa fa-envelope-o fa-lg"></i><a
                                        href="mailto:contact@example.com">info@locafri.ch</a></span>
                                {{-- <span><i class="id-color fa fa-file-pdf-o fa-lg"></i><a href="#">Download
                                        Brochure</a></span> --}}
                            </address>
                        </div>


                        <!-- <div class="de-box mb30">
                        <h4>AU Office</h4>
                        <address class="s1">
                         <span><i class="fa fa-map-marker fa-lg"></i>100 Mainstreet Center, Sydney</span>
                         <span><i class="fa fa-phone fa-lg"></i>+61 333 9296</span>
                         <span><i class="fa fa-envelope-o fa-lg"></i><a href="mailto:contact@example.com">contact@example.com</a></span>
                         <span><i class="fa fa-file-pdf-o fa-lg"></i><a href="#">Download Brochure</a></span>
                        </address>
                       </div> -->

                    </div>

                </div>
            </div>

        </section>

    </div>
@endsection
