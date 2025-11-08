<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Pure Aqua Tech')</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="@yield('meta_keywords', '')" name="keywords">
    <meta content="@yield('meta_description', '')" name="description">

    <!-- ✅ Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('img/Faviconn.png') }}">
    {{-- Alternative sizes for better browser support --}}
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/Faviconn.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/Faviconn.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/Faviconn.png') }}">
    {{-- <link rel="manifest" href="{{ asset('site.webmanifest') }}"> --}}
    
    <!-- Open Graph Meta Tags (for social sharing) -->
    <meta property="og:title" content="@yield('og_title', config('app.name'))">
    <meta property="og:description" content="@yield('og_description', '')">
    <meta property="og:image" content="@yield('og_image', asset('img/default-share.jpg'))">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
    
    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('twitter_title', config('app.name'))">
    <meta name="twitter:description" content="@yield('twitter_description', '')">
    <meta name="twitter:image" content="@yield('twitter_image', asset('img/default-share.jpg'))">
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600;700&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet - FIXED WITH ASSET HELPER -->
    <link href="{{ asset('lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet - FIXED WITH ASSET HELPER -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet - FIXED WITH ASSET HELPER -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    
    <!-- Additional Page Specific Styles -->
    @stack('styles')
</head>

<body>
    {{-- Header --}}
    @include('user.layout.header')

    {{-- Sidebar (if you want a left menu) --}}
    {{-- @include('user-layout.sidebar') --}}

    {{-- Main Content Area --}}
    <main class="main-content">
        @yield('content')
    </main>

    {{-- Footer --}}
    {{-- @include('user-layout.footer') --}}

    {{-- Global JS --}}
    @include('user.layout.footer')
    @stack('scripts') {{-- page specific scripts --}}
</body>

</html>
