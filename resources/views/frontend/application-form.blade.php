@extends('layouts.app')

@section('title', __('ui.application_form'))

@section('content')
    <div class="container py-5">
        <h1 class="mb-4">{{ __('ui.application_form') }}</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('application.submit') }}" enctype="multipart/form-data">
            @csrf

            <!-- Full Name -->
            <div class="mb-3">
                <label for="full_name" class="form-label">{{ __('ui.full_name') }} *</label>
                <input type="text" class="form-control" id="full_name" name="full_name" value="{{ old('full_name') }}"
                    required>
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">{{ __('auth.email') }} *</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}"
                    required>
            </div>

            <!-- Phone -->
            <div class="mb-3">
                <label for="phone" class="form-label">{{ __('ui.whatsapp') }}</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}">
            </div>

            <!-- Date of Birth -->
            <div class="mb-3">
                <label for="dob" class="form-label">{{ __('ui.dob') }}</label>
                <input type="date" class="form-control" id="dob" name="dob" value="{{ old('dob') }}">
            </div>

            <!-- Gender -->
            <div class="mb-3">
                <label class="form-label">{{ __('ui.gender') }}</label>
                <select class="form-select" name="gender">
                    <option value="">{{ __('ui.select_gender') }}</option>
                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>{{ __('ui.male') }}</option>
                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>{{ __('ui.female') }}</option>
                    <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>{{ __('ui.other') }}</option>
                </select>
            </div>

            <!-- Upload CV / Document -->
            <div class="mb-3">
                <label for="images" class="form-label">{{ __('ui.upload_photos') }}</label>
                <input type="file" class="form-control" id="images" name="images[]" multiple>
            </div>

            <!-- Cover Letter -->
            <div class="mb-3">
                <label for="cover_letter" class="form-label">{{ __('ui.cover_letter') }}</label>
                <textarea class="form-control" id="cover_letter" name="cover_letter" rows="5">{{ old('cover_letter') }}</textarea>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">{{ __('buttons.submit_application') }}</button>
        </form>
    </div>
@endsection
