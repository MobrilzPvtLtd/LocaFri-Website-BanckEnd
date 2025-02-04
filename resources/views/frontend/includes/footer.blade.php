<footer class="text-light">
    <div class="container">
        <div class="row g-custom-x">
            <div class="col-lg-3">
                <div class="">
                    <h5>{{ __('messages.about') }}</h5>
                    <p>
                        <b>LocaFri : </b>+41 79 387 60 20<br>
                        <b>E-mail :</b> info@locafri.ch
                    <div class="col-lg-6">
                        <div class="widget">
                            <ul>
                                <li><a href="/">{{ __('messages.home') }}</a></li>
                                <li><a href="/cars">{{ __('messages.vehicles') }}</a></li>
                                <li><a href="/keybox">{{ __('messages.key_box') }}</a></li>
                                <li><a href="/contact">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                    </p>
                </div>
            </div>


            <div class="col-lg-3">
                <div class="widget">
                    <h5>{{ __('messages.rules_and_regulations') }}</h5>
                    <address class="s1">
                        <span><a
                                href="{{ route('terms-and-conditions') }}">{{ __('messages.terms_and_conditions') }}</a>
                        </span>
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
                <h5>{{ __('messages.opening_hours') }}</h5>
                <address class="s1">
                    <span><b>{{ __('messages.monday_to_friday') }}:</b><br>08:00 à 12:00 - 13:30 à
                        18:00<br><b>{{ __('messages.saturday') }}:</b><br>08:00 à
                        12:00
                        {{ __('messages.by_appointment') }} <br><b>{{ __('messages.sunday') }}:</b></br>
                        {{ __('messages.by_appointment') }}</span>
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
                    <h5>{{ __('messages.accepted_cards') }}</h5>
                    <div class="social-icons">
                        <img class="cards001" src="images/01.png" alt="w">
                        <img src="images/twint25.png" alt="twint" style="width: 10%;">
                    </div>
                    <h5 class="foot001">{{ __('messages.social_network') }}</h5>
                    <div class="social-icons">
                        <a href="https://www.facebook.com/p/LocaFri-LocaFri-100086161718048/"><i
                                class="fa fa-facebook fa-lg"></i></a>
                        <!-- <a href="#"><i class="fa fa-twitter fa-lg"></i></a> -->
                        <!-- <a href="#"><i class="fa fa-linkedin fa-lg"></i></a> -->
                        <a href="https://www.instagram.com/locafri.ch/"><i class="fa fa-instagram fa-lg"></i></a>
                        <!-- <a href="#"><i class="fa fa-pinterest fa-lg"></i></a>
                  <a href="#"><i class="fa fa-rss fa-lg"></i></a> -->
                    </div>
                    <br /><br />
                    {{-- <div class="language-dropdown-menu" id="language-dropdown-menu">

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
                    </div> --}}
                    <ul class="header-nav">

                        <li>
                            <div class="language-dropdown-menu" id="language-dropdown-menu">

                                {{-- <select class="language-switcher" name="language-switcher" onchange="ChangeLang(this.value);">
                                    @foreach (config('app.available_locales') as $locale_code => $locale_name)
                                        <option value="{{ $locale_code }}"
                                            @if (strtolower(app()->currentLocale()) == $locale_code) selected @endif >
                                             {{ $locale_name }}
                                        </option>
                                    @endforeach
                                </select> --}}
                                <div class="custom-dropdown">
                                    <button class="dropdown-button">
                                        @foreach (config('app.available_locales') as $locale_code => $locale_name)
                                            @if (strtolower(app()->currentLocale()) == $locale_code)
                                                <img src="{{ asset('public/img/globalicon.png') }}" alt="{{ $locale_name }}" style="width: 20px; margin-right: 10px;"/> {{ $locale_name }}
                                                @break
                                            @else
                                            <img src="{{ asset('public/img/globalicon.png') }}" style="width: 20px; margin-right: 10px;"> Select
                                            @endif
                                        @endforeach
                                    </button>
                                    <div class="dropdown-content">
                                        @foreach (config('app.available_locales') as $locale_code => $locale_name)
                                            <a href="#" class="dropdown-item" data-value="{{ $locale_code }}" onclick="ChangeLang('{{ $locale_code }}')">
                                                <img src="{{ asset('public/img/globalicon.png') }}" alt="{{ $locale_name }}" /> {{ $locale_name }}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>

                            </div>
                        </li>

                    </ul>
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
                            <li><a
                                    href="{{ route('terms-and-conditions') }}">{{ __('messages.terms_conditions') }}:</a>
                            </li>
                            <li><a href="{{ route('privacy') }}">{{ __('messages.privacy_policy') }}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<script>
    document.querySelector(".dropdown-button").addEventListener("click", function() {
        document.querySelector(".dropdown-content").classList.toggle("show");
    });

    document.querySelectorAll(".dropdown-item").forEach(item => {
        item.addEventListener("click", function() {
            var selectedText = item.textContent.trim();
            document.querySelector(".dropdown-button").textContent = selectedText;
            document.querySelector(".dropdown-content").style.display = "none"; // Close dropdown after selection
        });
    });

    function ChangeLang(lang) {
        window.location.replace('{{ route('language.switch', '') }}' + '/' + lang);
    }

</script>

