@extends('layouts.app')

@section('title', 'Models Page')

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

            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                @foreach ($models as $model)
                    <div class="col">
                        <div class="card h-100 shadow-sm border-0">
                            <!-- Aspect ratio utility keeps image height consistent -->
                            <div class="ratio ratio-1x1 bg-light rounded-top">
                                <img src="{{ $model->avatar ? asset('storage/' . $model->avatar) : asset('images/placeholder.png') }}"
                                    alt="{{ $model->first_name ?? 'Model' }}"
                                    class="w-100 h-100 object-fit-cover rounded-top">
                            </div>
                            <div class="card-body text-center">
                                <a href="{{ route('frontend.model.profile', $model->id) }}"
                                    class="card-title mb-0">{{ $model->user->first_name . ' ' . $model->user->last_name ?? 'Model Name' }}</a>
                            </div>
                        </div>
                    </div>
                @endforeach
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

        <
        !--/validation-->

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

        <
        !--/password-->
    </script>
@endpush
