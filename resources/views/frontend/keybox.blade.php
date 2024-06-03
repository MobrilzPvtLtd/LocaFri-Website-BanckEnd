@extends('frontend.layouts.loca')

@section('title')
{{ app_name() }} - Keybox
@endsection

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
                        <h1>Key Box</h1>
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
                    <h2 class="k_text001">La Smart Keybox est une boîte intelligente qui stocke la clé de voiture pour
                        les retrouver facilement. <span class="id-color"> Le locataire peut prendre et rendre le
                            véhicule en l’absence d’une personne physique. </span>Locafri vous enverra un message
                        (Whatsapp ou e-mail) avec le code pour ouvrir la box.<span class="id-color"> Simple et facile
                            d’utilisation, </span>c’est un gain de temps pour les deux parties.</h2>
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