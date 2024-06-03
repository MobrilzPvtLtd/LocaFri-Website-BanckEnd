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
    <footer class="text-light">
        <div class="container">
            <div class="row g-custom-x">
                <div class="col-lg-3">
                    <div class="">
                        <h5>À PROPOS DE LOCAFRI</h5>
                        <p>
                            <b>LocaFri : </b>079 387 60 20<br>
                            <b>E-mail :</b> info@locafri.ch
                        <div class="col-lg-6">
                            <div class="widget">
                                <ul>
                                    <li><a href="index.html">Accueil</a></li>
                                    <li><a href="cars.html">Véhicules</a></li>
                                    <li><a href="key_box.html">Key-Box</a></li>
                                    <li><a href="contact.html">contact</a></li>
                                </ul>
                            </div>
                        </div>
                        </p>
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="widget">
                        <h5>RÈGLEMENTS</h5>
                        <address class="s1">
                            <span>Conditions Générales</span>
                            <!-- <span
                      ><i class="id-color fa fa-phone fa-lg"></i>+1 333 9296</span
                    > -->
                            <!-- <span
                      ><i class="id-color fa fa-envelope-o fa-lg"></i
                      ><a href="mailto:contact@example.com"
                        >contact@example.com</a
                      ></span
                    >
                    <span
                      ><i class="id-color fa fa-file-pdf-o fa-lg"></i
                      ><a href="#">Download Brochure</a></span
                    > -->
                        </address>
                    </div>
                </div>

                <div class="col-lg-3">
                    <h5>HEURES D'OUVERTURE</h5>
                    <address class="s1">
                        <span><b>Lundi à Vendredi :</b><br>08:00 à 12 : 00-13 : 30 à 18:00<br><b>Samedi :</b><br>08:00 à
                            12:00 puis sur RDV <br><b>Dimanche :</b></br> Sur RDV </span>
                        <!-- <span
                    ><i class="id-color fa fa-phone fa-lg"></i>+1 333 9296</span
                  > -->
                        <!-- <span
                    ><i class="id-color fa fa-envelope-o fa-lg"></i
                    ><a href="mailto:contact@example.com"
                      >contact@example.com</a
                    ></span
                  >
                  <span
                    ><i class="id-color fa fa-file-pdf-o fa-lg"></i
                    ><a href="#">Download Brochure</a></span
                  > -->
                    </address>
                </div>

                <div class="col-lg-3">
                    <div class="widget">
                        <h5>CARTES ACCEPTÉES</h5>
                        <div class="social-icons">
                            <img class="cards001" src="images/01.png" alt="">
                        </div>
                        <h5 class="foot001">Social Network</h5>
                        <div class="social-icons">
                            <a href="https://www.facebook.com/p/LocaFri-LocaFri-100086161718048/"><i
                                    class="fa fa-facebook fa-lg"></i></a>
                            <!-- <a href="#"><i class="fa fa-twitter fa-lg"></i></a> -->
                            <!-- <a href="#"><i class="fa fa-linkedin fa-lg"></i></a> -->
                            <a href="https://www.instagram.com/locafri.ch/"><i class="fa fa-instagram fa-lg"></i></a>
                            <!-- <a href="#"><i class="fa fa-pinterest fa-lg"></i></a>
                    <a href="#"><i class="fa fa-rss fa-lg"></i></a> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="subfooter">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="de-flex">
                            <div class="de-flex-col">
                                <a href="https://mobrilz.com/">
                                    Copyright 2024 - Mobrilz
                                </a>
                            </div>
                            <ul class="menu-simple">
                                <li><a href="#">Terms &amp; Conditions</a></li>
                                <li><a href="#">Privacy Policy</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer close -->

</div>
@endsection