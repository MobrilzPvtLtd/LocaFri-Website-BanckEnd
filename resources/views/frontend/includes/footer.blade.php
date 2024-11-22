<footer class="text-light">
    <div class="container">
        <div class="row g-custom-x">
            <div class="col-lg-3">
                <div class="">
                    <h5>À PROPOS DE LOCAFRI</h5>
                    <p>
                        <b>LocaFri : </b>+41 79 387 60 20<br>
                        <b>E-mail :</b> info@locafri.ch
                    <div class="col-lg-6">
                        <div class="widget">
                            <ul>
                                <li><a href="/">Accueil</a></li>
                                <li><a href="/cars">Véhicules</a></li>
                                <li><a href="/keybox">Key-Box</a></li>
                                <li><a href="/contact">contact</a></li>
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
                        <span><a href="#">Conditions Générales</a> </span>
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
                    <span><b>Lundi à Vendredi :</b><br>08:00 à 12:00 - 13:30 à 18:00<br><b>Samedi :</b><br>08:00 à
                        12:00
                        puis sur RDV <br><b>Dimanche :</b></br> Sur RDV </span>
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
                    <br/><br/>
                    <div class="language-dropdown-menu" id="language-dropdown-menu">

                        <select class="language-switcher" name="language-switcher" onchange="ChangeLang(this.value);">
                            @foreach (config('app.available_locales') as $locale_code => $locale_name)
                                <option value="{{$locale_code}}" @if (strtolower(app()->currentLocale()) == $locale_code)
                                selected @endif>{{ $locale_name }}</option>
                            @endforeach
                        </select>
                        <script>
                            function ChangeLang(lang) {

                                window.location.replace('{{ route('language.switch', '') }}'+'/'+lang);

                            }
                        </script>
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
                                Copyright <?php echo date('Y'); ?> - Mobrilz
                            </a>
                        </div>
                        <ul class="menu-simple">
                            <li><a href="#">Terms & Conditions</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
