@extends('layouts.professional')

@section('title', __('My Projects'))

@section('content')
<div class="">
    <div class="row mb-3">
        {{-- Filters --}}
        <form method="GET" id="filterForm" class="row gx-3 gy-3 align-items-center w-100">
            {{-- Search Input --}}
            <div class="col-12 col-md-4">
                <div class="input-group shadow-sm rounded-3 overflow-hidden">
                    <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="{{ __('Search projects...') }}"
                        class="form-control form-control-sm border-start-0 rounded-end-3 rounded-start-0" id="searchInput">
                </div>
            </div>

            {{-- Filters --}}
            <div class="col-12 col-md-8">
                <div class="d-flex flex-wrap justify-content-md-end gap-2">

                </div>
            </div>
        </form>
    </div>

    {{-- Project Cards --}}
    <div id="projectCards">
        @include('professional.project.partials.cards', ['projects' => $projects])
    </div>
</div>
@endsection

@push('script')
<script>
    let debounceTimer;

    function loadProjects(url = "{{ route('professional.project.index') }}") {
        $.ajax({
            url: url,
            type: "GET",
            data: $('#filterForm').serialize(),
            success: function(res) {
                $('#projectCards').html(res.html);
            },
            error: function() {
                alert('{{ __('Failed to load projects. Please try again.') }}');
            }
        });
    }

    // Auto-update on filter change
    $('#filterForm select').on('change', function() {
        loadProjects();
    });

    // Debounce search input to avoid too many AJAX calls
    $('#searchInput').on('keyup', function() {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(() => {
            loadProjects();
        }, 500); // 500ms delay
    });

    // Handle pagination links via AJAX
    $(document).on('click', '#projectCards .pagination a', function(e) {
        e.preventDefault();
        let url = $(this).attr('href');
        loadProjects(url);
    });
</script>
@endpush
