@include('layouts.base')

@content('base-content')
    <!-- ..::  header area start ::.. -->
    @include('layouts.partials.admin-sidebar')
    <!-- ..::  header area end ::.. -->

    <main class="dashboard-main">

        <!-- ..::  navbar start ::.. -->
        @include('layouts.partials.admin-navbar')
        <!-- ..::  navbar end ::.. -->
        <div class="dashboard-main-body">

            @yield('content')

        </div>

    </main>
@endcontent
