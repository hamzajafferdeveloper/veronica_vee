@extends('layouts.partials.sidebar-layout')

@section('sidebar-content')
    <li>
        <a href="{{ route('recruiter.dashboard') }}" class="{{ request()->routeIs('recruiter.dashboard') ? 'active' : '' }}">
            <iconify-icon icon="solar:home-smile-angle-outline" class="menu-icon"></iconify-icon>
            <span>Dashboard</span>
        </a>
    </li>
    <li>
        <a href="{{ route('recruiter.chat.index') }}" class="{{ request()->routeIs('recruiter.chat.*') ? 'active' : '' }}">
            <iconify-icon icon="bi:chat-dots" class="menu-icon"></iconify-icon>
            <span>Chat</span>
        </a>
    </li>

    <li class="sidebar-menu-group-title">Application</li>
    <li>
        <a href="{{ route('recruiter.project.index') }}"
            class="{{ request()->routeIs('recruiter.project.index') ? 'active' : '' }}">
            <iconify-icon icon="solar:documents-line-duotone" class="menu-icon"></iconify-icon>
            <span>Projects</span>
        </a>
    </li>
    <li>
        <a href="{{ route('recruiter.project.requests') }}"
            class="{{ request()->routeIs('recruiter.project.requests') ? 'active' : '' }}">
            <i class="bi bi-send-check me-1"></i>
            <span>Project Requests</span>
        </a>
    </li>
@endsection
