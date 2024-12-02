@extends('frontend.layouts.loca')

@section('title')
{{ app_name() }} - Keybox
@endsection

<a href="https://wa.me/15551234567" target="_blank" style="position: fixed; bottom: 20px; right: 20px; z-index: 1000;">
    <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" alt="Chat with us on WhatsApp" style="width: 60px; height: 60px; border-radius: 50%; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);">
</a>


@section('content')
<div class="no-bottom no-top" id="content">
    <div id="top"></div>

    <!-- section begin -->
    <section id="subheader" class="jarallax text-light">
        <img src="images/background/subheader.jpg" class="jarallax-img" alt="">
        <div class="center-y relative text-center">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h1>{!! __('messages.key_box') !!}</h1>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </section>
    <!-- section close -->


    <section>
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInRight">
                    <h2 class="k_text001">{!! __('messages.smart_keybox') !!} <span class="id-color">{!! __('messages.rent_return_vehicle') !!}</span>
                        {!! __('messages.locafri_message') !!}<span class="id-color"> {!! __('messages.simple_easy') !!}</span> {!! __('messages.time_saver') !!}</h2>
                </div>
                <div class="col-lg-6 wow fadeInRight" data-wow-delay=".25s">
                    <img src="images/misc/5e40015a-1d75-46ef-b20d-acb5894177cc.jpg" alt=""
                        class="img-fluid wow fadeInUp" />
                </div>
            </div>
            <div class="spacer-double"></div>
            <!-- <div class="row text-center">
                        <div class="col-md-3 col-sm-6 mb-sm-30">
                            <div class="de_count wow fadeInUp" data-bgcolor="#f5f5f5">
                                <h3 class="timer" data-to="15425" data-speed="3000">0</h3>
                                Hours of Work
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 mb-sm-30">
                            <div class="de_count wow fadeInUp" data-bgcolor="#f5f5f5">
                                <h3 class="timer" data-to="8745" data-speed="3000">0</h3>
                                Clients Supported
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 mb-sm-30">
                            <div class="de_count wow fadeInUp" data-bgcolor="#f5f5f5">
                                <h3 class="timer" data-to="235" data-speed="3000">0</h3>
                                Awards Winning
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 mb-sm-30">
                            <div class="de_count wow fadeInUp" data-bgcolor="#f5f5f5">
                                <h3 class="timer" data-to="15" data-speed="3000">0</h3>
                                Years Experience
                            </div>
                        </div>
                    </div> -->
        </div>
    </section>
    <!-- content close -->

    <a href="#" id="back-to-top"></a>

    <!-- footer begin -->

    <!-- footer close -->

</div>
@endsection
