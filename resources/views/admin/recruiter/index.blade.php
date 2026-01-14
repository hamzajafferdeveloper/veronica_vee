@extends('layouts.admin')

@section('title', __('ui.recruiter_list'))

@section('content')

    <div class="card basic-data-table">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">{{ __('ui.all_recruiters') }}</h5>
            {{-- <a href="{{ route('recruiter.project.create') }}" class="btn btn-primary d-flex gap-2 align-items-center">
                <iconify-icon icon="icons8:plus"></iconify-icon> Create New
            </a> --}}
        </div>

        <div class="card-body">

            {{-- Filters --}}
            <form method="GET" id="filterForm" action="{{ route('admin.recruiters.index') }}"
                class="row align-items-center mb-3 gy-2 gx-2">

                {{-- LEFT SIDE: SEARCH --}}
                <div class="col-12 col-md-4">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="{{ __('ui.search_recruiters') }}" class="form-control form-control-sm shadow-sm">
                </div>

                {{-- RIGHT SIDE: FILTERS --}}
                <div class="col-12 col-md-8">
                    <div class="d-flex flex-wrap justify-content-md-end gap-2">

                        {{-- Per Page --}}
                        <select name="per_page" class="custom-select-sm border shadow-sm py-1 px-3">
                            @foreach ([5, 10, 20, 50, 100] as $size)
                                <option value="{{ $size }}"
                                    {{ request('per_page', 10) == $size ? 'selected' : '' }}>
                                    {{ $size }}{{ __('ui.per_page') }}
                                </option>
                            @endforeach
                        </select>

                        {{-- Sort By --}}
                        <select name="sort_by" class="custom-select-sm border shadow-sm py-1 px-3">
                            <option value="id" {{ request('sort_by') == 'id' ? 'selected' : '' }}>ID</option>
                            <option value="phone" {{ request('sort_by') == 'phone' ? 'selected' : '' }}>Phone</option>
                            <option value="address" {{ request('sort_by') == 'address' ? 'selected' : '' }}>Address</option>
                            <option value="created_at" {{ request('sort_by') == 'created_at' ? 'selected' : '' }}>
                                {{ __('ui.registered_on') }}
                            </option>
                        </select>

                        {{-- Sort Direction --}}
                        <select name="sort_direction" class="custom-select-sm border shadow-sm py-1 px-3">
                            <option value="asc" {{ request('sort_direction') == 'asc' ? 'selected' : '' }}>{{ __('ui.asc') }}</option>
                            <option value="desc" {{ request('sort_direction') == 'desc' ? 'selected' : '' }}>{{ __('ui.desc') }}
                            </option>
                        </select>

                    </div>
                </div>
            </form>


            {{-- Data Table --}}
            <div id="projectTable">
                @include('admin.recruiter.partials.table', ['recruiters' => $recruiters])
            </div>

        </div>
    </div>

    <!-- Bootstrap Toast Container -->
    <div class="position-fixed top-0 end-0 p-3" style="z-index: 1055">
        <div id="projectToast" class="toast align-items-center text-white bg-success border-0" role="alert"
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

            function loadTable(url = "{{ route('admin.recruiters.index') }}") {
                $.ajax({
                    url: url,
                    type: "GET",
                    data: $('#filterForm').serialize(),
                    beforeSend: function() {
                        $('#projectTable').addClass('opacity-50');
                    },
                    success: function(res) {
                        // IMPORTANT: res.html must exist
                        $('#projectTable').html(res.html);
                        $('#projectTable').removeClass('opacity-50');

                        window.history.replaceState({}, '', url + '?' + $('#filterForm').serialize());
                    },
                    error: function(xhr) {
                        console.error('AJAX Error:', xhr.responseText);
                        $('#projectTable').removeClass('opacity-50');
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
