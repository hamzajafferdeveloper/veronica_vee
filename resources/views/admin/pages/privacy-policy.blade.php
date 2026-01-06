@extends('layouts.admin')

@section('title', 'Privacy Policy Page')

@section('content')
    <div class="card shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.pages.store.privacy-policy') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-bold">
                        Privacy Policy Content
                    </label>

                    <textarea id="editor" name="content" rows="10">
                        {{ old('content', $privacyPolicy->content ?? '') }}
                    </textarea>
                </div>

                <button type="submit" class="btn btn-primary mt-3">
                    Save Privacy Policy
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
