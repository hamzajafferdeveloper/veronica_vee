@extends('layouts.recruiter')

@section('title', __('ui.projects'))

@section('content')

    <div class="card basic-data-table">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">{{ __('ui.all_projects') }}</h5>
            <a href="{{ route('recruiter.project.create') }}" class="btn btn-primary d-flex gap-2 align-items-center">
                <iconify-icon icon="icons8:plus"></iconify-icon> {{ __('buttons.create_new') }}
            </a>
        </div>

        <div class="card-body">

            {{-- Filters --}}
            <form method="GET" id="filterForm" class="row align-items-center mb-3 gy-2 gx-2">

                {{-- LEFT SIDE: SEARCH --}}
                <div class="col-12 col-md-4">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="{{ __('ui.search') }}"
                        class="form-control form-control-sm shadow-sm">
                </div>

                {{-- RIGHT SIDE: FILTERS --}}
                <div class="col-12 col-md-8">
                    <div class="d-flex flex-wrap justify-content-md-end gap-2">

                        {{-- Per Page --}}
                        <select name="per_page" class="custom-select-sm border shadow-sm py-1 px-3">
                            @foreach ([5, 10, 20, 50, 100] as $size)
                                <option value="{{ $size }}"
                                    {{ request('per_page', 10) == $size ? 'selected' : '' }}>
                                    {{ $size }}/page
                                </option>
                            @endforeach
                        </select>

                        {{-- Sort By --}}
                        <select name="sort_by" class="custom-select-sm border shadow-sm py-1 px-3">
                            <option value="id" {{ request('sort_by') == 'id' ? 'selected' : '' }}>ID</option>
                            <option value="title" {{ request('sort_by') == 'title' ? 'selected' : '' }}>{{ __('ui.title') }}</option>
                            <option value="budget" {{ request('sort_by') == 'budget' ? 'selected' : '' }}>{{ __('ui.budget') }}</option>
                            <option value="deadline" {{ request('sort_by') == 'deadline' ? 'selected' : '' }}>{{ __('ui.deadline') }}
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
                @include('recruiter.project.partials.table', ['projects' => $projects])
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
        var toastEl = document.getElementById('projectToast');
        var toast = new bootstrap.Toast(toastEl);

        function loadTable() {
            $.ajax({
                url: "{{ route('recruiter.project.index') }}",
                type: "GET",
                data: $('#filterForm').serialize(),
                success: function(res) {
                    $('#projectTable').html(res.html);
                }
            });
        }

        // Auto-update on filter change
        $('#filterForm input, #filterForm select').on('change keyup', function() {
            loadTable();
        });

        // Handle pagination via AJAX
        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            let url = $(this).attr('href');

            $.ajax({
                url: url,
                type: "GET",
                data: $('#filterForm').serialize(),
                success: function(res) {
                    $('#projectTable').html(res.html);
                }
            });
        });


        $(document).on('click', '.btn-delete-project', function(e) {
            e.preventDefault();
            let url = $(this).data('url');

            Swal.fire({
                title: '{{ __('messages.are_you_sure') }}',
                text: "{{ __('messages.delete_confirm') }}",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: '{{ __('buttons.yes_delete') }}',
                cancelButtonText: '{{ __('buttons.cancel') }}',
                reverseButtons: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(res) {
                            if (res.status) {
                                loadTable(); // Refresh table
                                $("#toastMessage").text(res.message);
                                $("#projectToast").removeClass("bg-danger").addClass(
                                    "bg-success");
                                toast.show();
                            } else {
                                $("#toastMessage").text(
                                    '{{ __('messages.something_wrong') }}');
                                $("#projectToast").removeClass("bg-success").addClass(
                                    "bg-danger");
                                toast.show();
                            }
                        },
                        error: function() {
                            $("#toastMessage").text('{{ __('messages.something_wrong') }}');
                            $("#projectToast").removeClass("bg-success").addClass("bg-danger");
                            toast.show();
                        }
                    });
                }
            });
        });
    </script>
@endpush
