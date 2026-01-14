@extends('layouts.recruiter')

@section('title', __('ui.project_requests'))

@section('content')

    <div class="card shadow-sm border-0">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold">{{ __('ui.project_requests') }}</h5>
        </div>

        <div class="card-body">

            <!-- Filter Form -->
            <form id="filterForm" class="row g-3 align-items-end mb-4">

                <!-- Search -->
                <div class="col-md-6">
                    <label class="form-label fw-semibold">{{ __('ui.search') }}</label>
                    <div class="input-group">
                        <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                            placeholder="{{ __('ui.project_request_search_placeholder') }}">
                    </div>
                </div>

                <!-- Status Filter -->
                <div class="col-md-3">
                    <label class="form-label fw-semibold">{{ __('ui.status') }}</label>
                    <select name="status" class="form-select">
                        <option value="">{{ __('ui.all_status') }}</option>
                        @foreach (['pending', 'accepted', 'hired', 'rejected'] as $status)
                            <option value="{{ $status }}" @selected(request('status') === $status)>
                                {{ __("ui." . $status) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Reset Button -->
                <div class="col-md-3">
                    <button type="button" id="resetFilter" class="btn btn-outline-secondary w-100">
                        {{ __('buttons.reset') }}
                    </button>
                </div>

            </form>

            <!-- Table Container -->
            <div id="requestsContainer">
                @include('recruiter.project.partials.requests-table', ['requests' => $requests])
            </div>

        </div>
    </div>

@endsection

@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const filterForm = document.getElementById('filterForm');

            // Function to fetch filtered requests via AJAX
            function fetchRequests() {
                const formData = new FormData(filterForm);
                const params = new URLSearchParams(formData).toString();

                fetch("{{ route('recruiter.project.requests') }}?" + params, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(res => res.text())
                    .then(html => {
                        document.getElementById('requestsContainer').innerHTML = html;
                    })
                    .catch(err => console.error(err));
            }

            // Auto-submit on status change
            filterForm.querySelector('select[name="status"]').addEventListener('change', fetchRequests);

            // Auto-submit on search input after 500ms debounce
            let searchTimeout;
            filterForm.querySelector('input[name="search"]').addEventListener('keyup', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(fetchRequests, 500);
            });

            // Reset filter
            document.getElementById('resetFilter').addEventListener('click', function() {
                filterForm.reset();
                fetchRequests();
            });

            // Handle AJAX pagination click
            document.addEventListener('click', function(e) {
                if (e.target.closest('.pagination a')) {
                    e.preventDefault();
                    const url = e.target.closest('a').href;
                    fetch(url, {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        })
                        .then(res => res.text())
                        .then(html => {
                            document.getElementById('requestsContainer').innerHTML = html;
                        });
                }
            });

        });
    </script>
@endpush
