@extends('layouts.app')

@section('title', $page->title ?? 'Custom Page')

@section('content')
    <div class="container py-5">
        <h1 class="mb-4">{{ $page->title ?? 'Custom Page' }}</h1>

        <div class="page-content">
            {!! $page->content ?? '' !!}
        </div>
    </div>
@endsection
