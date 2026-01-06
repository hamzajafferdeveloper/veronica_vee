@extends('layouts.app')

@section('title', $page->title)

@section('content')
    <div class="container py-5">
        <h1 class="mb-4">{{ $page->title }}</h1>

        <div class="page-content">
            {!! $page->content !!}
        </div>
    </div>
@endsection
