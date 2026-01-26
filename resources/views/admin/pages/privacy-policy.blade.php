@extends('layouts.admin')

@section('title', __('ui.privacy_policy_page'))

@section('content')
    <div class="card shadow-sm">
        <div class="card-body">

            {{-- Language Switch --}}
            <form method="GET" class="mb-3">
                <label class="form-label fw-bold">
                    {{ __('ui.language') }}
                </label>
                <select name="lang"
                        class="form-select w-auto"
                        onchange="this.form.submit()">
                    <option value="en" {{ $lang === 'en' ? 'selected' : '' }}>English</option>
                    <option value="es" {{ $lang === 'es' ? 'selected' : '' }}>Español</option>
                </select>
            </form>

            <form method="POST" action="{{ route('admin.pages.store.privacy-policy') }}">
                @csrf

                <input type="hidden" name="lang" value="{{ $lang }}">

                <div class="mb-3">
                    <label class="form-label fw-bold">
                        {{ __('ui.privacy_policy_content') }}
                        <span class="text-muted">
                            ({{ strtoupper($lang) }})
                        </span>
                    </label>

                    <textarea id="editor" name="content" rows="10">
                        {{ old('content', $translation?->content ?? $privacyPolicy->content ?? '') }}
                    </textarea>
                </div>

                <button type="submit" class="btn btn-primary mt-3">
                    {{ __('buttons.save_privacy_policy') }}
                </button>
            </form>

        </div>
    </div>
@endsection

@push('script')
    <script>
        tinymce.init({
            selector: '#editor',
            height: 400,
            menubar: false,
            plugins: 'lists link code',
            toolbar: 'undo redo | bold italic | alignleft aligncenter alignright | bullist numlist | link | code'
        });
    </script>
@endpush
