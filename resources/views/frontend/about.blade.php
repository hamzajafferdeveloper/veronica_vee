@extends('layouts.app')

@section('title', 'About Page')

@section('content')

    <section class="mt-5" id="cta">
        <div class="container-fluid">
            <div class="card card-cta border-0 rounded-0 text-center text-white text-decoration-none">
                <div class="card-body py-5">
                    <h2 class="font-Oswald text-uppercase fw-lighter display-3 mb-0">
                        What We Do
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
                    <h3 class="display-5 fw-light">Matchmaking</h3>
                    <p class="mb-0">
                        VeronicaVee connects genuine individuals through a refined matchmaking experience.
                        Our platform is designed to help users discover meaningful connections based on
                        mutual interests, lifestyle preferences, and personal goals—whether you are looking
                        for companionship, luxury dating, or long-term chemistry.
                    </p>
                </div>

                <!-- Content Modeling Agencies -->
                <div class="col-md-6">
                    <h3 class="display-5 fw-light">Content Modeling Agencies</h3>
                    <p class="mb-0">
                        We provide a trusted space for content modeling agencies to discover verified models
                        for digital campaigns, social media collaborations, and branded content.
                        Recruiters can browse curated profiles, communicate securely, and hire talent with confidence.
                    </p>
                </div>

                <!-- Sugar Dating Agencies -->
                <div class="col-md-6">
                    <h3 class="display-5 fw-light">Sugar Dating Agencies</h3>
                    <p class="mb-0">
                        VeronicaVee supports modern sugar dating by connecting ambitious individuals
                        with successful patrons in a discreet and respectful environment.
                        Transparency, consent, and privacy are at the core of every connection made on our platform.
                    </p>
                </div>

                <!-- Girlfriend Experience -->
                <div class="col-md-6">
                    <h3 class="display-5 fw-light">The Girlfriend Experience</h3>
                    <p class="mb-0">
                        Our platform enables authentic, chemistry-driven connections that go beyond casual interaction.
                        The girlfriend experience category focuses on emotional connection, attention, and companionship,
                        allowing users to build genuine and memorable relationships.
                    </p>
                </div>

                <!-- Traditional Modeling Agencies -->
                <div class="col-md-6">
                    <h3 class="display-5 fw-light">Traditional Modeling Agencies</h3>
                    <p class="mb-0">
                        Traditional modeling agencies can recruit fashion, lifestyle, and promotional models
                        directly from VeronicaVee.
                        With advanced filtering and profile verification, agencies can efficiently find talent
                        that matches their brand vision and professional standards.
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
