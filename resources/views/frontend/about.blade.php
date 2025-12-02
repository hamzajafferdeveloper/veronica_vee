@extends('layouts.app')

@section('title', 'About Page')

@section('content')

    <section class="mt-5" id="cta">
        <div class="container-fluid">

            <div class="card card-cta border-0 rounded-0 text-center text-white text-decoration-none">
                <div class="card-body py-5">
                    <h2 class="font-Oswald text-uppercase fw-lighter display-3 mb-0">What we do</h2>
                </div>
            </div><!--/card-->

        </div><!--/container-fluid-->
    </section><!--/cta-->

    <section class="mt-5" id="listing">
        <div class="container-fluid">
            <div class="row g-4">

                <div class="col-12 text-md-center">
                    <h3 class="display-5 fw-light">Match Making</h3>
                    <p class="mb-0">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                        Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer
                        took a galley of type and scrambled it to make a type specimen book. It has survived not only
                        five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                        It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum
                        passages, and more recently with desktop publishing software like Aldus PageMaker including
                        versions of Lorem Ipsum.</p>
                </div><!--/col(1)-->

                <div class="col-md-6">
                    <h3 class="display-5 fw-light">Content modeling agencies</h3>
                    <p class="mb-0">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                        Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer
                        took a galley of type and scrambled it to make a type specimen book. It has survived not only
                        five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                        It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum
                        passages, and more recently with desktop publishing software like Aldus PageMaker including
                        versions of Lorem Ipsum.</p>
                </div><!--/col(1)-->

                <div class="col-md-6">
                    <h3 class="display-5 fw-light">Sugar dating agencies</h3>
                    <p class="mb-0">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                        Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer
                        took a galley of type and scrambled it to make a type specimen book. It has survived not only
                        five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                        It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum
                        passages, and more recently with desktop publishing software like Aldus PageMaker including
                        versions of Lorem Ipsum.</p>
                </div><!--/col(1)-->

                <div class="col-md-6">
                    <h3 class="display-5 fw-light">The girlfriend experience,</h3>
                    <p class="mb-0">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                        Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer
                        took a galley of type and scrambled it to make a type specimen book. It has survived not only
                        five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                        It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum
                        passages, and more recently with desktop publishing software like Aldus PageMaker including
                        versions of Lorem Ipsum.</p>
                </div><!--/col(1)-->

                <div class="col-md-6">
                    <h3 class="display-5 fw-light">Traditional modeling agencies</h3>
                    <p class="mb-0">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                        Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer
                        took a galley of type and scrambled it to make a type specimen book. It has survived not only
                        five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                        It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum
                        passages, and more recently with desktop publishing software like Aldus PageMaker including
                        versions of Lorem Ipsum.</p>
                </div><!--/col(1)-->


            </div><!--/row-->
        </div><!--/container-fluid-->
    </section><!--/listing-->

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
            margin: 24,
            nav: false,
            dots: false,
            responsive: {
                0: {items: 2, margin: 16},
                576: {items: 3},
                768: {items: 4},
                992: {items: 5},
                1200: {items: 6},
                1400: {items: 8},
            }
        })
    </script>

@endpush
