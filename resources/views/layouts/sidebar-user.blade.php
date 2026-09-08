<div id="sidebarOverlay" class="sidebar-overlay"></div>

<aside id="sidebar" class="sidebar">
    <div class="sidebar-header">
        <span class="topbar-icon"><i class="fa-solid fa-shield-halved"></i></span>
        <span class="sidebar-title">E-Safe School</span>
        <button type="button" class="sidebar-close" id="sidebarClose" aria-label="Tutup menu">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>

    <nav class="sidebar-menu">
        <a href="{{ route('user.dashboard') }}" class="sidebar-link {{ request()->routeIs('user.dashboard') ? 'active' : '' }}">
            <i class="fa-solid fa-table-columns"></i> Dashboard
        </a>
        <a href="{{ route('complaints.user.index.short') }}" class="sidebar-link">
            <i class="fa-solid fa-file-lines"></i> Pengaduan
        </a>
        <a href="{{ route('item_reports.user.index') }}" class="sidebar-link">
            <i class="fa-solid fa-box-archive"></i> Lost &amp; Found
        </a>
        <a href="{{ route('user.notifications') }}" class="sidebar-link {{ request()->routeIs('user.notifications') ? 'active' : '' }}">
            <i class="fa-solid fa-bell"></i> Notifikasi
        </a>
        <a href="{{ route('profile.edit') }}" class="sidebar-link">
            <i class="fa-solid fa-user"></i> Profil
        </a>
        <a href="{{ route('user.settings') }}" class="sidebar-link {{ request()->routeIs('user.settings') ? 'active' : '' }}">
            <i class="fa-solid fa-gear"></i> Pengaturan
        </a>
    </nav>

    <div class="sidebar-footer">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="sidebar-link border-0 bg-transparent w-100 text-start">
            <i class="fa-solid fa-right-from-bracket"></i> Keluar
            </button>
        </form>
    </div>
</aside>