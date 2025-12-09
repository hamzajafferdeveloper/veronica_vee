@extends('layouts.app')

@section('title', 'Model Detail Page')

@section('content')
    <style>
        .cover-bg {
            height: 230px;
            background: url("{{ asset('assets/images/profile-cover-image.png') }}") center/cover no-repeat;
            border-radius: 12px 12px 0 0;
            position: relative;
        }

        .profile-img {
            width: 180px;
            height: 180px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #fff;
            position: absolute;
            bottom: -70px;
            left: 30px;
        }
    </style>

    <div class="container my-5">

        <div class="card shadow-sm border-0">

            <!-- Cover Banner -->
            <div class="cover-bg"></div>

            <!-- Profile Section -->
            <div class="card-body">

                <!-- Profile Image + Badge -->
                <div style="position: relative; display: inline-block;">
                    <img src="{{ $model->avatar ? asset('storage/' . $model->avatar) : 'https://via.placeholder.com/150' }}"
                        class="profile-img h-5 w-5" alt="Profile">
                </div>
                <!-- Name + Info -->
                <div class="ps-4" style="margin-top: 80px;">
                    <h3 class="mb-0">{{ ($model->user->first_name ?? '') . ' ' . ($model->user->last_name ?? '') }}</h3>
                    <p class="text-muted mb-1">{{ $model->user->email ?? '' }}</p>
                    <p class="text-muted small mb-2">{{ $model->experience ?? '' }} {{-- . <a href="#">Contact info</a> --}} </p>
                    {{-- <p class="fw-semibold small text-primary">500+ connections</p> --}}

                    <!-- Buttons -->
                    <div class="d-flex gap-2 mt-3">
                        @auth
                            <a class="btn btn-primary px-4">Message</a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-primary px-4">Login to Start Messaging</a>
                        @endauth


                    </div>
                </div>

                <hr class="my-4">

                <!-- Open to work + Providing services -->
                {{-- <div class="row g-3">
                <div class="col-md-6">
                    <div class="border rounded p-3 bg-light">
                        <h6 class="fw-bold mb-1">Open to work</h6>
                        <p class="mb-1 small">
                            Digital Designer, UI/UX Designer, Website Developer,...
                        </p>
                        <a href="#" class="small">Show details</a>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="border rounded p-3 bg-light">
                        <h6 class="fw-bold mb-1">Providing Services</h6>
                        <p class="mb-1 small">
                            SEO Marketing, Website Optimization, Web Design,...
                        </p>
                        <a href="#" class="small">Show details</a>
                    </div>
                </div>
            </div> --}}

            </div>

        </div>

    </div>

@endsection
