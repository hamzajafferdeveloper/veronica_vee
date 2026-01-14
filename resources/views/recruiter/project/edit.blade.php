@extends('layouts.recruiter')

@section('title', __('ui.edit_project'))

@section('content')

    <style>
        .custom-category-box {
            border: 1px solid #ced4da;
            padding: 8px 12px;
            border-radius: 30px;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #fff;
        }

        .custom-category-box:hover {
            border-color: #999;
        }

        .custom-category-box i {
            font-size: 14px;
            opacity: 0.7;
        }

        .select2-container--default .select2-selection--single {
            display: none;
        }

        .select2-container--open .select2-dropdown--below {
            border-top: 1px solid #ccc;
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;
        }

        .select2-search--dropdown .select2-search__field {
            padding-left: 20px !important;
        }
    </style>

    <div class="card shadow-sm border-0">
        <div class="card-header bg-white border-0 pb-0">
            <h5 class="card-title mb-0">{{ __('ui.edit_project') }}</h5>
        </div>

        <div class="card-body pt-3">
            <form id="projectForm" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">{{ __('ui.project_image') }}</label>
                    <input type="file" name="image" class="form-control pt-1" accept="image/*" id="imageInput">
                    @if ($project->image)
                        <img id="imagePreview" class="mt-2" src="{{ asset('storage/' . $project->image) }}"
                            style="max-height: 150px;">
                    @else
                        <img id="imagePreview" class="mt-2" style="max-height: 150px; display:none;">
                    @endif
                    <span class="text-danger small error-text" data-error="image"></span>
                </div>

                <div class="mb-3">
                    <label class="form-label">{{ __('ui.project_title') }}</label>
                    <input type="text" name="title" value="{{ old('title', $project->title) }}" class="form-control"
                        placeholder="{{ __('ui.enter_project_title') }}">
                    <span class="text-danger small error-text" data-error="title"></span>
                </div>

                <div class="mb-3">
                    <label class="form-label">{{ __('ui.budget') }}</label>
                    <input type="number" name="budget" value="{{ old('budget', $project->budget) }}" class="form-control"
                        placeholder="{{ __('ui.enter_budget') }}">
                    <span class="text-danger small error-text" data-error="budget"></span>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">{{ __('ui.category') }}</label>

                    <!-- Custom input always visible -->
                    <div id="categorySelector" class="custom-category-box">
                        <span id="categoryText">{{ $project->category->name ?? __('Select Category') }}</span>
                        <i class="bi bi-chevron-down"></i>
                    </div>

                    <!-- Real Select2 dropdown (hidden) -->
                    <select id="categorySelect" name="category_id" class="select2-hidden select2">
                        <option value="">{{ __('ui.select_category') }}</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ $project->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>

                    <span class="text-danger small error-text" data-error="category_id"></span>
                </div>

                <div class="mb-3">
                    <label class="form-label">{{ __('ui.deadline') }}</label>
                    <input type="date" name="deadline" value="{{ old('deadline', $project->deadline) }}"
                        class="form-control">
                    <span class="text-danger small error-text" data-error="deadline"></span>
                </div>

                <div class="mb-3">
                    <label class="form-label">{{ __('ui.description') }}</label>
                    <textarea name="description" class="form-control" rows="4" placeholder="{{ __('ui.project_details') }}">{{ old('description', $project->description) }}</textarea>
                    <span class="text-danger small error-text" data-error="description"></span>
                </div>

                <div class="mb-3">
                    <label class="form-label">{{ __('ui.project_document') }}</label>
                    <input type="file" name="document" class="form-control pt-1" id="documentInput">
                    @if ($project->document)
                        <span id="documentName" class="small text-muted mt-1 d-block">{{ $project->document }}</span>
                    @else
                        <span id="documentName" class="small text-muted mt-1 d-block"></span>
                    @endif
                    <span class="text-danger small error-text" data-error="document"></span>
                </div>

                <button type="submit" id="submitBtn" class="btn btn-primary">
                    <span class="submit-text">{{ __('buttons.update') }}</span>
                    <span class="spinner-border spinner-border-sm d-none" id="loader"></span>
                </button>
            </form>
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

            // Initialize Select2
            $('#categorySelect').select2({
                dropdownParent: $('body'),
                placeholder: "{{ __('ui.select_category') }}",
                width: '100%',
            });

            // Clicking visible box opens hidden select2
            $('#categorySelector').on('click', function() {
                $('#categorySelect').select2('open');
            });

            // Update visible text when selected
            $('#categorySelect').on('change', function() {
                let text = $("#categorySelect option:selected").text();
                $('#categoryText').text(text !== "" ? text : "{{ __('ui.select_category') }}");
            });

            // Image preview
            $("#imageInput").change(function() {
                const reader = new FileReader();
                reader.onload = function(e) {
                    $("#imagePreview").attr('src', e.target.result).show();
                };
                reader.readAsDataURL(this.files[0]);
            });

            // Document file name display
            $("#documentInput").change(function() {
                const fileName = this.files[0] ? this.files[0].name : '';
                $("#documentName").text(fileName);
            });

            var toastEl = document.getElementById('projectToast');
            var toast = new bootstrap.Toast(toastEl);

            $("#projectForm").on("submit", function(e) {
                e.preventDefault();

                $(".error-text").text('');
                $("#submitBtn").attr("disabled", true);
                $(".submit-text").addClass("d-none");
                $("#loader").removeClass("d-none");

                let formData = new FormData(this);

                $.ajax({
                    url: "{{ route('recruiter.project.update', $project->slug) }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $("#toastMessage").text("{{ __('messages.project_updated') }}");
                        $("#projectToast").removeClass("bg-danger").addClass("bg-success");
                        toast.show();

                        setTimeout(function() {
                            window.location.href =
                                "{{ route('recruiter.project.index') }}";
                        }, 700);
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            $.each(errors, function(field, messages) {
                                $(`.error-text[data-error="${field}"]`).text(messages[
                                    0]);
                            });
                        } else {
                            $("#toastMessage").text("{{ __('messages.something_wrong') }}");
                            $("#projectToast").removeClass("bg-success").addClass("bg-danger");
                            toast.show();
                        }
                    },
                    complete: function() {
                        $("#submitBtn").attr("disabled", false);
                        $(".submit-text").removeClass("d-none");
                        $("#loader").addClass("d-none");
                    }
                });
            });
        });
    </script>
@endpush
