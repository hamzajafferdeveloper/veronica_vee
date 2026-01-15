@extends('layouts.app')

@section('title', __('Model Detail Page'))

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
                    {{-- <p class="text-muted mb-1">{{ $model->user->email ?? '' }}</p> --}}
                    <p class="text-muted small mb-2">{{ $model->experience ?? '' }} </p>
                    <!-- Buttons -->
                    <div class="d-flex gap-2 mt-3">
                        @auth
                            <button class="btn btn-primary px-4 js-start-chat" data-user-id="{{ $model->user->id }}">
                                {{ __('buttons.message') }}
                            </button>
                        @else
                            <a href="{{ route('login', ['redirect' => route('frontend.model.profile', $model->id)]) }}"
                                class="btn btn-primary px-4">
                                {{ __('buttons.login_to_get_start') }}
                            </a>
                        @endauth
                    </div>

                </div>

                <hr class="my-4">

            </div>

        </div>

    </div>

@endsection

@push('script')
    <script>
        $(document).on('click', '.js-start-chat', function() {
            const button = $(this);
            const userId = button.data('user-id');

            if (button.data('loading')) return;

            button
                .data('loading', true)
                .prop('disabled', true)
                .text("{{ __('Starting...') }}");

            $.ajax({
                url: "{{ route('recruiter.chat.conversation', ':userId') }}".replace(':userId', userId),
                type: 'GET',
                success: function(response) {
                    if (response.conversation_id) {
                        window.location.href =
                            "{{ route('recruiter.chat.messages', ':id') }}"
                            .replace(':id', userId);
                    }
                    button
                        .data('loading', false)
                        .prop('disabled', false)
                        .text("{{ __('Message') }}");
                },
                error: function() {
                    showToast("{{ __('Something went wrong. Please try again.') }}", 'error');
                    button
                        .data('loading', false)
                        .prop('disabled', false)
                        .text("{{ __('Message') }}");
                }
            });
        });
    </script>
@endpush
