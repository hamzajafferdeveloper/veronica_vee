@extends('layouts.admin')

@section('title', 'Term of Use Page')

@section('content')
    <div class="card shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.pages.store.term-of-use') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-bold">
                        Term Of Use Content
                    </label>

                    <textarea id="editor" name="content" rows="10">
                        {{ old('content', $termsOfUse->content ?? '') }}
                    </textarea>
                </div>

                <button type="submit" class="btn btn-primary mt-3">
                    Save Save Term Of Use
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
