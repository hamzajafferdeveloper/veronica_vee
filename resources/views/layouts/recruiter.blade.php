@extends('layouts.base')

@section('base-content')
    <!-- ..::  header area start ::.. -->
    @include('layouts.partials.recruiter-sidebar')
    <!-- ..::  header area end ::.. -->

    <main class="dashboard-main">

        <!-- ..::  navbar start ::.. -->
        @include('layouts.partials.recruiter-navbar')
        <!-- ..::  navbar end ::.. -->
        <div class="dashboard-main-body">

            @yield('content')

        </div>

    </main>
@endsection
