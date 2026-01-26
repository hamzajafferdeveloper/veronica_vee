@extends('layouts.admin')

@section('title', __('ui.application_details'))

@section('content')

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">{{ __('ui.application_details') ?? 'Application Details' }}</h5>
                    <a href="{{ route('admin.applications.index') }}" class="btn btn-sm btn-secondary">
                        <iconify-icon icon="basil:arrow-left-outline"></iconify-icon> {{ __('ui.back') ?? 'Back' }}
                    </a>
                </div>

                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h6 class="text-md fw-semibold mb-2">{{ __('ui.full_name') ?? 'Full Name' }}:</h6>
                            <p class="text-secondary">{{ $application->full_name ?? '-' }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-md fw-semibold mb-2">{{ __('ui.email') ?? 'Email' }}:</h6>
                            <p class="text-secondary">
                                <a href="mailto:{{ $application->email }}">{{ $application->email ?? '-' }}</a>
                            </p>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h6 class="text-md fw-semibold mb-2">{{ __('ui.phone') ?? 'Phone' }}:</h6>
                            <p class="text-secondary">{{ $application->phone ?? '-' }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-md fw-semibold mb-2">{{ __('ui.gender') ?? 'Gender' }}:</h6>
                            <p class="text-secondary">
                                <span class="badge bg-info">{{ $application->gender ?? '-' }}</span>
                            </p>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h6 class="text-md fw-semibold mb-2">{{ __('ui.dob') ?? 'Date of Birth' }}:</h6>
                            <p class="text-secondary">
                                {{ $application->dob ? \Carbon\Carbon::parse($application->dob)->format('Y-m-d') : '-' }}
                            </p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-md fw-semibold mb-2">{{ __('ui.registered_on') ?? 'Applied On' }}:</h6>
                            <p class="text-secondary">{{ $application->created_at?->format('Y-m-d H:i') ?? '-' }}</p>
                        </div>
                    </div>

                    @if($application->user)
                        <hr>
                        <h6 class="text-md fw-semibold mb-3">{{ __('ui.user_information') ?? 'User Information' }}:</h6>
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h6 class="text-sm fw-semibold mb-2">{{ __('ui.first_name') ?? 'First Name' }}:</h6>
                                <p class="text-secondary">{{ $application->user->first_name ?? '-' }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-sm fw-semibold mb-2">{{ __('ui.last_name') ?? 'Last Name' }}:</h6>
                                <p class="text-secondary">{{ $application->user->last_name ?? '-' }}</p>
                            </div>
                        </div>
                    @endif

                    @if($application->cover_letter)
                        <hr>
                        <h6 class="text-md fw-semibold mb-2">{{ __('ui.cover_letter') ?? 'Cover Letter' }}:</h6>
                        <div class="bg-light p-3 rounded">
                            <p class="text-secondary">{{ $application->cover_letter }}</p>
                        </div>
                    @endif

                    @if($application->assets->count() > 0)
                        <hr>
                        <h6 class="text-md fw-semibold mb-3">{{ __('ui.attachments') ?? 'Attachments' }}:</h6>
                        <div class="row">
                            @foreach($application->assets as $asset)
                                <div class="col-md-4 mb-3">
                                    <div class="card border">
                                        <div class="card-body text-center">
                                            <iconify-icon icon="basil:document-outline" class="h-30-px w-30-px text-primary mb-2"></iconify-icon>
                                            <p class="text-sm mb-2">{{ basename($asset->path) ?? 'File' }}</p>
                                            <a href="{{ asset('storage/' . $asset->path) }}" target="_blank" class="btn btn-sm btn-primary">
                                                {{ __('ui.download') ?? 'Download' }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <div class="card-footer d-flex justify-content-end gap-2">
                    <form method="POST" action="{{ route('admin.applications.destroy', $application->id) }}" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this application?')">
                            <iconify-icon icon="basil:trash-outline"></iconify-icon> {{ __('ui.delete') ?? 'Delete' }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
