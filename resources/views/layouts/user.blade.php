<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-Safe School - @yield('title', 'Beranda')</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/shared/app-user.css') }}">
    @stack('styles')
</head>
<body>

    
    @include('layouts.sidebar-user')

   
    <header class="topbar">
        <div class="topbar-left">
            <button id="menuToggle" class="menu-toggle">
                <i class="fa-solid fa-bars"></i>
            </button>
            <span class="topbar-icon"><i class="fa-solid fa-shield-halved"></i></span>
            <span class="topbar-title">E-Safe School</span>
        </div>

        <nav class="topbar-nav">
            <a href="{{ url('/') }}"
               class="{{ request()->is('/') ? 'active' : '' }}">Beranda</a>
            <a href="{{ route('item_reports.user.index') }}"
               class="{{ request()->routeIs('item_reports.user.*') ? 'active' : '' }}">Lost &amp; Found</a>
            <a href="{{ url('/pengaduan') }}"
               class="{{ request()->is('pengaduan*') ? 'active' : '' }}">Pengaduan</a>
        </nav>
    </header>

   
    <main class="page-content @yield('page-content-class')">
        @yield('content')
    </main>

    <script src="{{ asset('assets/js/app-user.js') }}"></script>
    @stack('scripts')
</body>
</html>