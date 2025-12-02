@extends('layouts.app')

@section('title', 'Model Detail Page')

@section('content')
    <section class="mt-5">
        <div class="container">

            <div class="row gy-4 mb-4">


                <div class="col-md-4">
                    <ul class="nav gap-2">
                        <li><a href="#"><i class="bi bi-facebook"></i></a></li>
                        <li><a href="#"><i class="bi bi-instagram"></i></a></li>
                        <li><a href="#"><i class="bi bi-tiktok"></i></a></li>

                    </ul>
                </div>

                <div class="col-md-4 text-center">
                    <h2 class="font-Oswald text-uppercase mb-0">What we do</h2>
                </div>

                <div class="col-md-4 text-end">
                    <a href="#" class="btn btn-outline-dark px-3 text-uppercase rounded-0">Contact</a>
                </div>

                <div class="col-md-2">
                    <ul class="nav flex-column gap-1 fs-14 text-center">
                        <li>Height</li>
                        <li>178</li>
                        <li>5', 10"</li>
                    </ul>
                </div>

                <div class="col-md-2">
                    <ul class="nav flex-column gap-1 fs-14 text-center">
                        <li>Height</li>
                        <li>178</li>
                        <li>5', 10"</li>
                    </ul>
                </div>

                <div class="col-md-2">
                    <ul class="nav flex-column gap-1 fs-14 text-center">
                        <li>Height</li>
                        <li>178</li>
                        <li>5', 10"</li>
                    </ul>
                </div>

                <div class="col-md-2">
                    <ul class="nav flex-column gap-1 fs-14 text-center">
                        <li>Height</li>
                        <li>178</li>
                        <li>5', 10"</li>
                    </ul>
                </div>

                <div class="col-md-2">
                    <ul class="nav flex-column gap-1 fs-14 text-center">
                        <li>Height</li>
                        <li>178</li>
                        <li>5', 10"</li>
                    </ul>
                </div>

                <div class="col-md-2">
                    <ul class="nav flex-column gap-1 fs-14 text-center">
                        <li>Height</li>
                        <li>178</li>
                        <li>5', 10"</li>
                    </ul>
                </div>


            </div>

            <div class="row gy-4">

                <div class="col-md-6">
                    <img src="{{ asset('assets/images/m1.jpg') }}" alt="img" class="w-100">
                </div>

                <div class="col-md-6">
                    <img src="{{ asset('assets/images/m1.jpg') }}" alt="img" class="w-100">
                </div>

                <div class="col-12">
                    <div class="ratio ratio-16x9">
                        <iframe src="https://www.youtube.com/embed/zpOULjyy-n8?rel=0" title="YouTube video"
                                allowfullscreen></iframe>
                    </div>
                </div>

                <div class="col-md-6">
                    <img src="{{ asset('assets/images/m1.jpg') }}" alt="img" class="w-100">
                </div>

                <div class="col-md-6">
                    <img src="{{ asset('assets/images/m1.jpg') }}" alt="img" class="w-100">
                </div>

                <div class="col-md-6">
                    <img src="{{ asset('assets/images/m1.jpg') }}" alt="img" class="w-100">
                </div>

                <div class="col-md-6">
                    <img src="{{ asset('assets/images/m1.jpg') }}" alt="img" class="w-100">
                </div>

            </div><!--/row-->
        </div>

    </section>
@endsection

@push('scripts')
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

    <script>
        (() => {
            'use strict'
            const forms = document.querySelectorAll('.needs-validation')
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
        })()

        <!--/validation-->

        function togglePassword() {
            var passwordInput = document.getElementById("password");
            var eyeIcon = document.getElementById("eyeIcon");
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                eyeIcon.classList.remove("bi-eye");
                eyeIcon.classList.add("bi-eye-slash");
            } else {
                passwordInput.type = "password";
                eyeIcon.classList.remove("bi-eye-slash");
                eyeIcon.classList.add("bi-eye");
            }
        }

        <!--/password-->
    </script>
@endpush

