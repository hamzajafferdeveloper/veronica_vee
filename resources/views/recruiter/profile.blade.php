@extends('layouts.recruiter')

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
                                src="{{ optional($profile?->recruiter?->avatar) ? asset('storage/' . $profile?->recruiter?->avatar) : 'https://via.placeholder.com/150' }}"
                                alt="Avatar" class="rounded-circle border shadow-sm"
                                style="width:150px; height:150px; object-fit:cover;">
                        </div>

                        {{-- Update Form --}}
                        <form action="{{ route('recruiter.profile.update') }}" method="POST" enctype="multipart/form-data"
                            id="profileForm">
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

                            <div class="mb-3">
                                <label class="form-label">{{ __('Phone Number') }}</label>
                                <input type="text" name="phone"
                                    value="{{ old('phone', $profile->recruiter->phone ?? '') }}" class="form-control">
                                @error('phone')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="mb-3">
                                <label class="form-label">{{ __('Address') }}</label>
                                <input type="text" name="address"
                                    value="{{ old('address', $profile->recruiter->address ?? '') }}" class="form-control"
                                    placeholder="{{ __('City, Country') }}">
                                @error('address')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">{{ __('Bio') }}</label>
                                <textarea type="text" name="bio" value="{{ old('bio', $profile->recruiter->bio ?? '') }}" class="form-control"
                                    placeholder="{{ __('Tell us about yourself') }}"></textarea>
                                @error('bio')
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
