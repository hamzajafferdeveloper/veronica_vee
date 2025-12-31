<aside class="sidebar">
    <button type="button" class="sidebar-close-btn">
        <iconify-icon icon="radix-icons:cross-2"></iconify-icon>
    </button>
    <div>
        <a href="{{ route('home') }}" class="sidebar-logo">
            <img src="{{ asset('assets/images/logo.png') }}" alt="site logo" class="light-logo">
            <img src="{{ asset('assets/images/logo.png') }}" alt="site logo" class="dark-logo">
            <img src="{{ asset('assets/images/favicon.png') }}" alt="site logo" class="logo-icon">
        </a>
    </div>
    <div class="sidebar-menu-area">
        <ul class="sidebar-menu" id="sidebar-menu">
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
        </ul>
    </div>
</aside>
