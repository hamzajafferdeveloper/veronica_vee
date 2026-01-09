@extends('layouts.admin')

@section('title', 'Professional List')

@section('content')

    <div class="card basic-data-table">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">All Professionals</h5>
            {{-- <button data-bs-toggle="modal" data-bs-target="#createProfessionalModal" class="btn btn-primary d-flex gap-2 align-items-center">
                <iconify-icon icon="icons8:plus"></iconify-icon> Create New
            </button> --}}
        </div>

        <div class="card-body">

            {{-- Filters --}}
            <form method="GET" id="filterForm" action="{{ route('admin.professionals.index') }}"
                class="row align-items-center mb-3 gy-2 gx-2">

                {{-- LEFT SIDE: SEARCH --}}
                <div class="col-12 col-md-4">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Search professionals..." class="form-control form-control-sm shadow-sm">
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
                            <option value="ordering" {{ request('sort_by') == 'ordering' ? 'selected' : '' }}>Order</option>
                            <option value="age" {{ request('sort_by') == 'age' ? 'selected' : '' }}>Age</option>
                            <option value="gender" {{ request('sort_by') == 'gender' ? 'selected' : '' }}>Gender</option>
                            <option value="height" {{ request('sort_by') == 'height' ? 'selected' : '' }}>Height</option>
                            <option value="weight" {{ request('sort_by') == 'weight' ? 'selected' : '' }}>Weight</option>
                            <option value="location" {{ request('sort_by') == 'location' ? 'selected' : '' }}>Location
                            </option>
                            <option value="created_at" {{ request('sort_by') == 'created_at' ? 'selected' : '' }}>
                                Registered On
                            </option>
                        </select>

                        {{-- Sort Direction --}}
                        <select name="sort_direction" class="custom-select-sm border shadow-sm py-1 px-3">
                            <option value="asc" {{ request('sort_direction') == 'asc' ? 'selected' : '' }}>Asc</option>
                            <option value="desc" {{ request('sort_direction') == 'desc' ? 'selected' : '' }}>Desc
                            </option>
                        </select>

                    </div>
                </div>
            </form>


            {{-- Data Table --}}
            <div id="projectTable">
                @include('admin.professional.partials.table', ['professionals' => $professionals])
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

    @include('admin.professional.partials.create-modal')
    @include('admin.professional.partials.edit-modal')

@endsection

@push('script')
    <script>
        $(document).ready(function() {

            let typingTimer;
            let debounceDelay = 500;

            function loadTable(url = "{{ route('admin.professionals.index') }}") {
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

            $(document).ready(function() {

                // Show button only for the input being edited
                $(document).on('focus', '.orderingInput', function() {
                    $(this).closest('form').find('.orderingBtn').removeClass('d-none');
                });

                // Hide button if input loses focus and value hasn't changed
                $(document).on('blur', '.orderingInput', function() {
                    let form = $(this).closest('form');
                    let button = form.find('.orderingBtn');
                    let inputVal = $(this).val();
                    let originalVal = $(this).attr('value');

                    if (inputVal == originalVal) {
                        button.addClass('d-none');
                    }
                });

                // AJAX submit per row
                $(document).on('submit', '.orderingForm', function(e) {
                    e.preventDefault();

                    let form = $(this);
                    let button = form.find('.orderingBtn');

                    button.prop('disabled', true).html(
                        '<span class="spinner-border spinner-border-sm"></span>');

                    $.ajax({
                        url: "{{ route('admin.professionals.update-order') }}",
                        method: "POST",
                        data: form.serialize(),
                        success: function(response) {
                            button
                                .removeClass('btn-primary')
                                .addClass('btn-success')
                                .html('<i class="bi bi-check-lg"></i>');

                            // Update the input value attribute to the new one
                            form.find('.orderingInput').attr('value', form.find(
                                '.orderingInput').val());

                            setTimeout(() => {
                                button
                                    .removeClass('btn-success')
                                    .addClass('btn-primary')
                                    .html('<i class="bi bi-check2-circle"></i>')
                                    .prop('disabled', false)
                                    .addClass(
                                    'd-none'); // Hide button after success
                            }, 1500);

                            // Optionally reload table for updated ordering
                            // loadTable();
                        },
                        error: function() {
                            alert('Something went wrong');
                            button.prop('disabled', false).html(
                                '<i class="bi bi-check2-circle"></i>');
                        }
                    });
                });
            });
        });
    </script>
@endpush
