<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/svg+xml" href="{{ asset('image/placeholder.png') }}" />

    {{-- ═══════════════════════════════════════════════════════════════
        DYNAMIC PAGE TITLE — @section('title') se override hoga
    ═══════════════════════════════════════════════════════════════ --}}
    <title>@yield('meta_title', 'Akshar Plus — Live Chat, Audio & Video Calling Platform')</title>

    {{-- ═══════════════════════════════════════════════════════════════
        DEFAULT META TAGS — @section('meta') se override hoga
    ═══════════════════════════════════════════════════════════════ --}}
    @hasSection('meta')
    @yield('meta')
    @else
    <meta name="description" content="Replace 4+ tools with one platform. Akshar Plus brings live chat, HD audio/video calling, screen sharing, and file management into one beautiful workspace.">
    <meta name="keywords" content="team communication, video calling, live chat, remote work, collaboration platform">

    {{-- Open Graph --}}
    <meta property="og:type" content="website">
    <meta property="og:title" content="Akshar Plus — Team Communication Platform">
    <meta property="og:description" content="Replace 4+ tools with one platform. Live chat, HD calls, and file management.">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset('image/og-default.png') }}">
    <meta property="og:site_name" content="Akshar Plus">

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Akshar Plus — Team Communication Platform">
    <meta name="twitter:description" content="Replace 4+ tools with one platform. Live chat, HD calls, and file management.">
    <meta name="twitter:image" content="{{ asset('image/og-default.png') }}">
    <meta name="twitter:site" content="@aksharplus">
    @endif

    {{-- Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    @if (request()->is('blog') || request()->is('blog/*'))
    <link rel="stylesheet" href="{{ asset('css/blog.css') }}">
    @endif

    {{-- Additional Styles from Child Pages --}}
    @stack('styles')

    <style>
        .feature-card img {
            width: 50px !important;
        }
    </style>
</head>

<body>

    <!-- ══════════════════ NAVBAR ══════════════════ -->
    <nav id="navbar" class="">
        <a class="nav-logo" href="{{ route('home') }}">
            <div class="logo-icon">
                <img alt="Akshar Plus" title="Akshar Plus" src="{{ asset('image/logo.png') }}">
            </div>
        </a>

        <div class="nav-links">
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('home') }}#features">Features</a>
            <a href="{{ route('home') }}#calling">Calling</a>
            <a href="{{ route('home') }}#multicompany">Multi-Company</a>
            <a href="{{ route('home') }}#files">Media Library</a>
            <a href="{{ route('home') }}#testimonials">Reviews</a>

            <a href="{{ route('blog.index') }}"
                class="{{ request()->routeIs('blog.*') ? 'active' : '' }}">
                Blog
            </a>
        </div>

        <div class="nav-actions">
            <a href="https://aksharplus.com/" class="btn-ghost">Sign In</a>

            <button class="hamburger" id="hamburger">
                <span></span><span></span><span></span>
            </button>
        </div>
    </nav>

    <div class="mobile-menu" id="mobileMenu">
        <a href="{{ route('home') }}">Home</a>
        <a href="{{ route('home') }}#features">Features</a>
        <a href="{{ route('home') }}#calling">Calling</a>
        <a href="{{ route('home') }}#multicompany">Multi-Company</a>
        <a href="{{ route('home') }}#files">Media Library</a>
        <a href="{{ route('home') }}#testimonials">Reviews</a>
        <a href="{{ route('blog.index') }}"
            class="{{ request()->routeIs('blog.*') ? 'active' : '' }}">
            Blog
        </a>
    </div>