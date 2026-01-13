@extends('layouts.partials.sidebar-layout')

@section('sidebar-content')
    <li>
        <a href="{{ route('recruiter.dashboard') }}" class="{{ request()->routeIs('recruiter.dashboard') ? 'active' : '' }}">
            <iconify-icon icon="solar:home-smile-angle-outline" class="menu-icon"></iconify-icon>
            <span>{{ __('Dashboard') }}</span>
        </a>
    </li>
    <li>
        <a href="{{ route('recruiter.chat.index') }}" class="{{ request()->routeIs('recruiter.chat.*') ? 'active' : '' }}">
            <iconify-icon icon="bi:chat-dots" class="menu-icon"></iconify-icon>
            <span>{{ __('Chat') }}</span>
        </a>
    </li>

    <li class="sidebar-menu-group-title">{{ __('Application') }}</li>
    <li>
        <a href="{{ route('recruiter.project.index') }}"
            class="{{ request()->routeIs('recruiter.project.index') ? 'active' : '' }}">
            <iconify-icon icon="solar:documents-line-duotone" class="menu-icon"></iconify-icon>
            <span>{{ __('Projects') }}</span>
        </a>
    </li>
    <li>
        <a href="{{ route('recruiter.project.requests') }}"
            class="{{ request()->routeIs('recruiter.project.requests') ? 'active' : '' }}">
            <i class="bi bi-send-check me-1"></i>
            <span>{{ __('Project Requests') }}</span>
        </a>
    </li>
@endsection
