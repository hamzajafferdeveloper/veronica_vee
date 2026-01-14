@extends('layouts.admin')

@section('title', __('ui.privacy_policy_page'))

@section('content')
    <div class="card shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.pages.store.privacy-policy') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-bold">
                        {{ __('ui.privacy_policy_content') }}
                    </label>

                    <textarea id="editor" name="content" rows="10">
                        {{ old('content', $privacyPolicy->content ?? '') }}
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
        });
    </script>
@endpush
