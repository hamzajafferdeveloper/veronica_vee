@extends('layouts.app')

@section('title', 'Application Form')

@section('content')
    <div class="container py-5">
        <h1 class="mb-4">Application Form</h1>

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
                <label for="full_name" class="form-label">Full Name *</label>
                <input type="text" class="form-control" id="full_name" name="full_name" value="{{ old('full_name') }}"
                    required>
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email Address *</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}"
                    required>
            </div>

            <!-- Phone -->
            <div class="mb-3">
                <label for="phone" class="form-label">Whatsapp</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}">
            </div>

            <!-- Date of Birth -->
            <div class="mb-3">
                <label for="dob" class="form-label">Date of Birth</label>
                <input type="date" class="form-control" id="dob" name="dob" value="{{ old('dob') }}">
            </div>

            <!-- Gender -->
            <div class="mb-3">
                <label class="form-label">Gender</label>
                <select class="form-select" name="gender">
                    <option value="">Select Gender</option>
                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                    <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
                </select>
            </div>

            <!-- Upload CV / Document -->
            <div class="mb-3">
                <label for="resume" class="form-label">Upload Photos</label>
                <input type="file" class="form-control" id="resume" name="resume" accept=".pdf,.doc,.docx">
            </div>

            <!-- Cover Letter -->
            <div class="mb-3">
                <label for="cover_letter" class="form-label">Cover Letter</label>
                <textarea class="form-control" id="cover_letter" name="cover_letter" rows="5">{{ old('cover_letter') }}</textarea>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Submit Application</button>
        </form>
    </div>
@endsection
