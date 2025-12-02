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
                    <button type="button" class="btn btn-outline-light fw-bold text-uppercase rounded-0">FInd models and Talents<i class="bi bi-box-arrow-up-right ms-2"></i></button>
                </div><!--/carousel-caption-->

            </div><!--/carousel-item-->

            <div class="carousel-item active">
                <img src="{{ asset('assets/images/banner.jpg') }}" class="d-block w-100" alt="banner">

                <div class="carousel-caption text-sm-start">
                    <h2 class="display-6 fw-bold text-uppercase">Match Making,<br>models & more,,</h2>
                    <h5 class="text-uppercase mb-3">Connections for a lifetime or<br>Just as your Desire</h5>
                    <button type="button" class="btn btn-outline-light fw-bold text-uppercase rounded-0">FInd models and Talents<i class="bi bi-box-arrow-up-right ms-2"></i></button>
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
                    <img src="{{ asset('assets/images/logo.png')  }}" alt="img" class="img-fluid">
                </div><!--/col(logo)-->

                <div class="col-md-6">
                    <img src="{{ asset('/assets/images/about-img.jpg')  }}" alt="img" class="img-fluid">
                </div><!--/col(logo)-->

            </div><!--/row-->
        </div><!--/container-fluid-->
    </section>

    <section class="mt-5" id="cta">
        <div class="container-fluid">

            <a href="#" class="card card-cta border-0 rounded-0 text-center text-white text-decoration-none">
                <div class="card-body py-5">
                    <h2 class="font-Oswald text-uppercase fw-lighter display-3 mb-0">Application</h2>
                </div>
            </a><!--/card-->

        </div><!--/container-fluid-->
    </section><!--/cta-->

    <section class="mt-5" id="listing">
        <div class="container-fluid">
            <div class="row g-4">

                <div class="col-lg-3 col-md-4 col-6">
                    <a href="#" class="card border-0 rounded-0 text-center text-white">
                        <img src="{{ asset('/assets/images/m1.jpg') }}" class="card-img rounded-0" alt="img">
                        <div class="card-img-overlay rounded-0 top-unset pt-5">
                            <h3 class="fs-18 mb-0 fw-bold">Name Here</h3>
                        </div>
                    </a><!--/card-->
                </div><!--/col(1)-->

                <div class="col-lg-3 col-md-4 col-6">
                    <a href="#" class="card border-0 rounded-0 text-center text-white">
                        <img src="{{ asset('/assets/images/m1.jpg') }}" class="card-img rounded-0" alt="img">
                        <div class="card-img-overlay rounded-0 top-unset pt-5">
                            <h3 class="fs-18 mb-0 fw-bold">Name Here</h3>
                        </div>
                    </a><!--/card-->
                </div><!--/col(1)-->

                <div class="col-lg-3 col-md-4 col-6">
                    <a href="#" class="card border-0 rounded-0 text-center text-white">
                        <img src="{{ asset('/assets/images/m1.jpg') }}" class="card-img rounded-0" alt="img">
                        <div class="card-img-overlay rounded-0 top-unset pt-5">
                            <h3 class="fs-18 mb-0 fw-bold">Name Here</h3>
                        </div>
                    </a><!--/card-->
                </div><!--/col(1)-->

                <div class="col-lg-3 col-md-4 col-6">
                    <a href="#" class="card border-0 rounded-0 text-center text-white">
                        <img src="{{ asset('/assets/images/m1.jpg') }}" class="card-img rounded-0" alt="img">
                        <div class="card-img-overlay rounded-0 top-unset pt-5">
                            <h3 class="fs-18 mb-0 fw-bold">Name Here</h3>
                        </div>
                    </a><!--/card-->
                </div><!--/col(1)-->

                <div class="col-lg-3 col-md-4 col-6">
                    <a href="#" class="card border-0 rounded-0 text-center text-white">
                        <img src="{{ asset('/assets/images/m1.jpg') }}" class="card-img rounded-0" alt="img">
                        <div class="card-img-overlay rounded-0 top-unset pt-5">
                            <h3 class="fs-18 mb-0 fw-bold">Name Here</h3>
                        </div>
                    </a><!--/card-->
                </div><!--/col(1)-->

                <div class="col-lg-3 col-md-4 col-6">
                    <a href="#" class="card border-0 rounded-0 text-center text-white">
                        <img src="{{ asset('/assets/images/m1.jpg') }}" class="card-img rounded-0" alt="img">
                        <div class="card-img-overlay rounded-0 top-unset pt-5">
                            <h3 class="fs-18 mb-0 fw-bold">Name Here</h3>
                        </div>
                    </a><!--/card-->
                </div><!--/col(1)-->

                <div class="col-lg-3 col-md-4 col-6">
                    <a href="#" class="card border-0 rounded-0 text-center text-white">
                        <img src="{{ asset('/assets/images/m1.jpg') }}" class="card-img rounded-0" alt="img">
                        <div class="card-img-overlay rounded-0 top-unset pt-5">
                            <h3 class="fs-18 mb-0 fw-bold">Name Here</h3>
                        </div>
                    </a><!--/card-->
                </div><!--/col(1)-->

                <div class="col-lg-3 col-md-4 col-6">
                    <a href="#" class="card border-0 rounded-0 text-center text-white">
                        <img src="{{ asset('/assets/images/m1.jpg') }}" class="card-img rounded-0" alt="img">
                        <div class="card-img-overlay rounded-0 top-unset pt-5">
                            <h3 class="fs-18 mb-0 fw-bold">Name Here</h3>
                        </div>
                    </a><!--/card-->
                </div><!--/col(1)-->

                <div class="col-lg-3 col-md-4 col-6">
                    <a href="#" class="card border-0 rounded-0 text-center text-white">
                        <img src="{{ asset('/assets/images/m1.jpg') }}" class="card-img rounded-0" alt="img">
                        <div class="card-img-overlay rounded-0 top-unset pt-5">
                            <h3 class="fs-18 mb-0 fw-bold">Name Here</h3>
                        </div>
                    </a><!--/card-->
                </div><!--/col(1)-->

                <div class="col-lg-3 col-md-4 col-6">
                    <a href="#" class="card border-0 rounded-0 text-center text-white">
                        <img src="{{ asset('/assets/images/m1.jpg') }}" class="card-img rounded-0" alt="img">
                        <div class="card-img-overlay rounded-0 top-unset pt-5">
                            <h3 class="fs-18 mb-0 fw-bold">Name Here</h3>
                        </div>
                    </a><!--/card-->
                </div><!--/col(1)-->

                <div class="col-lg-3 col-md-4 col-6">
                    <a href="#" class="card border-0 rounded-0 text-center text-white">
                        <img src="{{ asset('/assets/images/m1.jpg') }}" class="card-img rounded-0" alt="img">
                        <div class="card-img-overlay rounded-0 top-unset pt-5">
                            <h3 class="fs-18 mb-0 fw-bold">Name Here</h3>
                        </div>
                    </a><!--/card-->
                </div><!--/col(1)-->

                <div class="col-lg-3 col-md-4 col-6">
                    <a href="#" class="card border-0 rounded-0 text-center text-white">
                        <img src="{{ asset('/assets/images/m1.jpg') }}" class="card-img rounded-0" alt="img">
                        <div class="card-img-overlay rounded-0 top-unset pt-5">
                            <h3 class="fs-18 mb-0 fw-bold">Name Here</h3>
                        </div>
                    </a><!--/card-->
                </div><!--/col(1)-->

            </div><!--/row-->
        </div><!--/container-fluid-->
    </section><!--/listing-->

    <section class="mt-5" id="moreThenModels">
        <div class="container-fluid justify-content-center">
            <div class="row g-4">

                <div class="col-12 text-center">
                    <h2 class="fw-bold">More Then Models</h2>
                    <p class="mb-0">Lorem Ipsum is simply dummy text of the printing and typesetting industry.<br>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, </p>

                </div><!--/col(heading)-->

                <div class="col-lg-2 col-md-4 col-6">
                    <a href="#" class="card border-0 rounded-0 text-center text-white">
                        <img src="{{ asset('/assets/images/about-img.jpg') }}" class="card-img rounded-0" alt="img">
                        <div class="card-img-overlay rounded-0 top-unset pt-5">
                            <h3 class="fs-18 mb-0 fw-bold">I'm a Newcomer</h3>
                            <p class="mb-0 fs-14">Tell me more</p>
                        </div>
                    </a><!--/card-->
                </div><!--/col(1)-->

                <div class="col-lg-2 col-md-4 col-6">
                    <a href="#" class="card border-0 rounded-0 text-center text-white">
                        <img src="{{ asset('/assets/images/about-img.jpg') }}" class="card-img rounded-0" alt="img">
                        <div class="card-img-overlay rounded-0 top-unset pt-5">
                            <h3 class="fs-18 mb-0 fw-bold">I'm a Newcomer</h3>
                            <p class="mb-0 fs-14">Tell me more</p>
                        </div>
                    </a><!--/card-->
                </div><!--/col(1)-->

                <div class="col-lg-2 col-md-4 col-6">
                    <a href="#" class="card border-0 rounded-0 text-center text-white">
                        <img src="{{ asset('/assets/images/about-img.jpg') }}" class="card-img rounded-0" alt="img">
                        <div class="card-img-overlay rounded-0 top-unset pt-5">
                            <h3 class="fs-18 mb-0 fw-bold">I'm a Newcomer</h3>
                            <p class="mb-0 fs-14">Tell me more</p>
                        </div>
                    </a><!--/card-->
                </div><!--/col(1)-->

                <div class="col-lg-2 col-md-4 col-6">
                    <a href="#" class="card border-0 rounded-0 text-center text-white">
                        <img src="{{ asset('/assets/images/about-img.jpg') }}" class="card-img rounded-0" alt="img">
                        <div class="card-img-overlay rounded-0 top-unset pt-5">
                            <h3 class="fs-18 mb-0 fw-bold">I'm a Newcomer</h3>
                            <p class="mb-0 fs-14">Tell me more</p>
                        </div>
                    </a><!--/card-->
                </div><!--/col(1)-->

                <div class="col-lg-2 col-md-4 col-6">
                    <a href="#" class="card border-0 rounded-0 text-center text-white">
                        <img src="{{ asset('/assets/images/about-img.jpg') }}" class="card-img rounded-0" alt="img">
                        <div class="card-img-overlay rounded-0 top-unset pt-5">
                            <h3 class="fs-18 mb-0 fw-bold">I'm a Newcomer</h3>
                            <p class="mb-0 fs-14">Tell me more</p>
                        </div>
                    </a><!--/card-->
                </div><!--/col(1)-->

                <div class="col-lg-2 col-md-4 col-6">
                    <a href="#" class="card border-0 rounded-0 text-center text-white">
                        <img src="{{ asset('/assets/images/about-img.jpg') }}" class="card-img rounded-0" alt="img">
                        <div class="card-img-overlay rounded-0 top-unset pt-5">
                            <h3 class="fs-18 mb-0 fw-bold">I'm a Newcomer</h3>
                            <p class="mb-0 fs-14">Tell me more</p>
                        </div>
                    </a><!--/card-->
                </div><!--/col(1)-->

                <div class="col-12 text-center">
                    <a href="{{ route('loginOrSignup') }}" class="btn btn-primary bg-gradient border-0 rounded-pill px-4 fw-bold">Sign up now!</a>
                </div><!--/col(btn)-->

            </div><!--/row-->
        </div><!--/container-fluid-->
    </section>

    <section class="mt-5" id="other">
        <div class="container">
            <div class="card text-bg-primary bg-gradient border shadow-lg text-center rounded-4">
                <div class="card-body py-5">

                    <h4 class="fw-medium mb-5">The worlds best talent and creators that trust us</h4>

                    <div class="row gy-4 justify-content-around">

                        <div class="col-auto">
                            <h2 class="mb-0 display-5 fw-bold">6,069</h2>
                            <p class="mb-0">NEW JOB POSTED</p>
                        </div><!--/col(1)-->

                        <div class="col-auto">
                            <h2 class="mb-0 display-5 fw-bold">241,661</h2>
                            <p class="mb-0">MODEL AND ARTISTS</p>
                        </div><!--/col(2)-->

                        <div class="col-auto">
                            <h2 class="mb-0 display-5 fw-bold">184,918</h2>
                            <p class="mb-0">PRODUCERS AND DIRECTORS</p>
                        </div><!--/col(3)-->

                    </div><!--/row-->

                </div><!--/card-body-->
            </div><!--/card-->
        </div>
        </div><!--/container-fluid-->
    </section>

    <section class="mt-5" id="brandArea">
        <div class="container-fluid">

            <h2 class="fw-bold mb-5 text-center">Brands that trust us</h2>

            <div class="owl-carousel text-center" id="brandCarousel">

                <div>
                    <img class="img-fluid" src="{{ asset('assets/images/brand.png') }}" alt="brand-logo">
                </div>

                <div>
                    <img class="img-fluid" src="{{ asset('assets/images/brand.png') }}" alt="brand-logo">
                </div>

                <div>
                    <img class="img-fluid" src="{{ asset('assets/images/brand.png') }}" alt="brand-logo">
                </div>
                <div>
                    <img class="img-fluid" src="{{ asset('assets/images/brand.png') }}" alt="brand-logo">
                </div>

                <div>
                    <img class="img-fluid" src="{{ asset('assets/images/brand.png') }}" alt="brand-logo">
                </div>

                <div>
                    <img class="img-fluid" src="{{ asset('assets/images/brand.png') }}" alt="brand-logo">
                </div>

                <div>
                    <img class="img-fluid" src="{{ asset('assets/images/brand.png') }}" alt="brand-logo">
                </div>

                <div>
                    <img class="img-fluid" src="{{ asset('assets/images/brand.png') }}" alt="brand-logo">
                </div>

                <div>
                    <img class="img-fluid" src="{{ asset('assets/images/brand.png') }}" alt="brand-logo">
                </div>

            </div><!--/owl-carouse-->

        </div><!--/container-->
    </section><!--/brandArea-->

@endsection

@push('script')
    <script>

        $('#brandCarousel').owlCarousel({
            margin:24,
            nav:false,
            dots:false,
            responsive:{
                0:   {items:2, margin:16},
                576: {items:3},
                768: {items:4},
                992: {items:5},
                1200: {items:6},
                1400: {items:8},
            }
        })
    </script>
@endpush
