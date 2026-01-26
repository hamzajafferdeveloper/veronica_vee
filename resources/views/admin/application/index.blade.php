@extends('layouts.admin')

@section('title', __('ui.all_applications'))

@section('content')

    <div class="card basic-data-table">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">{{ __('ui.all_applications') ?? 'All Applications' }}</h5>
        </div>

        <div class="card-body">

            {{-- Filters --}}
            <form method="GET" id="filterForm" action="{{ route('admin.applications.index') }}"
                class="row align-items-center mb-3 gy-2 gx-2">

                {{-- LEFT SIDE: SEARCH --}}
                <div class="col-12 col-md-4">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="{{ __('ui.search_applications') ?? 'Search applications...' }}" class="form-control form-control-sm shadow-sm">
                </div>

                {{-- RIGHT SIDE: FILTERS --}}
                <div class="col-12 col-md-8">
                    <div class="d-flex flex-wrap justify-content-md-end gap-2">

                        {{-- Gender Filter --}}
                        <select name="gender" class="custom-select-sm border shadow-sm py-1 px-3">
                            <option value="all" {{ request('gender', 'all') == 'all' ? 'selected' : '' }}>{{ __('ui.all_genders') ?? 'All Genders' }}</option>
                            <option value="male" {{ request('gender') == 'male' ? 'selected' : '' }}>{{ __('ui.male') ?? 'Male' }}</option>
                            <option value="female" {{ request('gender') == 'female' ? 'selected' : '' }}>{{ __('ui.female') ?? 'Female' }}</option>
                            <option value="other" {{ request('gender') == 'other' ? 'selected' : '' }}>{{ __('ui.other') ?? 'Other' }}</option>
                        </select>

                        {{-- Per Page --}}
                        <select name="per_page" class="custom-select-sm border shadow-sm py-1 px-3">
                            @foreach ([5, 10, 20, 50, 100] as $size)
                                <option value="{{ $size }}"
                                    {{ request('per_page', 10) == $size ? 'selected' : '' }}>
                                    {{ $size }}{{ __('ui.per_page') ?? ' per page' }}
                                </option>
                            @endforeach
                        </select>

                        {{-- Sort By --}}
                        <select name="sort_by" class="custom-select-sm border shadow-sm py-1 px-3">
                            <option value="created_at" {{ request('sort_by') == 'created_at' ? 'selected' : '' }}>{{ __('ui.registered_on') ?? 'Applied On' }}</option>
                            <option value="full_name" {{ request('sort_by') == 'full_name' ? 'selected' : '' }}>{{ __('ui.name') ?? 'Name' }}</option>
                            <option value="email" {{ request('sort_by') == 'email' ? 'selected' : '' }}>{{ __('ui.email') ?? 'Email' }}</option>
                            <option value="gender" {{ request('sort_by') == 'gender' ? 'selected' : '' }}>{{ __('ui.gender') ?? 'Gender' }}</option>
                        </select>

                        {{-- Sort Direction --}}
                        <select name="sort_direction" class="custom-select-sm border shadow-sm py-1 px-3">
                            <option value="desc" {{ request('sort_direction', 'desc') == 'desc' ? 'selected' : '' }}>{{ __('ui.desc') ?? 'Descending' }}</option>
                            <option value="asc" {{ request('sort_direction') == 'asc' ? 'selected' : '' }}>{{ __('ui.asc') ?? 'Ascending' }}</option>
                        </select>

                    </div>
                </div>
            </form>


            {{-- Data Table --}}
            <div id="applicationTable">
                @include('admin.application.partials.table', ['applications' => $applications])
            </div>

        </div>
    </div>

    <!-- Bootstrap Toast Container -->
    <div class="position-fixed top-0 end-0 p-3" style="z-index: 1055">
        <div id="applicationToast" class="toast align-items-center text-white bg-success border-0" role="alert"
            aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body" id="toastMessage"></div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div>
    </div>

@endsection

@push('script')
    <script>
        $(document).ready(function() {

            let typingTimer;
            let debounceDelay = 500;

            function loadTable(url = "{{ route('admin.applications.index') }}") {
                $.ajax({
                    url: url,
                    type: "GET",
                    data: $('#filterForm').serialize(),
                    beforeSend: function() {
                        $('#applicationTable').addClass('opacity-50');
                    },
                    success: function(res) {
                        $('#applicationTable').html(res.html);
                        $('#applicationTable').removeClass('opacity-50');

                        window.history.replaceState({}, '', url + '?' + $('#filterForm').serialize());
                    },
                    error: function(xhr) {
                        console.error('AJAX Error:', xhr.responseText);
                        $('#applicationTable').removeClass('opacity-50');
                    }
                });
            }

            /* ===== AUTO FILTER (SELECTS) ===== */
            $('#filterForm').on('change', 'select', function() {
                loadTable();
            });

            /* ===== AUTO FILTER (SEARCH with debounce) ===== */
            $('#filterForm').on('keyup', 'input[name="search"]', function() {
                clearTimeout(typingTimer);
                typingTimer = setTimeout(function() {
                    loadTable();
                }, debounceDelay);
            });

            /* ===== PAGINATION ===== */
            $(document).on('click', '.pagination a', function(e) {
                e.preventDefault();
                loadTable($(this).attr('href'));
            });

        });
    </script>
@endpush
