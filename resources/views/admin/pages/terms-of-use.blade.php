@extends('layouts.admin')

@section('title', __('ui.terms_of_use_page'))

@section('content')
    <div class="card shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.pages.store.term-of-use') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-bold">
                        {{ __('ui.terms_of_use_content') }}
                    </label>

                    <textarea id="editor" name="content" rows="10">
                        {{ old('content', $termsOfUse->content ?? '') }}
                    </textarea>
                </div>

                <button type="submit" class="btn btn-primary mt-3">
                    {{ __('buttons.save_terms_of_use') }}
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
