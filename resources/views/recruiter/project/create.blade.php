@extends('layouts.recruiter')

@section('title', 'Model Dashboard')

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
            <h5 class="card-title mb-0">Create New Project</h5>
        </div>

        <div class="card-body pt-3">
            <form id="projectForm" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Project Image</label>
                    <input type="file" name="image" class="form-control pt-1" accept="image/*" id="imageInput">
                    <img id="imagePreview" class="mt-2" style="max-height: 150px; display:none;">
                    <span class="text-danger small error-text" data-error="image"></span>
                </div>

                <div class="mb-3">
                    <label class="form-label">Project Title</label>
                    <input type="text" name="title" class="form-control" placeholder="Enter project title">
                    <span class="text-danger small error-text" data-error="title"></span>
                </div>

                <div class="mb-3">
                    <label class="form-label">Budget</label>
                    <input type="number" name="budget" class="form-control" placeholder="Enter budget">
                    <span class="text-danger small error-text" data-error="budget"></span>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Category</label>

                    <!-- Custom input always visible -->
                    <div id="categorySelector" class="custom-category-box">
                        <span id="categoryText">Select Category</span>
                        <i class="bi bi-chevron-down"></i>
                    </div>

                    <!-- Real Select2 dropdown (hidden) -->
                    <select id="categorySelect" name="category_id" class="select2-hidden select2">
                        <option value="">Select Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>

                    <span class="text-danger small error-text" data-error="category_id"></span>
                </div>

                <div class="mb-3">
                    <label class="form-label">Deadline</label>
                    <input type="date" name="deadline" class="form-control">
                    <span class="text-danger small error-text" data-error="deadline"></span>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="4" placeholder="Project details..."></textarea>
                    <span class="text-danger small error-text" data-error="description"></span>
                </div>

                <div class="mb-3">
                    <label class="form-label">Project Document</label>
                    <input type="file" name="document" class="form-control pt-1" id="documentInput">
                    <span id="documentName" class="small text-muted mt-1 d-block"></span>
                    <span class="text-danger small error-text" data-error="document"></span>
                </div>

                <button type="submit" id="submitBtn" class="btn btn-primary">
                    <span class="submit-text">Submit</span>
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


            // Initialize actual hidden select2
            $('#categorySelect').select2({
                dropdownParent: $('body'),
                placeholder: "Select Category",
                width: '100%',
            });

            // Clicking visible box opens hidden select2
            $('#categorySelector').on('click', function() {
                $('#categorySelect').select2('open');
            });

            // Update visible text when selected
            $('#categorySelect').on('change', function() {
                let text = $("#categorySelect option:selected").text();
                $('#categoryText').text(text !== "" ? text : "Select Category");
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

                // Clear previous errors
                $(".error-text").text('');

                $("#submitBtn").attr("disabled", true);
                $(".submit-text").addClass("d-none");
                $("#loader").removeClass("d-none");

                let formData = new FormData(this);

                $.ajax({
                    url: "{{ route('recruiter.project.store') }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $("#toastMessage").text("Project created successfully!");
                        $("#projectToast").removeClass("bg-danger").addClass("bg-success");
                        toast.show();
                        $("#projectForm")[0].reset();
                        $('.select2').val(null).trigger('change');
                        $("#imagePreview").hide();
                        $("#documentName").text('');

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
                            $("#toastMessage").text("Something went wrong! Please try again.");
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
