@extends('layouts.app')

@section('title', 'Models Page')

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

@section('content')
    <section class="mt-5">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">

                @foreach ($models as $model)
                    <div class="col">
                        <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden position-relative model-card">

                            <!-- Image with hover overlay -->
                            <div class="position-relative overflow-hidden rounded-top" style="height: 350px;">
                                <img src="{{ $model->avatar ? asset('storage/' . $model->avatar) : asset('images/placeholder.png') }}"
                                    alt="{{ $model->user->first_name ?? 'Model' }}"
                                    class="w-100 h-100 object-fit-cover model-img">

                                <!-- Gradient Overlay -->
                                <div
                                    class="overlay position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-end p-3 text-white">
                                    <h5 class="mb-1 fw-bold">{{ $model->user->first_name ?? 'Model' }}
                                        {{ $model->user->last_name ?? '' }}</h5>
                                    <small class="d-block">{{ $model->age ?? '-' }} yrs •
                                        {{ $model->gender ?? '-' }}</small>
                                    <small class="d-block">{{ $model->location ?? '-' }}</small>
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
