@extends('layouts.partials.sidebar-layout')

@section('sidebar-content')
    <li>
        <a href="{{ route('admin.dashboard') }}">
            <iconify-icon icon="solar:home-smile-angle-outline" class="menu-icon"></iconify-icon>
            <span>{{ __('Dashboard') }}</span>
        </a>
    </li>
    <li>
        <a href="{{ route('admin.projects.index') }}">
            <iconify-icon icon="solar:documents-line-duotone" class="menu-icon"></iconify-icon>
            <span>{{ __('Projects') }}</span>
        </a>
    </li>
    <li>
        <a href="{{ route('admin.professionals.index') }}">
            <iconify-icon icon="solar:user-outline" class="menu-icon"></iconify-icon>
            <span>{{ __('Professionals') }}</span>
        </a>
    </li>
    <li>
        <a href="{{ route('admin.recruiters.index') }}">
            <iconify-icon icon="fluent:people-20-filled" class="menu-icon"></iconify-icon>
            <span>{{ __('Recruiters') }}</span>
        </a>
    </li>

    <li class="dropdown">
        <a href="javascript:void(0)">
            <iconify-icon icon="icon-park:page" class="menu-icon"></iconify-icon>
            <span>{{ __('Frontend Pages') }}</span>
        </a>
        <ul class="sidebar-submenu">
            <li>
                <a href="{{ route('admin.pages.privacy-policy') }}">
                    <iconify-icon icon="ic:outline-privacy-tip" class="menu-icon"></iconify-icon>
                    <span>{{ __('Privacy Policy') }}</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.pages.term-of-use') }}">
                    <iconify-icon icon="mdi:gavel" class="menu-icon"></iconify-icon>
                    <span>{{ __('Terms Of User') }}</span>
                </a>
            </li>
        </ul>
    </li>
@endsection
