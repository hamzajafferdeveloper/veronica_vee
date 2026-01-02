<aside class="sidebar">
    <!-- Sidebar Close Button -->
    <button type="button" class="sidebar-close-btn">
        <iconify-icon icon="radix-icons:cross-2"></iconify-icon>
    </button>

    <!-- Logo -->
    <div>
        <a href="{{ route('home') }}" class="sidebar-logo">
            <img src="{{ asset('assets/images/logo.png') }}" alt="site logo" class="light-logo">
            <img src="{{ asset('assets/images/logo.png') }}" alt="site logo" class="dark-logo">
            <img src="{{ asset('assets/images/favicon.png') }}" alt="site logo" class="logo-icon">
        </a>
    </div>

    <!-- Sidebar Menu Area -->
    <div class="sidebar-menu-area d-flex flex-column justify-space-between" style="flex:1">
        <ul class="sidebar-menu" id="sidebar-menu">
            <li>
                <a href="{{ route('recruiter.dashboard') }}"
                    class="{{ request()->routeIs('recruiter.dashboard') ? 'active' : '' }}">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="menu-icon"></iconify-icon>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('recruiter.chat.index') }}"
                    class="{{ request()->routeIs('recruiter.chat.*') ? 'active' : '' }}">
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
        </ul>

        <!-- Logout Button at Bottom -->
        <div class="mt-auto px-3 py-3">
            <form id="logoutForm" action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit"
                    class="sidebar-logout-btn d-flex align-items-center gap-3 w-100 border-0 rounded-3 px-5 py-1 bg-danger text-white fw-bold transition hover-shadow">
                    <iconify-icon icon="lucide:power" class="menu-icon text-lg"></iconify-icon>
                    <span>Log Out</span>
                </button>
            </form>
        </div>

    </div>
</aside>
