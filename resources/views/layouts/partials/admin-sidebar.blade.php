@extends('layouts.partials.sidebar-layout')

@section('sidebar-content')
    <li>
        <a href="{{ route('admin.dashboard') }}">
            <iconify-icon icon="solar:home-smile-angle-outline" class="menu-icon"></iconify-icon>
            <span>Dashboard</span>
        </a>
    </li>
    <li>
        <a href="{{ route('admin.projects.index') }}">
            <iconify-icon icon="solar:documents-line-duotone" class="menu-icon"></iconify-icon>
            <span>Projects</span>
        </a>
    </li>
    <li>
        <a href="{{ route('admin.professionals.index') }}">
            <iconify-icon icon="solar:user-outline" class="menu-icon"></iconify-icon>
            <span>Professionals</span>
        </a>
    </li>
    <li>
        <a href="{{ route('admin.recruiters.index') }}">
            <iconify-icon icon="fluent:people-20-filled" class="menu-icon"></iconify-icon>
            <span>Recruiters</span>
        </a>
    </li>

    <li class="dropdown">
        <a href="javascript:void(0)">
            <iconify-icon icon="icon-park:page" class="menu-icon"></iconify-icon>
            <span>Frontend Pages</span>
        </a>
        <ul class="sidebar-submenu">
            <li>
                <a href="{{ route('admin.pages.privacy-policy') }}">
                    <iconify-icon icon="ic:outline-privacy-tip" class="menu-icon"></iconify-icon>
                    <span>Privacy Policy</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.pages.term-of-use') }}">
                    <iconify-icon icon="mdi:gavel" class="menu-icon"></iconify-icon>
                    <span>Terms Of User</span>
                </a>
            </li>
        </ul>
    </li>
@endsection
