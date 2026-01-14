@extends('layouts.professional')

@section('title', __('ui.project_details_title'))

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">

                <!-- Project Header -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="fw-bold">{{ $project->title }}</h4>
                    <span
                        class="badge
                    @if ($project->status == 'published') bg-success
                    @elseif($project->status == 'draft') bg-secondary
                    @else bg-warning text-dark @endif
                    fs-6 py-1 px-3 shadow-sm">
                        {{ __("ui." . $project->status) }}
                    </span>
                </div>

                <!-- Project Details Card -->
                <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                    <div class="row g-0 p-3">

                        <!-- Left Column: Info -->
                        <div class="col-lg-7 p-4">
                            <!-- Project Info -->
                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <div class="p-3 rounded-3 bg-light border d-flex align-items-center">
                                        <i class="bi bi-tags-fill text-primary me-3 fs-5"></i>
                                        <div>
                                            <small class="text-muted">{{ __('ui.category') }}</small>
                                            <div class="fw-semibold">{{ $project->category->name ?? 'N/A' }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="p-3 rounded-3 bg-light border d-flex align-items-center">
                                        <i class="bi bi-currency-dollar text-success me-3 fs-5"></i>
                                        <div>
                                            <small class="text-muted">{{ __('ui.budget') }}</small>
                                            <div class="fw-semibold">${{ number_format($project->budget, 2) }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="p-3 rounded-3 bg-light border d-flex align-items-center">
                                        <i class="bi bi-calendar-event text-warning me-3 fs-5"></i>
                                        <div>
                                            <small class="text-muted">{{ __('ui.deadline') }}</small>
                                            <div class="fw-semibold">
                                                {{ \Carbon\Carbon::parse($project->deadline)->format('F d, Y') }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="p-3 rounded-3 bg-light border d-flex align-items-center">
                                        <i class="bi bi-clock-history text-info me-3 fs-5"></i>
                                        <div>
                                            <small class="text-muted">{{ __('ui.created_at') }}</small>
                                            <div class="fw-semibold">
                                                {{ \Carbon\Carbon::parse($project->created_at)->format('F d, Y H:i') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Description -->
                            <div class="mb-4 p-3 bg-white border rounded-3 shadow-sm">
                                <h5 class="fw-bold"><i class="bi bi-card-text me-3 text-success"></i>{{ __('ui.description') }}</h5>
                                <p class="mb-0">{{ $project->description }}</p>
                            </div>

                            <!-- Recruiter Info -->
                            <div class="mb-4 p-3 bg-white border rounded-3 shadow-sm">
                                <h5 class="fw-bold"><i class="bi bi-person-badge-fill me-3 text-primary"></i>{{ __('ui.recruiter_info') }}
                                </h5>
                                <p class="mb-1"><strong>{{ __('ui.name') }}:</strong> {{ $project->recruiter->first_name }}
                                    {{ $project->recruiter->last_name }}</p>
                                <p class="mb-1"><strong>{{ __('ui.email') }}:</strong> {{ $project->recruiter->email }}</p>
                                <p class="mb-0"><strong>{{ __('ui.country') }}:</strong> {{ $project->recruiter->country ?? 'N/A' }}</p>
                            </div>

                            <!-- Suspension -->
                            @if ($project->suspend)
                                <div class="alert alert-danger mt-3 shadow-sm">
                                    <i class="bi bi-exclamation-triangle-fill me-3"></i>
                                    <strong>{{ __('ui.suspended') }}:</strong> {{ $project->suspend_reason ?? __('messages.no_reason_provided') }}
                                </div>
                            @endif

                            <div class="text-end mt-3 gap-3 d-flex">
                                <a href="{{ route('professional.project.index') }}" class="btn btn-secondary rounded-pill">
                                    <i class="bi bi-arrow-left-circle me-1"></i>{{ __('buttons.back_to_projects') }}
                                </a>

                                <button type="button" class="btn btn-primary rounded-pill px-3" data-bs-toggle="modal"
                                    data-bs-target="#requestProjectModal">
                                    <i class="bi bi-send-check me-1"></i>
                                    {{ __('buttons.request_project') }}
                                </button>

                                @include('professional.project.partials.request-project-modal')

                            </div>

                        </div>

                        <!-- Right Column: Media -->
                        <div
                            class="col-lg-5 p-4 bg-light d-flex flex-column align-items-center justify-content-start gap-4">
                            @if ($project->image)
                                <div class="w-100">
                                    <h6 class="fw-bold mb-2"><i class="bi bi-image mb-3"></i>{{ __('ui.project_image') }}</h6>
                                    <img src="{{ asset('storage/' . $project->image) }}" alt="Project Image"
                                        class="img-fluid rounded shadow-sm border">
                                </div>
                            @endif

                            @if ($project->document)
                                <div class="w-100">
                                    <h6 class="fw-bold mb-2"><i class="bi bi-file-earmark-text mb-3"></i>{{ __('ui.project_document') }}
                                    </h6>
                                    <a href="{{ asset('storage/' . $project->document) }}" target="_blank"
                                        class="btn btn-outline-primary w-100">
                                        <i class="bi bi-file-earmark-arrow-down me-1"></i>{{ __('buttons.view_document') }}
                                    </a>
                                </div>
                            @endif
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            /* ===============================
               SUBMIT PROJECT REQUEST
            ================================ */
            $('#projectRequestForm').on('submit', function(e) {
                e.preventDefault();

                let form = $(this);
                let btn = form.find('button[type="submit"]');

                btn.prop('disabled', true)
                    .html('<span class="spinner-border spinner-border-sm me-1"></span>{{ __('messages.sending') }}');

                $.ajax({
                    url: "{{ route('professional.project.request', $project->id) }}",
                    method: "POST",
                    data: form.serialize(),
                    success: function(response) {

                        btn.prop('disabled', false)
                            .html('<i class="bi bi-send-check me-1"></i>{{ __('Send Request') }}');

                        // Optional toast (if you already use showToast)
                        if (response.message) {
                            showToast(response.message, 'success');
                        }

                        $('#requestProjectModal').modal('hide');
                        form[0].reset();
                    },
                    error: function(xhr) {

                        btn.prop('disabled', false)
                            .html('<i class="bi bi-send-check me-1"></i>{{ __('Send Request') }}');

                        let message = '{{ __('messages.something_wrong') }}';

                        if (xhr.responseJSON?.message) {
                            message = xhr.responseJSON.message;
                        }

                        showToast(message, 'error');
                    }
                });
            });

            /* ===============================
               RESET FORM ON MODAL CLOSE
            ================================ */
            $('#requestProjectModal').on('hidden.bs.modal', function() {
                $('#projectRequestForm')[0].reset();
            });

        });
    </script>
@endpush
