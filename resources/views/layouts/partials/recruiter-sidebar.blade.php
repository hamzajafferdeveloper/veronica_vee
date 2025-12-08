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
{{--            <li class="dropdown">--}}
{{--                <a  href="javascript:void(0)">--}}
{{--                    <iconify-icon icon="solar:home-smile-angle-outline" class="menu-icon"></iconify-icon>--}}
{{--                    <span>Dashboard</span>--}}
{{--                </a>--}}
{{--                <ul class="sidebar-submenu">--}}
{{--                    <li>--}}
{{--                        <a href="{{ route('index') }}"><i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i> AI</a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <a href="{{ route('index2') }}"><i class="ri-circle-fill circle-icon text-warning-main w-auto"></i> CRM</a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <a href="{{ route('index3') }}"><i class="ri-circle-fill circle-icon text-info-main w-auto"></i> eCommerce</a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <a href="{{ route('index4') }}"><i class="ri-circle-fill circle-icon text-danger-main w-auto"></i> Cryptocurrency</a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <a href="{{ route('index5') }}"><i class="ri-circle-fill circle-icon text-success-main w-auto"></i> Investment</a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <a href="{{ route('index6') }}"><i class="ri-circle-fill circle-icon text-purple w-auto"></i> LMS</a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <a href="{{ route('index7') }}"><i class="ri-circle-fill circle-icon text-info-main w-auto"></i> NFT & Gaming</a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <a href="{{ route('index8') }}"><i class="ri-circle-fill circle-icon text-danger-main w-auto"></i> Medical</a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <a href="{{ route('index9') }}"><i class="ri-circle-fill circle-icon text-purple w-auto"></i> Analytics</a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <a href="{{ route('index10') }}"><i class="ri-circle-fill circle-icon text-warning-main w-auto"></i> POS & Inventory </a>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--            </li>--}}
            <li>
                <a href="{{ route('recruiter.dashboard') }}">
                    <iconify-icon icon="bi:chat-dots" class="menu-icon"></iconify-icon>
                    <span>Chat</span>
                </a>
            </li>
            <li class="sidebar-menu-group-title">Application</li>
            <li>
                <a href="{{ route('recruiter.project.index') }}">
                    <iconify-icon icon="solar:projector-outline" class="menu-icon"></iconify-icon>
                    <span>Projects</span>
                </a>
            </li>
            <li>
        </ul>
    </div>
</aside>
