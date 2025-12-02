<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('assets/css/css.css') }}" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400;700;900&family=Oswald:wght@200;300;400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Owl Carousel -->
    <link href="{{ asset('assets/css/owl.carousel.css') }}" rel="stylesheet">

    <link rel="icon" href="{{ asset('assets/images/favicon.png') }}">

    <title>@yield('title', 'VeronicaVee') - {{ config('app.name', 'Laravel') }}</title>

    @stack('head')
</head>

<body>

@include('layouts.partials.app-header')

@yield('content')

@include('layouts.partials.app-footer')
<!-- Scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/owl.carousel.js') }}"></script>

@stack('script')
</body>
</html>
