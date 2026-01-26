@extends('layouts.partials.sidebar-layout')

@section('sidebar-content')
    <li>
        <a href="{{ route('admin.dashboard') }}">
            <iconify-icon icon="solar:home-smile-angle-outline" class="menu-icon"></iconify-icon>
            <span>{{ __('ui.dashboard') }}</span>
        </a>
    </li>
    <li>
        <a href="{{ route('admin.chat.index') }}">
            <iconify-icon icon="solar:chat-line-linear" class="menu-icon"></iconify-icon>
            <span>{{ __('ui.chat') }}</span>
        </a>
    </li>
    <li>
        <a href="{{ route('admin.projects.index') }}">
            <iconify-icon icon="solar:documents-line-duotone" class="menu-icon"></iconify-icon>
            <span>{{ __('ui.projects') }}</span>
        </a>
    </li>
    <li>
        <a href="{{ route('admin.professionals.index') }}">
            <iconify-icon icon="solar:user-outline" class="menu-icon"></iconify-icon>
            <span>{{ __('ui.professionals') }}</span>
        </a>
    </li>
    <li>
        <a href="{{ route('admin.recruiters.index') }}">
            <iconify-icon icon="fluent:people-20-filled" class="menu-icon"></iconify-icon>
            <span>{{ __('ui.recruiters') }}</span>
        </a>
    </li>

    <li class="dropdown">
        <a href="javascript:void(0)">
            <iconify-icon icon="icon-park:page" class="menu-icon"></iconify-icon>
            <span>{{ __('ui.frontend_pages') }}</span>
        </a>
        <ul class="sidebar-submenu">
            <li>
                <a href="{{ route('admin.pages.privacy-policy') }}">
                    <iconify-icon icon="ic:outline-privacy-tip" class="menu-icon"></iconify-icon>
                    <span>{{ __('ui.privacy_policy') }}</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.pages.term-of-use') }}">
                    <iconify-icon icon="mdi:gavel" class="menu-icon"></iconify-icon>
                    <span>{{ __('ui.terms_of_use') }}</span>
                </a>
            </li>
        </ul>
    </li>

    <li>
        <a href="{{ route('admin.applications.index') }}">
            <iconify-icon icon="fluent:form-28-regular" class="menu-icon"></iconify-icon>
            <span>{{ __('ui.applications') }}</span>
        </a>
    </li>
@endsection
