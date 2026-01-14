@extends('layouts.partials.sidebar-layout')

@section('sidebar-content')
    <li>
        <a href="{{ route('professional.dashboard') }}">
            <iconify-icon icon="solar:home-smile-angle-outline" class="menu-icon"></iconify-icon>
            <span>{{ __('ui.dashboard') }}</span>
        </a>
    </li>
    <li>
        <a href="{{ route('professional.chat.index') }}">
            <iconify-icon icon="bi:chat-dots" class="menu-icon"></iconify-icon>
            <span>{{ __('ui.chat') }}</span>
        </a>
    </li>
    <li class="sidebar-menu-group-title">{{ __('ui.application') }}</li>
    <li>
        <a href="{{ route('professional.project.index') }}">
            <iconify-icon icon="solar:documents-line-duotone" class="menu-icon"></iconify-icon>
            <span>{{ __('ui.projects') }}</span>
        </a>
    </li>
@endsection
