<header class="transparent scroll-light has-topbar">
    <div id="topbar" class="topbar-dark text-light">
        <div class="container">
            {{-- <div class="topbar-left xs-hide">
                <div class="topbar-widget">
                    <div class="topbar-widget">
                        <a href="#"><i class="fa fa-phone"></i>+41 79 387 60 20</a>
                    </div>
                    <div class="topbar-widget">
                        <a href="#"><i class="fa fa-envelope"></i>info@locafri.ch</a>
                    </div>
                    <div class="topbar-widget">
                        <a href="#"><i class="fa fa-clock-o"></i>{{ __('messages.working_hours') }}
                        </a>
                    </div>
                </div>
            </div> --}}
            <div class="topbar-right">
                <div class="social-icons">
                    {{-- <a href="https://www.facebook.com/p/LocaFri-LocaFri-100086161718048/"><i
                            class="fa fa-facebook fa-lg"></i></a> --}}
                    <!-- <a href="#"><i class="fa fa-twitter fa-lg"></i></a>
                <a href="#"><i class="fa fa-youtube fa-lg"></i></a>
                <a href="#"><i class="fa fa-pinterest fa-lg"></i></a> -->
                    {{-- <a href="https://www.instagram.com/locafri.ch/"><i class="fa fa-instagram fa-lg"></i></a> --}}
                    <!-- <a href="#"><i class="fa fa-linkedin fa-lg"></i></a> -->
                </div>
            </div>


            <div class="clearfix"></div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="de-flex sm-pt10">
                    <div class="de-flex-col">
                        <div class="de-flex-col">
                            <!-- logo begin -->
                            <div id="logo">
                                <a href="/">
                                    <img class="logo-1" src="{{ asset('images/locafri.png') }}" alt="" />
                                    <img class="logo-2" src="{{ asset('images/locafri-admin.png') }}" alt="" />
                                </a>
                            </div>
                            <!-- logo close -->
                        </div>
                    </div>
                    <div class="de-flex-col header-col-mid">
                        <ul id="mainmenu">
                            <li>
                                <a class="menu-item" href="/">{{ __('messages.home') }}
                                </a>

                            </li>
                            <li>
                                <a class="menu-item" href="{{ route('cars') }}">{{ __('messages.vehicles') }}</a>

                            </li>
                            <li>
                                <a class="menu-item" href="/keybox">{{ __('messages.key_box') }}</a>
                            </li>
                            <li>
                                <a class="menu-item" href="{{ route('contact') }}">Contact</a>

                            </li>

                        </ul>
                    </div>
                    <div class="de-flex-col">
                        @guest
                            <div class="menu_side_area">
                                <a href="{{ route('login') }}" class="btn-main">{{ __('messages.sign_in') }}
                                </a>
                                <span id="menu-btn"></span>
                            </div>
                        @endguest
                        {{-- @auth
                        <li>
                            <a class="user_icon" href="{{ route('login') }}">

                            </a>
                            <div class="dropdown">
                                <button class="dropdown-btn"> <i class="fa fa-user" aria-hidden="true"></i> Hello
                                    {{ Auth::user()->last_name }} </button>
                                <div class="dropdown-content">
                                    @can('view_backend') <a>Admin</a>@endif
                                    <a href="{{ route('frontend.users.profile') }}"> Profile</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                        {{ csrf_field() }}
                                        <button class="btn btn-text" type="submit">Logout</button>
                                    </form>
                                </div>
                            </div>

                        </li>
                    @endauth --}}
                        {{--
                        <div class="de-flex-col header-col-mid">
                            <ul id="mainmenu">
                                <li>
                                    <a class="menu-item" href="#"> <i class="fa fa-user" aria-hidden="true"></i>
                                        &nbsp;&nbsp;User</a>
                                    <ul>
                                        <li>
                                            <a class="menu-item" href="#">Profile</a>
                                        </li>
                                        <li>
                                            <a class="menu-item" href="#">Setting</a>
                                        </li>
                                        <li>
                                            <a class="menu-item" href="#">Logout</a>
                                        </li>
                                    </ul>
                                </li>
                                </li>
                        </div> --}}
                        <div class="topbar-right">
                            <div class="social-icons">
                                <a href="https://www.facebook.com/p/LocaFri-LocaFri-100086161718048/"><i
                                        class="fa fa-facebook fa-lg"></i></a>
                                <!-- <a href="#"><i class="fa fa-twitter fa-lg"></i></a>
                            <a href="#"><i class="fa fa-youtube fa-lg"></i></a>
                            <a href="#"><i class="fa fa-pinterest fa-lg"></i></a> -->
                                <a href="https://www.instagram.com/locafri.ch/"><i class="fa fa-instagram fa-lg"></i></a>
                                <!-- <a href="#"><i class="fa fa-linkedin fa-lg"></i></a> -->
                            </div>
                        </div>
                        @auth
                            <div class="de-flex-col header-col-mid">
                                <ul id="mainmenu">
                                    <li>
                                        <a class="menu-item" href="#"><i class="fa fa-user"
                                                aria-hidden="true"></i>&nbsp;&nbsp;{{ Auth::user()->first_name }}{{ Auth::user()->last_name }}</a>
                                        <ul>
                                            @can('view_backend')
                                                <li>
                                                    <a class="menu-item" href="{{ route('backend.dashboard') }}">Admin</a>
                                                </li>
                                            @endcan
                                            <li>
                                                <a class="menu-item"
                                                    href="{{ route('frontend.users.profile') }}">{{ __('messages.profile') }}</a>
                                            </li>
                                            <li>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                    style="display: inline;">
                                                    {{ csrf_field() }}
                                                    <button class="menu-item" type="submit" style="border: none;background: none;padding: 15px;"> {{ __('messages.logout') }}</button>
                                                </form>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
