@extends('layouts.app')

@section('title', 'Home Page')

@push('styles')
    <style>
        /* Image hover zoom */
        .model-card .model-img {
            transition: transform 0.5s ease;
        }

        .model-card:hover .model-img {
            transform: scale(1.05);
        }

        /* Overlay gradient */
        .model-card .overlay {
            background: linear-gradient(to top, rgba(0, 0, 0, 0.65), rgba(0, 0, 0, 0));
            transition: background 0.3s ease;
        }

        .model-card:hover .overlay {
            background: linear-gradient(to top, rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0));
        }

        /* Button hover shadow */
        .btn-hover-shadow:hover {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.25);
            transform: translateY(-2px);
            transition: all 0.3s ease;
        }

        /* Responsive card */
        @media (max-width: 576px) {
            .model-card .overlay h5 {
                font-size: 1rem;
            }

            .model-card .overlay small {
                font-size: 0.75rem;
            }

            .model-card .overlay .badge {
                font-size: 0.6rem;
            }
        }
    </style>
@endpush

@section('content')


    <div id="banner" class="carousel slide overflow-hidden">

        <div class="carousel-inner">

            <div class="carousel-item active">
                <img src="{{ asset('assets/images/banner.jpg') }}" class="d-block w-100" alt="banner">

                <div class="carousel-caption text-sm-start">
                    <h2 class="display-6 fw-bold text-uppercase">Match Making,<br>models & more,,</h2>
                    <h5 class="text-uppercase mb-3">Connections for a lifetime or<br>Just as your Desire</h5>
                    <a href="{{ route('model') }}" class="btn btn-outline-light fw-bold text-uppercase rounded-0">FInd models and
                        Talents<i class="bi bi-box-arrow-up-right ms-2"></i></a>
                </div><!--/carousel-caption-->

            </div><!--/carousel-item-->

            <div class="carousel-item active">
                <img src="{{ asset('assets/images/banner.jpg') }}" class="d-block w-100" alt="banner">

                <div class="carousel-caption text-sm-start">
                    <h2 class="display-6 fw-bold text-uppercase">Match Making,<br>models & more,,</h2>
                    <h5 class="text-uppercase mb-3">Connections for a lifetime or<br>Just as your Desire</h5>
                    <a href="{{ route("model") }}" class="btn btn-outline-light fw-bold text-uppercase rounded-0">FInd models and
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
                    <img src="{{ asset('/assets/images/about-img.jpg') }}" alt="img" class="img-fluid">
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

                @foreach ($models as $model)
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="card h-100 shadow border-0 rounded-4 overflow-hidden model-card position-relative">

                            <!-- Image with hover effect -->
                            <div class="position-relative overflow-hidden rounded-top" style="height: 360px;">
                                <img src="{{ $model->avatar ? asset('storage/' . $model->avatar) : asset('images/placeholder.png') }}"
                                    alt="{{ $model->user->first_name ?? 'Model' }}"
                                    class="w-100 h-100 object-fit-cover transition-scale">

                                <!-- Gradient Overlay -->
                                <div class="overlay position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-end p-3 text-white"
                                    style="background: linear-gradient(to top, rgba(0,0,0,0.65), transparent); transition: background 0.3s;">
                                    <h5 class="mb-1 fw-bold">{{ $model->user->first_name ?? 'Model' }}
                                        {{ $model->user->last_name ?? '' }}</h5>
                                    <small class="d-block">{{ $model->age ?? '-' }} yrs •
                                        {{ $model->gender ?? '-' }}</small>
                                    <small class="d-block text-truncate">{{ $model->location ?? '-' }}</small>
                                    @if ($model->experience)
                                        <span class="badge bg-primary mt-2">{{ Str::limit($model->experience, 25) }}</span>
                                    @endif
                                </div>
                            </div>

                            <!-- Card body -->
                            <div class="card-body text-center p-3 bg-white">
                                <a href="{{ route('frontend.model.profile', $model->id) }}"
                                    class="btn btn-primary w-100 rounded-pill fw-semibold btn-hover-shadow">
                                    View Profile
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div><!--/row-->
        </div><!--/container-fluid-->
    </section>

    {{-- <section class="mt-5" id="moreThenModels">
        <div class="container-fluid justify-content-center">
            <div class="row g-4">

                <div class="col-12 text-center">
                    <h2 class="fw-bold">More Then Models</h2>
                    <p class="mb-0">Lorem Ipsum is simply dummy text of the printing and typesetting industry.<br>Lorem
                        Ipsum has been the industry's standard dummy text ever since the 1500s, </p>

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
                        <img src="{{ asset('/assets/images/about-img.jpg') }}" class="card-img rounded-0"
                            alt="img">
                        <div class="card-img-overlay rounded-0 top-unset pt-5">
                            <h3 class="fs-18 mb-0 fw-bold">I'm a Newcomer</h3>
                            <p class="mb-0 fs-14">Tell me more</p>
                        </div>
                    </a><!--/card-->
                </div><!--/col(1)-->

                <div class="col-lg-2 col-md-4 col-6">
                    <a href="#" class="card border-0 rounded-0 text-center text-white">
                        <img src="{{ asset('/assets/images/about-img.jpg') }}" class="card-img rounded-0"
                            alt="img">
                        <div class="card-img-overlay rounded-0 top-unset pt-5">
                            <h3 class="fs-18 mb-0 fw-bold">I'm a Newcomer</h3>
                            <p class="mb-0 fs-14">Tell me more</p>
                        </div>
                    </a><!--/card-->
                </div><!--/col(1)-->

                <div class="col-lg-2 col-md-4 col-6">
                    <a href="#" class="card border-0 rounded-0 text-center text-white">
                        <img src="{{ asset('/assets/images/about-img.jpg') }}" class="card-img rounded-0"
                            alt="img">
                        <div class="card-img-overlay rounded-0 top-unset pt-5">
                            <h3 class="fs-18 mb-0 fw-bold">I'm a Newcomer</h3>
                            <p class="mb-0 fs-14">Tell me more</p>
                        </div>
                    </a><!--/card-->
                </div><!--/col(1)-->

                <div class="col-lg-2 col-md-4 col-6">
                    <a href="#" class="card border-0 rounded-0 text-center text-white">
                        <img src="{{ asset('/assets/images/about-img.jpg') }}" class="card-img rounded-0"
                            alt="img">
                        <div class="card-img-overlay rounded-0 top-unset pt-5">
                            <h3 class="fs-18 mb-0 fw-bold">I'm a Newcomer</h3>
                            <p class="mb-0 fs-14">Tell me more</p>
                        </div>
                    </a><!--/card-->
                </div><!--/col(1)-->

                <div class="col-12 text-center">
                    <a href="{{ route('loginOrSignup') }}"
                        class="btn btn-primary bg-gradient border-0 rounded-pill px-4 fw-bold">Sign up now!</a>
                </div><!--/col(btn)-->

            </div><!--/row-->
        </div><!--/container-fluid-->
    </section> --}}

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
