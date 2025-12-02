@extends('layouts.app')

@section('title', 'Login Page')

@section('content')
    <section class="mt-5">

        <div class="container">
            <div class="row justify-content-between align-items-center">

                {{-- Login Form --}}
                <div class="col-lg-4">
                    <div class="card border-0 shadow-lg rounded-4">
                        <div class="card-body p-4">

                            <h4 class="mb-3 fw-bold">Log In</h4>

                            <form id="loginForm" class="needs-validation" novalidate>
                                @csrf

                                <div class="mb-3">
                                    <label for="loginEmail" class="form-label">Email*</label>
                                    <input type="email" name="email" class="form-control" id="loginEmail"
                                           placeholder="Enter your email" required>
                                    <div class="invalid-feedback"></div>
                                </div>

                                <div class="mb-3">
                                    <label for="loginPassword" class="form-label d-flex">
                                        Password
                                        <a href="#" class="ms-auto text-muted fw-normal fs-12">Forget password?</a>
                                    </label>
                                    <div class="position-relative">
                                        <input type="password" name="password" class="form-control pe-5"
                                               id="loginPassword"
                                               placeholder="Enter your password">
                                        <button class="btn btn-link p-0 position-absolute bottom-0 end-0 mb-1 me-3"
                                                type="button" onclick="togglePassword('loginPassword', 'loginEye')">
                                            <i id="loginEye" class="bi bi-eye"></i>
                                        </button>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>

                                <div class="form-check mb-3 fs-12">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                    <label class="form-check-label" for="remember">Remember password?</label>
                                </div>

                                <button type="submit" class="btn btn-dark w-100">Log In</button>

                                <div id="loginMessage" class="mt-2"></div>

                            </form>

                        </div>
                    </div>
                </div>

                {{-- Registration Form --}}
                <div class="col-lg-7">
                    <div class="card border-0 shadow-lg rounded-4">
                        <div class="card-body p-4">

                            <h4 class="mb-3 fw-bold">Create your account to get started</h4>

                            <form id="registerForm" class="needs-validation row gy-3" novalidate>
                                @csrf

                                <div class="col-12">
                                    <label for="registerEmail" class="form-label">Email*</label>
                                    <input type="email" name="email" class="form-control" id="registerEmail"
                                           placeholder="Enter your email" required>
                                    <div class="invalid-feedback"></div>
                                </div>

                                <div class="col-12">
                                    <label for="registerPassword" class="form-label">Password*</label>
                                    <div class="position-relative">
                                        <input type="password" name="password" class="form-control pe-5"
                                               id="registerPassword"
                                               placeholder="Enter your password" required>
                                        <button class="btn btn-link p-0 position-absolute bottom-0 end-0 mb-1 me-3"
                                                type="button"
                                                onclick="togglePassword('registerPassword', 'registerEye')">
                                            <i id="registerEye" class="bi bi-eye"></i>
                                        </button>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="firstName" class="form-label">First Name*</label>
                                    <input type="text" name="first_name" class="form-control" id="firstName"
                                           placeholder="First Name" required>
                                    <div class="invalid-feedback"></div>
                                </div>

                                <div class="col-md-6">
                                    <label for="lastName" class="form-label">Last Name*</label>
                                    <input type="text" name="last_name" class="form-control" id="lastName"
                                           placeholder="Last Name" required>
                                    <div class="invalid-feedback"></div>
                                </div>

                                <div class="col-md-6">
                                    <label for="country" class="form-label">Country</label>
                                    <select name="country" class="form-select" id="country">
                                        <option value="US">United States</option>
                                        <option value="UK">United Kingdom</option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label for="postalCode" class="form-label">Postal Code</label>
                                    <input type="text" name="postal_code" class="form-control" id="postalCode"
                                           placeholder="Postal Code">
                                </div>

                                <div class="col-12 fs-14">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="type" value="recruiter"
                                               id="op1">
                                        <label class="form-check-label" for="op1">Recruiter</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="type" value="professional"
                                               id="op2">
                                        <label class="form-check-label" for="op2">Professional</label>
                                    </div>
                                    <div class="invalid-feedback"></div>
                                </div>

                                <div class="col-12 fs-14">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="terms" id="terms">
                                        <label class="form-check-label" for="terms">I agree to the <a href="#">Terms of
                                                Use</a> and <a href="#">Privacy Policy</a></label>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="age" id="age">
                                        <label class="form-check-label" for="age">I am at least 16 years old</label>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="btn btn-dark w-100">Submit</button>
                                </div>

                                <div id="registerMessage" class="mt-2"></div>

                            </form>

                        </div>
                    </div>
                </div>

            </div>
        </div>

    </section>
@endsection

@push('script')
    <script>
        // Function to show toast for general messages
        function showToast(message, type = 'danger') {
            let toastHtml = `
        <div class="toast align-items-center text-bg-${type} border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">${message}</div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>`;

            let toastContainer = $('#toastContainer');
            if (!toastContainer.length) {
                $('body').append('<div id="toastContainer" class="position-fixed bottom-0 end-0 p-3" style="z-index: 11"></div>');
                toastContainer = $('#toastContainer');
            }
            toastContainer.append(toastHtml);
            let lastToast = toastContainer.find('.toast').last()[0];
            new bootstrap.Toast(lastToast).show();
        }

        // Handle AJAX form submission
        function ajaxFormSubmit(formId, url) {
            let form = $(formId);
            form.on('submit', function (e) {
                e.preventDefault();
                let btn = form.find('button[type="submit"]');
                btn.prop('disabled', true);

                // Clear previous field errors
                form.find('.invalid-feedback').text('');
                form.find('.is-invalid').removeClass('is-invalid');

                $.ajax({
                    url: url,
                    method: 'POST',
                    data: form.serialize(),
                    success: function (response) {
                        btn.prop('disabled', false);

                        showToast(response.message || 'Success!', response.success ? 'success' : 'danger');

                        if (response.success && response.redirect) {
                            window.location.href = response.redirect;
                        }
                    },
                    error: function (xhr) {
                        btn.prop('disabled', false);
                        let errors = xhr.responseJSON?.errors || {};
                        let generalErrors = [];

                        // Loop through errors
                        for (let key in errors) {
                            let field = form.find(`[name="${key}"]`);
                            if (field.length) {
                                // Field-specific error
                                field.addClass('is-invalid');
                                field.siblings('.invalid-feedback').text(errors[key][0]);
                            } else {
                                // General errors
                                generalErrors.push(errors[key][0]);
                            }
                        }

                        // If response has message
                        if (xhr.responseJSON?.message) {
                            generalErrors.unshift(xhr.responseJSON.message);
                        }

                        if (generalErrors.length) {
                            showToast(generalErrors.join('<br>'), 'danger');
                        }
                    }
                });
            });
        }

        // Initialize forms
        ajaxFormSubmit('#loginForm', "{{ route('login') }}");
        ajaxFormSubmit('#registerForm', "{{ route('register') }}");

        // Toggle password visibility
        function togglePassword(inputId, eyeId) {
            let input = document.getElementById(inputId);
            let eye = document.getElementById(eyeId);
            if (input.type === 'password') {
                input.type = 'text';
                eye.classList.replace('bi-eye', 'bi-eye-slash');
            } else {
                input.type = 'password';
                eye.classList.replace('bi-eye-slash', 'bi-eye');
            }
        }
    </script>

@endpush
