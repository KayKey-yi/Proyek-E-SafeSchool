<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan - E-Safe School</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/shared/app-user.css') }}">
    <style>
        :root { --page-bg: #f1f8f9; --navy: #16234a; --text: #111; --muted: #69717a; --border: #e1e5e8; }
        * { box-sizing: border-box; }
        body { margin: 0; min-height: 100vh; background: var(--page-bg); color: var(--text); font-family: "Segoe UI", Tahoma, sans-serif; }
        .settings-topbar { display: flex; align-items: flex-start; justify-content: space-between; gap: 16px; min-height: 49px; padding: 9px 10px 0; }
        .settings-heading-wrap { display: flex; align-items: flex-start; gap: 10px; }
        .settings-menu-btn { display: inline-flex; align-items: center; justify-content: center; width: 22px; height: 22px; margin-top: 1px; padding: 0; border: 0; background: transparent; color: #26313a; font-size: 15px; cursor: pointer; }
        .settings-menu-btn:hover { color: #000; }
        .settings-heading h1 { margin: 0; font-size: 10px; line-height: 1.2; font-weight: 700; }
        .settings-date { margin-top: 5px; color: var(--muted); font-size: 7px; }
        .settings-tools { display: flex; align-items: center; gap: 8px; }
        .settings-search { display: flex; align-items: center; gap: 5px; width: 70px; height: 14px; padding: 0 5px; border: 1px solid #cdd3d8; border-radius: 3px; background: #fff; color: #777; }
        .settings-search input { width: 100%; border: 0; outline: 0; background: transparent; font-size: 5px; }
        .settings-tool-icon { color: #59616a; font-size: 10px; }
        .settings-shell { padding-top: 14px; }
        .settings-card { width: 100%; min-height: 275px; border: 1px solid #f0f0f0; background: #fff; }
        .settings-option { display: flex; align-items: center; gap: 12px; height: 45px; padding: 0 11px; color: inherit; text-decoration: none; }
        .settings-option + .settings-option { border-top: 1px solid #969696; }
        .settings-option:hover { background: #fafbfe; }
        .settings-icon { display: flex; align-items: center; justify-content: center; width: 30px; height: 30px; flex: 0 0 30px; color: #111; font-size: 27px; }
        .settings-copy { display: flex; min-width: 0; flex: 1; flex-direction: column; align-items: flex-start; }
        .settings-title { display: block; margin: 0 0 3px; font-size: 10px; font-weight: 700; }
        .settings-description { display: block; color: #555; font-size: 7px; }
        @media (min-width: 640px) { .settings-topbar { padding-left: 24px; padding-right: 24px; } .settings-shell { max-width: 1100px; margin: 0 auto; padding: 14px 24px 36px; } .settings-heading h1 { font-size: 16px; } .settings-date { font-size: 11px; } .settings-search { width: 220px; height: 30px; } .settings-search input { font-size: 11px; } .settings-card { min-height: 420px; } .settings-option { height: 76px; padding: 0 18px; gap: 16px; } .settings-icon { width: 38px; height: 38px; flex-basis: 38px; font-size: 30px; } .settings-title { font-size: 14px; } .settings-description { font-size: 11px; } }
    </style>
</head>
<body>
    @include('layouts.sidebar-user')

    <header class="settings-topbar">
        <div class="settings-heading-wrap">
            <button class="settings-menu-btn" id="menuBtn" type="button" aria-label="Buka menu" aria-expanded="false">
                <i class="fa-solid fa-bars"></i>
            </button>
            <div class="settings-heading">
                <h1>Pengaturan</h1>
                <div class="settings-date">{{ now()->locale('id')->translatedFormat('l, j F Y') }}</div>
            </div>
        </div>
        <div class="settings-tools">
            <label class="settings-search" aria-label="Cari sesuatu">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="search" placeholder="Cari Sesuatu...">
            </label>
        </div>
    </header>

    <main class="settings-shell">
        <section class="settings-card" aria-label="Pilihan pengaturan">
            <a class="settings-option" href="#bahasa-dan-waktu">
                <span class="settings-icon"><i class="fa-solid fa-globe"></i></span>
                <span class="settings-copy"><span class="settings-title">Bahasa dan Waktu</span><span class="settings-description">Bahasa &bull; Tampilan Waktu</span></span>
            </a>
            <a class="settings-option" href="#tentang">
                <span class="settings-icon"><i class="fa-solid fa-circle-info"></i></span>
                <span class="settings-copy"><span class="settings-title">Tentang</span><span class="settings-description">Versi &bull; Tentang Website</span></span>
            </a>
        </section>
    </main>

    <script>
        const menuButton = document.getElementById('menuBtn');
        const sidebar = document.getElementById('sidebar');
        const sidebarOverlay = document.getElementById('sidebarOverlay');
        const sidebarClose = document.getElementById('sidebarClose');

        function toggleSidebar(forceOpen) {
            const shouldOpen = typeof forceOpen === 'boolean' ? forceOpen : !sidebar.classList.contains('open');
            sidebar.classList.toggle('open', shouldOpen);
            sidebarOverlay.classList.toggle('show', shouldOpen);
            if (menuButton) menuButton.setAttribute('aria-expanded', String(shouldOpen));
        }

        if (menuButton) menuButton.addEventListener('click', () => toggleSidebar());
        if (sidebarOverlay) sidebarOverlay.addEventListener('click', () => toggleSidebar(false));
        if (sidebarClose) sidebarClose.addEventListener('click', () => toggleSidebar(false));
    </script>
</body>
</html>