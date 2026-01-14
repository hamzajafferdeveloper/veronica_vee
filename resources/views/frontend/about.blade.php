@extends('layouts.app')

@section('title', __('about.title'))

@section('content')

    <section class="mt-5" id="cta">
        <div class="container-fluid">
            <div class="card card-cta border-0 rounded-0 text-center text-white text-decoration-none">
                <div class="card-body py-5">
                    <h2 class="font-Oswald text-uppercase fw-lighter display-3 mb-0">
                        {{ __('about.what_we_do') }}
                    </h2>
                </div>
            </div>
        </div>
    </section>

    <section class="mt-5" id="listing">
        <div class="container-fluid">
            <div class="row g-4">

                <!-- Matchmaking -->
                <div class="col-12 text-md-center">
                    <h3 class="display-5 fw-light">{{ __('about.matchmaking') }}</h3>
                    <p class="mb-0">
                        {{ __('about.matchmaking_desc') }}
                    </p>
                </div>

                <!-- Content Modeling Agencies -->
                <!-- Content Modeling Agencies -->
                <div class="col-md-6">
                    <h3 class="display-5 fw-light">{{ __('about.content_agencies') }}</h3>
                    <p class="mb-0">
                        {{ __('about.content_agencies_desc') }}
                    </p>
                </div>

                <!-- Sugar Dating Agencies -->
                <!-- Sugar Dating Agencies -->
                <div class="col-md-6">
                    <h3 class="display-5 fw-light">{{ __('about.sugar_agencies') }}</h3>
                    <p class="mb-0">
                        {{ __('about.sugar_agencies_desc') }}
                    </p>
                </div>

                <!-- Girlfriend Experience -->
                <!-- Girlfriend Experience -->
                <div class="col-md-6">
                    <h3 class="display-5 fw-light">{{ __('about.gfe') }}</h3>
                    <p class="mb-0">
                        {{ __('about.gfe_desc') }}
                    </p>
                </div>

                <!-- Traditional Modeling Agencies -->
                <!-- Traditional Modeling Agencies -->
                <div class="col-md-6">
                    <h3 class="display-5 fw-light">{{ __('about.traditional_agencies') }}</h3>
                    <p class="mb-0">
                        {{ __('about.traditional_agencies_desc') }}
                    </p>
                </div>

            </div>
        </div>
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
