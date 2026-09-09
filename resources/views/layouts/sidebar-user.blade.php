<div id="sidebarOverlay" class="sidebar-overlay"></div>

<aside id="sidebar" class="sidebar">
    <div class="sidebar-header">
        <span class="topbar-icon"><i class="fa-solid fa-shield-halved"></i></span>
        <span class="sidebar-title">E-Safe School</span>
    </div>

    <nav class="sidebar-menu">
        <a href="{{ Auth::check() ? route('dashboard') : route('login') }}" class="sidebar-link">
            <i class="fa-solid fa-table-columns"></i> Dashboard
        </a>
        <a href="#" class="sidebar-link">
            <i class="fa-solid fa-file-lines"></i> Pengaduan
        </a>
        <a href="#" class="sidebar-link">
            <i class="fa-solid fa-box-archive"></i> Lost &amp; Found
        </a>
        <a href="#" class="sidebar-link">
            <i class="fa-solid fa-bell"></i> Notifikasi
        </a>
        <a href="#" class="sidebar-link">
            <i class="fa-solid fa-user"></i> Profil
        </a>
        <a href="#" class="sidebar-link">
            <i class="fa-solid fa-gear"></i> Pengaturan
        </a>
    </nav>

    <div class="sidebar-footer">
        <a href="#" class="sidebar-link">
            <i class="fa-solid fa-right-from-bracket"></i> Keluar
        </a>
    </div>
</aside>