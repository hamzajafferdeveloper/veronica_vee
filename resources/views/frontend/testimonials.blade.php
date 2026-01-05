@extends('layouts.app')

@section('title', 'Home Page')

@section('content')

    <!-- Hero Section -->
    <section class="py-5 text-center bg-light">
        <div class="container">
            <h1 class="fw-bold display-5">Welcome to VeronicaVee</h1>
            <p class="lead text-muted mt-3">
                Where meaningful connections turn into lifelong love
            </p>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Success Stories</h2>
                <p class="text-muted">Real experiences from people who found true love with VeronicaVee</p>
            </div>

            <div class="row g-4">
                <!-- Testimonial 1 -->
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm border-0 rounded-4">
                        <div class="card-body">
                            <p class="text-muted">
                                “I was skeptical about using a matchmaking service, but VeronicaVee exceeded all my
                                expectations.
                                Their personalized approach led me straight to my wonderful husband.”
                            </p>
                            <h6 class="fw-bold mt-4 mb-0">— Happy Client</h6>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 2 -->
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm border-0 rounded-4">
                        <div class="card-body">
                            <p class="text-muted">
                                “After countless disappointing dates from apps, VeronicaVee was the best decision I ever made.
                                I was matched with an incredible woman who shares my core values.”
                            </p>
                            <h6 class="fw-bold mt-4 mb-0">— Satisfied Member</h6>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 3 -->
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm border-0 rounded-4">
                        <div class="card-body">
                            <p class="text-muted">
                                “VeronicaVee changed my life. The genuine care shown by my matchmaker made me feel understood.
                                We’re getting married next year!”
                            </p>
                            <h6 class="fw-bold mt-4 mb-0">— Engaged Client</h6>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 4 -->
                <div class="col-md-6 col-lg-6">
                    <div class="card h-100 shadow-sm border-0 rounded-4">
                        <div class="card-body">
                            <p class="text-muted">
                                “If you're serious about finding a meaningful, long-term relationship, look no further than
                                VeronicaVee.
                                I met my soulmate within just a few months.”
                            </p>
                            <h6 class="fw-bold mt-4 mb-0">— Grateful Client</h6>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 5 -->
                <div class="col-md-6 col-lg-6">
                    <div class="card h-100 shadow-sm border-0 rounded-4">
                        <div class="card-body">
                            <p class="text-muted">
                                “I had all but given up on finding the right person until I joined VeronicaVee.
                                Their human-centric approach simply works.”
                            </p>
                            <h6 class="fw-bold mt-4 mb-0">— Happy Partner</h6>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection
