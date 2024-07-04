<?php
$notifications = optional(auth()->user())->unreadNotifications;
$notifications_count = optional($notifications)->count();
$notifications_latest = optional($notifications)->take(5);
?>

<div class="sidebar sidebar-dark sidebar-fixed border-end" id="sidebar">
    <div class="sidebar-header border-bottom">
        <div class="sidebar-brand d-sm-flex justify-content-center">
            <img class="sidebar-brand-full" src="{{ asset('img/logo-with-text.jpg') }}" alt="{{ app_name() }}"
                height="46">
            <img class="sidebar-brand-narrow" src="{{ asset('img/logo-square.jpg') }}" alt="{{ app_name() }}"
                height="46">
        </div>
        <button class="btn-close d-lg-none" data-coreui-dismiss="offcanvas" data-coreui-theme="dark" type="button"
            aria-label="Close"
            onclick="coreui.Sidebar.getInstance(document.querySelector(&quot;#sidebar&quot;)).toggle()"></button>
    </div>
    <ul class="sidebar-nav" data-coreui="navigation" data-simplebar>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('backend.dashboard') }}">
                <i class="nav-icon fa-solid fa-cubes"></i>&nbsp;@lang('Dashboard')
            </a>
        </li>
        @can('enquirys')
            <li class="nav-group" aria-expanded="true">
                <a class="nav-link nav-group-toggle" href="#">
                    <i class="nav-icon fa-solid fa-list-ul"></i>&nbsp;@lang('enquirys')
                </a>
                <ul class="nav-group-items compact" style="height: auto;">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('contact.index') }}">
                            <span class="nav-icon"><span class="nav-icon-bullet"></span></span> Contact enquiry
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('enquiry.index') }}">
                            <span class="nav-icon"><span class="nav-icon-bullet"></span></span>Booking enquiry
                        </a>
                    </li>
                </ul>
            </li>
        @endcan
        <li class="nav-item">
            <a class="nav-link" href="{{ route('backend.notifications.index') }}">
                <i class="nav-icon fa-regular fa-bell"></i>&nbsp;@lang('Notifications')
                @if ($notifications_count)
                    &nbsp;<span class="badge badge-sm bg-info ms-auto">{{ $notifications_count }}</span>
                @endif
            </a>
        </li>

     {{-- @can('view_posts')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('backend.posts.index') }}">
                    <i class="nav-icon fa-regular fa-file-lines"></i>&nbsp;@lang('Posts')
                </a>
            </li>
        @endcan --}}
        @can('view_logs')
            <li class="nav-group" aria-expanded="true">
                <a class="nav-link nav-group-toggle" href="#">
                    <i class="nav-icon fa-solid fa-car"></i>&nbsp;@lang('Vehicle Management')
                </a>
                <ul class="nav-group-items compact" style="height: auto;">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('vehicle.index') }}">
                            <span class="nav-icon"><span class="fa-solid fa-car"></span></span> Vehicles
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('alert.index') }}">
                            <span class="nav-icon"><span class="fa-solid fa-triangle-exclamation"></span></span>Alert
                            Settings
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('vehiclestatus.index') }}">
                            <span class="nav-icon"><span class="fa-solid fa-car"></span></span>Vehicle Status
                        </a>
                    </li>
                </ul>
            </li>
        @endcan
        @can('view_logs')
            <li class="nav-group" aria-expanded="true">
                <a class="nav-link nav-group-toggle" href="#">
                    <i class="fa-solid fa-hotel"></i></i>&nbsp;@lang('Reservation Management')
                </a>
                <ul class="nav-group-items compact" style="height: auto;">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('reservation.index') }}">
                            <span class="nav-icon"><span class="fa-sharp fa-solid fa-hotel"></span></span> Reservations
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('customercontact.index') }}">
                            <span class="nav-icon"><span class="fa-solid fa-triangle-exclamation"></span></span>Contracts

                        </a>
                    </li>
                </ul>
            </li>
        @endcan
{{--
        @can('view_categories')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('backend.categories.index') }}">
                    <i class="nav-icon fa-solid fa-diagram-project"></i>&nbsp;@lang('Categories')
                </a>
            </li>
        @endcan --}}
        {{-- @can('view_tags')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('backend.tags.index') }}">
                    <i class="nav-icon fa-solid fa-tags"></i>&nbsp;@lang('Tags')
                </a>
            </li>
        @endcan --}}

        @can('edit_settings')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('backend.settings') }}">
                    <i class="nav-icon fa-solid fa-gears"></i>&nbsp;@lang('Settings')
                </a>
            </li>
        @endcan

        {{-- @can('view_backups')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('backend.backups.index') }}">
                    <i class="nav-icon fa-solid fa-box-archive"></i>&nbsp;@lang('Backups')
                </a>
            </li>
        @endcan --}}

        @can('view_users')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('backend.users.index') }}">
                    <i class="nav-icon fa-solid fa-user-group"></i>&nbsp;@lang('Users')
                </a>
            </li>
        @endcan

        @can('view_roles')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('backend.roles.index') }}">
                    <i class="nav-icon fa-solid fa-user-shield"></i>&nbsp;@lang('Roles')
                </a>
            </li>
        @endcan
{{--
        @can('view_logs')
            <li class="nav-group" aria-expanded="true">
                <a class="nav-link nav-group-toggle" href="#">
                    <i class="nav-icon fa-solid fa-list-ul"></i>&nbsp;@lang('Logs')
                </a>
                <ul class="nav-group-items compact" style="height: auto;">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('log-viewer::dashboard') }}">
                            <span class="nav-icon"><span class="nav-icon-bullet"></span></span> Log Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('log-viewer::logs.list') }}">
                            <span class="nav-icon"><span class="nav-icon-bullet"></span></span> Daily Log
                        </a>
                    </li>
                </ul>
            </li>
        @endcan --}}

    </ul>
    <div class="sidebar-footer border-top d-none d-md-flex">
        <button class="sidebar-toggler" data-coreui-toggle="unfoldable" type="button"></button>
    </div>
</div>
