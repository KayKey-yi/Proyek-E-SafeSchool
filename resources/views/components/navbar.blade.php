{{-- Reusable E-Safe School navbar with a smooth active-link indicator. --}}
@props(['active' => 'beranda'])

<nav class="navbar">
    <div class="navbar-left">
        <button class="hamburger" id="menuBtn" type="button" aria-label="Menu" aria-expanded="false">
            <span></span>
            <span></span>
            <span></span>
        </button>
        <div class="brand">
            <span class="brand-icon">&#128737;&#65039;</span>
            E-Safe School
        </div>
    </div>

    <div class="navbar-links" id="navbarLinks">
        <a href="{{ url('/') }}" data-nav="beranda" class="{{ $active === 'beranda' ? 'active' : '' }}">Beranda</a>
        <a href="{{ url('/lost-and-found') }}" data-nav="lost-found" class="{{ $active === 'lost-found' ? 'active' : '' }}">Lost &amp; Found</a>
        <a href="{{ url('/pengaduan') }}" data-nav="pengaduan" class="{{ $active === 'pengaduan' ? 'active' : '' }}">Pengaduan</a>
        <span class="nav-indicator" id="navIndicator"></span>
    </div>
</nav>

<style>
    .navbar { display: flex; align-items: center; justify-content: space-between; padding: 16px 60px; border-bottom: 1px solid #eef0f2; background-color: #ffffff; position: relative; }
    .navbar-left { display: flex; align-items: center; gap: 18px; }
    .hamburger { display: flex; flex-direction: column; gap: 4px; cursor: pointer; background: none; border: none; }
    .hamburger span { width: 22px; height: 2px; background-color: #1a1a1a; display: block; }
    .brand { display: flex; align-items: center; gap: 8px; font-weight: 700; font-size: 17px; color: #1a2b6d; }
    .brand-icon { width: 26px; height: 26px; border-radius: 7px; background-color: #2247d6; display: flex; align-items: center; justify-content: center; color: #ffffff; font-size: 13px; }
    .navbar-links { position: relative; display: flex; gap: 34px; font-size: 14.5px; color: #444; }
    .navbar-links a { text-decoration: none; color: inherit; position: relative; z-index: 2; padding-bottom: 6px; transition: color 0.25s ease; }
    .navbar-links a.active { color: #2247d6; font-weight: 600; }
    .nav-indicator { position: absolute; bottom: -1px; height: 2.5px; background-color: #2247d6; border-radius: 2px; transition: left 0.35s cubic-bezier(0.4, 0, 0.2, 1), width 0.35s cubic-bezier(0.4, 0, 0.2, 1); }
    @media (max-width: 900px) { .navbar { padding-left: 24px; padding-right: 24px; } .navbar-links { display: none; } }
</style>

<script>
    (function () {
        function initNavIndicator() {
            const container = document.getElementById('navbarLinks');
            const indicator = document.getElementById('navIndicator');
            if (!container || !indicator) return;
            const activeLink = container.querySelector('a.active');
            if (!activeLink) { indicator.style.width = '0px'; return; }
            const containerRect = container.getBoundingClientRect();
            const linkRect = activeLink.getBoundingClientRect();
            indicator.style.left = (linkRect.left - containerRect.left) + 'px';
            indicator.style.width = linkRect.width + 'px';
        }
        window.addEventListener('DOMContentLoaded', initNavIndicator);
        window.addEventListener('resize', initNavIndicator);
    })();
</script>
