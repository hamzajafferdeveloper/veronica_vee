@extends('layouts.app')

@section('title', 'Home Page')

@section('content')
    <div id="banner" class="carousel slide overflow-hidden">

        <div class="carousel-inner">

            <div class="carousel-item active">
                <img src="{{ asset('assets/images/banner.jpg') }}" class="d-block w-100" alt="banner">

                <div class="carousel-caption text-sm-start">
                    <h2 class="display-6 fw-bold text-uppercase">Match Making,<br>models & more,,</h2>
                    <h5 class="text-uppercase mb-3">Connections for a lifetime or<br>Just as your Desire</h5>
                    <a href="{{ route('model') }}" class="btn btn-outline-light fw-bold text-uppercase rounded-0">FInd
                        models and
                        Talents<i class="bi bi-box-arrow-up-right ms-2"></i></a>
                </div><!--/carousel-caption-->

            </div><!--/carousel-item-->

            <div class="carousel-item active">
                <img src="{{ asset('assets/images/banner.jpg') }}" class="d-block w-100" alt="banner">

                <div class="carousel-caption text-sm-start">
                    <h2 class="display-6 fw-bold text-uppercase">Match Making,<br>models & more,,</h2>
                    <h5 class="text-uppercase mb-3">Connections for a lifetime or<br>Just as your Desire</h5>
                    <a href="{{ route('model') }}" class="btn btn-outline-light fw-bold text-uppercase rounded-0">FInd
                        models and
                        Talents<i class="bi bi-box-arrow-up-right ms-2"></i></a>
                </div><!--/carousel-caption-->

            </div><!--/carousel-item-->


        </div><!--/carousel-inner-->

        <button class="carousel-control-prev" type="button" data-bs-target="#banner" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#banner" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
        </button>

    </div><!--/banner-->

    <section class="mt-5" id="about">
        <div class="container">
            <div class="row align-items-center text-center g-4 flex-md-row-reverse">

                <div class="col-md-6">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="img" class="img-fluid">
                </div><!--/col(logo)-->

                <div class="col-md-6">
                    <img src="{{ asset('assets/images/about-img.jpg') }}" alt="img" class="img-fluid">
                </div><!--/col(logo)-->

            </div><!--/row-->
        </div><!--/container-fluid-->
    </section>

    <section class="mt-5" id="cta">
        <div class="container-fluid">

            @auth
                @php
                    $roles = auth()->user()->getRoleNames();

                    if ($roles->contains('admin')) {
                        $route = 'admin.dashboard';
                    } elseif ($roles->contains('professional')) {
                        $route = 'professional.dashboard';
                    } elseif ($roles->contains('recruiter')) {
                        $route = 'recruiter.dashboard';
                    } else {
                        $route = 'loginOrSignup';
                    }
                @endphp
            @else
                @php
                    $route = 'loginOrSignup';
                @endphp
            @endauth

            <a href="{{ route($route) }}"
                class="card card-cta border-0 rounded-0 text-center text-white text-decoration-none">
                <div class="card-body py-5">
                    <h2 class="font-Oswald text-uppercase fw-lighter display-3 mb-0">
                        Application
                    </h2>
                </div>
            </a>


        </div><!--/container-fluid-->
    </section><!--/cta-->

    <section class="mt-5" id="listing">
        <div class="container-fluid">
            <div class="row g-4">

                @foreach ($models as $model)
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <x-frontend.model-card :model="$model" />
                    </div>
                @endforeach

            </div><!--/row-->
        </div><!--/container-fluid-->
    </section>

    <x-frontend.model-recruiter-no />

@endsection

@push('script')
    <script>
        $('#brandCarousel').owlCarousel({
            margin: 24,
            nav: false,
            dots: false,
            responsive: {
                0: {
                    items: 2,
                    margin: 16
                },
                576: {
                    items: 3
                },
                768: {
                    items: 4
                },
                992: {
                    items: 5
                },
                1200: {
                    items: 6
                },
                1400: {
                    items: 8
                },
            }
        })
    </script>
@endpush
