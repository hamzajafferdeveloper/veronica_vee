@extends('layouts.professional')

@section('title', __('My Profile'))

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-8">

                {{-- Profile Card --}}
                <div class="card shadow-sm">
                    <div class="card-body">

                        {{-- Avatar --}}
                        <div class="text-center mb-4">
                            <img id="avatarPreview"
                                src="{{ optional($profile?->model?->avatar) ? asset('storage/' . $profile?->model?->avatar) : 'https://via.placeholder.com/150' }}"
                                alt="Avatar" class="rounded-circle border shadow-sm"
                                style="width:150px; height:150px; object-fit:cover;">
                        </div>

                        {{-- Update Form --}}
                        <form action="{{ route('professional.profile.update') }}" method="POST"
                            enctype="multipart/form-data" id="profileForm">
                            @csrf
                            @method('post')

                            {{-- Avatar Upload --}}
                            <div class="mb-3">
                                <label class="form-label">{{ __('Avatar') }}</label>
                                <input type="file" name="avatar" class="form-control" id="avatarInput" accept="image/*">
                                @error('avatar')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Personal Info --}}
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">{{ __('First Name') }}</label>
                                    <input type="text" name="first_name"
                                        value="{{ old('first_name', $profile->first_name) }}" class="form-control">
                                    @error('first_name')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">{{ __('Last Name') }}</label>
                                    <input type="text" name="last_name"
                                        value="{{ old('last_name', $profile->last_name) }}" class="form-control">
                                    @error('last_name')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">{{ __('Age') }}</label>
                                    <input type="number" name="age"
                                        value="{{ old('age', $profile->model->age ?? '') }}" class="form-control">
                                    @error('age')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">{{ __('Gender') }}</label>
                                    <select name="gender" class="form-select">
                                        <option value="">{{ __('Select Gender') }}</option>
                                        <option value="male"
                                            {{ old('gender', $profile->model->gender ?? '') == 'male' ? 'selected' : '' }}>
                                            {{ __('Male') }}</option>
                                        <option value="female"
                                            {{ old('gender', $profile->model->gender ?? '') == 'female' ? 'selected' : '' }}>
                                            {{ __('Female') }}
                                        </option>
                                        <option value="other"
                                            {{ old('gender', $profile->model->gender ?? '') == 'other' ? 'selected' : '' }}>
                                            {{ __('Other') }}</option>
                                    </select>
                                    @error('gender')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">{{ __('Height') }}</label>
                                    <input type="text" name="height"
                                        value="{{ old('height', $profile->model->height ?? '') }}" class="form-control"
                                        placeholder="{{ __('e.g., 5\'9"') }}">
                                    @error('height')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">{{ __('Weight') }}</label>
                                    <input type="text" name="weight"
                                        value="{{ old('weight', $profile->model->weight ?? '') }}" class="form-control"
                                        placeholder="{{ __('e.g., 70kg') }}">
                                    @error('weight')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">{{ __('Experience') }}</label>
                                <input type="text" name="experience"
                                    value="{{ old('experience', $profile->model->experience ?? '') }}" class="form-control"
                                    placeholder="{{ __('e.g., 3 years modeling') }}">
                                @error('experience')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">{{ __('Location') }}</label>
                                <input type="text" name="location"
                                    value="{{ old('location', $profile->model->location ?? '') }}" class="form-control"
                                    placeholder="{{ __('City, Country') }}">
                                @error('location')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">{{ __('Portfolio URL') }}</label>
                                <input type="url" name="portfolio_url"
                                    value="{{ old('portfolio_url', $profile->model->portfolio_url ?? '') }}"
                                    class="form-control" placeholder="https://portfolio.com">
                                @error('portfolio_url')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-primary btn-lg">{{ __('Update Profile') }}</button>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        // Preview avatar image
        $('#avatarInput').change(function() {
            const reader = new FileReader();
            reader.onload = function(e) {
                $('#avatarPreview').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        });
    </script>
@endpush
