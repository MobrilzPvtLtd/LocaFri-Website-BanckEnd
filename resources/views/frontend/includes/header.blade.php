<header class="transparent scroll-light has-topbar">
    <div id="topbar" class="topbar-dark text-light">
        <div class="container">
            <div class="topbar-left xs-hide">
                <div class="topbar-widget">
                    <div class="topbar-widget">
                        <a href="#"><i class="fa fa-phone"></i>+41 79 387 60 20</a>
                    </div>
                    <div class="topbar-widget">
                        <a href="#"><i class="fa fa-envelope"></i>info@locafri.ch</a>
                    </div>
                    <div class="topbar-widget">
                        <a href="#"><i class="fa fa-clock-o"></i>Lundi à Vendredi : 08:00 - 12:00 / 13:30 - 18:00
                            Samedi 08:00 -
                            12:00 Dimanche Sur RDV</a>
                    </div>
                </div>
            </div>

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
                                    <img class="logo-1" src="images/Final-1 (2).png" alt="" />
                                    <img class="logo-2" src="images/Final-2 (1).png" alt="" />
                                </a>
                            </div>
                            <!-- logo close -->
                        </div>
                    </div>
                    <div class="de-flex-col header-col-mid">
                        <ul id="mainmenu">
                            <li>
                                <a class="menu-item" href="/">Accueil</a>

                            </li>
                            <li>
                                <a class="menu-item" href="/cars">Véhicules</a>

                            </li>
                            <li>
                                <a class="menu-item" href="/keybox">Key-Box</a>
                            </li>
                            <li>
                                <a class="menu-item" href="/contact">Contact</a>

                            </li>

                        </ul>
                    </div>
                    <div class="de-flex-col">
                        @guest
                            <div class="menu_side_area">
                                <a href="{{ route('login') }}" class="btn-main">Sign In</a>
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

                        @auth
                            <div class="de-flex-col header-col-mid">
                                <ul id="mainmenu">
                                    <li>
                                        <a class="menu-item" href="#"><i class="fa fa-user"
                                                aria-hidden="true"></i>&nbsp;&nbsp;User {{ Auth::user()->last_name }}</a>
                                        <ul>
                                            @can('view_backend')
                                                <li>
                                                    <a class="menu-item" href="">Admin</a>
                                                </li>
                                            @endcan
                                            <li>
                                                <a class="menu-item"
                                                    href="{{ route('frontend.users.profile') }}">Profile</a>
                                            </li>
                                            <li>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                    style="display: inline;">
                                                    {{ csrf_field() }}
                                                    <button class="menu-item btn btn-text" type="submit"
                                                        style="border: none; background: none; padding: 0;">Logout</button>
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
