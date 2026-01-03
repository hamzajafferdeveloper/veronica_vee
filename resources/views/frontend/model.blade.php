@extends('layouts.app')

@section('title', 'Models Page')

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
    <section class="mt-5">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">

                @foreach ($models as $model)
                    <div class="col">
                        <x-frontend.model-card :model="$model" />
                    </div>
                @endforeach

            </div>
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
