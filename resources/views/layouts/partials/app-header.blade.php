<header class="py-3" id="header2">
    <div class="container">
        <div class="row align-items-center">

            <div class="col-sm-auto col-5 me-auto" id="logo">
                <a href="{{ route('home') }}"><img src="{{ asset('assets/images/logo.png') }}" alt="img"
                        class="img-fluid filterWhite" width="150"></a>
            </div><!--/col(logo)-->

            <div class="col-auto order-sm-0 order-last ">
                <nav class="navbar navbar-expand-lg py-0" id="mainMenu">
                    <div class="offcanvas offcanvas-start bg-black" id="navbarNav">

                        <div class="offcanvas-header border-bottom border-secondary">

                            <div id="offcanvasLogo">
                                <img src="{{ asset('assets/images/logo.png') }}" alt="logo"
                                    class="img-fluid filterWhite" width="150">
                            </div><!--/offcanvasLogo-->

                            <button type="button" class="btn-close btn-close-white shadow-none"
                                data-bs-dismiss="offcanvas" aria-label="Close"></button>

                        </div><!--/offcanvas-header-->

                        <div class="offcanvas-body">
                            <ul class="navbar-nav fw-bold">

                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}"
                                        href="{{ route('home') }}">{{ __('Home') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}"
                                        href="{{ route('about') }}">{{ __('About') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('model') ? 'active' : '' }}"
                                        href="{{ route('model') }}">{{ __('Model') }}</a>
                                </li>

                                @auth
                                    <li class="nav-item">
                                        @php
                                            $roles = auth()->user()->getRoleNames();
                                        @endphp

                                        @if ($roles->contains('professional'))
                                            <a class="nav-link {{ request()->routeIs('professional.dashboard') ? 'active' : '' }}"
                                                href="{{ route('professional.dashboard') }}">{{ __('Dashboard') }}</a>
                                        @elseif ($roles->contains('recruiter'))
                                            <a class="nav-link {{ request()->routeIs('recruiter.dashboard') ? 'active' : '' }}"
                                                href="{{ route('recruiter.dashboard') }}">{{ __('Dashboard') }}</a>
                                        @elseif ($roles->contains('admin'))
                                            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                                                href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                                        @endif
                                    </li>
                                @else
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->routeIs('loginOrSignup') ? 'active' : '' }}"
                                            href="{{ route('loginOrSignup') }}">{{ __('Login') }}</a>
                                    </li>
                                @endauth

                            </ul>
                        </div>


                        <div class="offcanvas-footer p-3 border-top border-secondary d-lg-none fs-12">

                            <p class="mb-0 text-white">Copyright © 2025 VeronicaVee</p>

                        </div><!--/offcanvas-footer-->

                    </div><!--/offcanvas-->
                </nav><!--/navbar-->
            </div><!--/col(nav)-->

            <div class="col-sm-auto col-7">
                <ul class="nav gap-sm-3 gap-2 align-items-center justify-content-end" id="topmenu">


                    <li><a href="#" class="text-white"><i class="bi bi-facebook"></i></a></li>
                    <li><a href="#" class="text-white"><i class="bi bi-instagram"></i></a></li>
                    <li><a href="#" class="text-white"><i class="bi bi-tiktok"></i></a></li>
                    
                    <li class="dropdown">
                        <a class="dropdown-toggle text-white text-uppercase" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">{{ App::getLocale() }}</a>
                        <ul class="dropdown-menu dropdown-menu-end fs-14 p-2">
                            <li><a class="dropdown-item" href="{{ route('lang.switch', 'en') }}">English</a></li>
                            <li><a class="dropdown-item" href="{{ route('lang.switch', 'es') }}">Español</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false"><i class="bi-search"></i></a>
                        <div class="dropdown-menu dropdown-menu-end fs-14 p-2" id="search">
                            <div class="input-group border border-dark rounded-pill">
                                <input type="text" class="form-control bg-transparent border-0 fs-14"
                                    placeholder="{{ __('Search...') }}">
                                <button type="submit" class="btn btn-link ps-0 pe-3 text-dark"><i
                                        class="bi bi-search"></i></button>
                            </div>
                        </div><!--/dropdown-menu-->
                    </li>

                    <li class="d-lg-none">
                        <a class="navbar-toggler collapsed border-0 shadow-none d-block" type="button"
                            data-bs-toggle="offcanvas" data-bs-target="#navbarNav" aria-controls="menu"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="icon-bar top-bar"></span>
                            <span class="icon-bar middle-bar"></span>
                            <span class="icon-bar bottom-bar"></span>
                        </a>
                    </li>


                </ul>
            </div><!--/col(right)-->

        </div><!--/row-->
    </div><!--/container-->
</header>
