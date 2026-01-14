@extends('layouts.app')

@section('title', __('testimonials.title'))

@section('content')

    <!-- Hero Section -->
    <section class="py-5 text-center bg-light">
        <div class="container">
            <h1 class="fw-bold display-5">{{ __('testimonials.welcome_title') }}</h1>
            <p class="lead text-muted mt-3">
                {{ __('testimonials.welcome_subtitle') }}
            </p>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold">{{ __('testimonials.success_stories') }}</h2>
                <p class="text-muted">{{ __('testimonials.success_subtitle') }}</p>
            </div>

            <div class="row g-4">
                <!-- Testimonial 1 -->
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm border-0 rounded-4">
                        <div class="card-body">
                            <p class="text-muted">
                                “{{ __('testimonials.testimonial_1') }}”
                            </p>
                            <h6 class="fw-bold mt-4 mb-0">— {{ __('testimonials.client_1') }}</h6>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 2 -->
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm border-0 rounded-4">
                        <div class="card-body">
                            <p class="text-muted">
                                “{{ __('testimonials.testimonial_2') }}”
                            </p>
                            <h6 class="fw-bold mt-4 mb-0">— {{ __('testimonials.client_2') }}</h6>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 3 -->
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm border-0 rounded-4">
                        <div class="card-body">
                            <p class="text-muted">
                                “{{ __('testimonials.testimonial_3') }}”
                            </p>
                            <h6 class="fw-bold mt-4 mb-0">— {{ __('testimonials.client_3') }}</h6>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 4 -->
                <div class="col-md-6 col-lg-6">
                    <div class="card h-100 shadow-sm border-0 rounded-4">
                        <div class="card-body">
                            <p class="text-muted">
                                “{{ __('testimonials.testimonial_4') }}”
                            </p>
                            <h6 class="fw-bold mt-4 mb-0">— {{ __('testimonials.client_4') }}</h6>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 5 -->
                <div class="col-md-6 col-lg-6">
                    <div class="card h-100 shadow-sm border-0 rounded-4">
                        <div class="card-body">
                            <p class="text-muted">
                                “{{ __('testimonials.testimonial_5') }}”
                            </p>
                            <h6 class="fw-bold mt-4 mb-0">— {{ __('testimonials.client_5') }}</h6>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection
