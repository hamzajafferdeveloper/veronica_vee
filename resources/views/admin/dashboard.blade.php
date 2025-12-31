@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
    <x-admin.dashboard-card />

    <div class="row gy-4 mt-1">
        <x-admin.dashboard-user-list />
        <x-admin.dashboard-project-list />
    </div>
@endsection
