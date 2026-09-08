<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifikasi - E-Safe School</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/shared/app-user.css') }}">
    <style>
        :root {
            --page-bg: #eef1f7;
            --navy: #16234a;
            --text: #1c2333;
            --muted: #94a0b8;
            --border: #e1e5ee;
            --accent: #3d5aef;
        }

        * { box-sizing: border-box; }
        body { margin: 0; min-height: 100vh; background: var(--page-bg); color: var(--text); font-family: "Segoe UI", Tahoma, sans-serif; }
        .dashboard-topbar { display: flex; align-items: center; gap: 16px; padding: 14px 24px; border-bottom: 1px solid #e5e7eb; background: #fff; }
        .dashboard-menu-btn { display: inline-flex; align-items: center; justify-content: center; width: 40px; height: 40px; border: 0; border-radius: 8px; background: transparent; color: var(--navy); font-size: 20px; cursor: pointer; }
        .dashboard-menu-btn:hover { background: #f1f5f9; }
        .dashboard-topbar-title { font-size: 16px; font-weight: 700; }
        .page-shell { max-width: 1100px; margin: 0 auto; padding: 24px 28px 36px; }
        .page-header { display: flex; align-items: end; justify-content: space-between; gap: 20px; margin-bottom: 22px; }
        .page-header h1 { margin: 0; font-size: 22px; }
        .page-date { margin-top: 5px; color: var(--muted); font-size: 12px; }
        .search-box { display: flex; align-items: center; gap: 8px; width: 220px; height: 36px; padding: 0 12px; border: 1px solid #d7dce7; border-radius: 8px; background: #fff; color: var(--muted); }
        .search-box input { width: 100%; border: 0; outline: 0; background: transparent; color: var(--text); font-size: 12px; }
        .filter-tabs { display: flex; gap: 8px; margin-bottom: 18px; }
        .filter-tab { padding: 8px 14px; border: 1px solid var(--border); border-radius: 16px; background: #fff; color: #5b6478; font-size: 12px; cursor: pointer; }
        .filter-tab.active { border-color: var(--navy); background: var(--navy); color: #fff; }
        .notification-list { display: flex; flex-direction: column; gap: 14px; }
        .notification-card { padding: 16px 18px; border: 1px solid var(--border); border-left: 4px solid var(--accent); border-radius: 10px; background: #fff; }
        .notification-card.pengaduan { border-left-color: #e6584a; }
        .notification-label { margin-bottom: 7px; color: #5b6478; font-size: 11px; font-weight: 700; letter-spacing: .3px; }
        .notification-message { font-size: 14px; line-height: 1.5; }
        .status-badge { display: inline-block; margin-left: 5px; padding: 3px 10px; border-radius: 12px; background: #fff4de; color: #b57b12; font-size: 12px; font-weight: 600; }
        .status-badge.finished { background: #e4f6ea; color: #1f9254; }
        .notification-time { margin-top: 7px; color: var(--muted); font-size: 12px; }
        .empty-state { padding: 78px 20px; border: 1px dashed var(--border); border-radius: 14px; background: #fff; text-align: center; }
        .empty-state i { margin-bottom: 18px; color: #c3cbe0; font-size: 42px; }
        .empty-state h2 { margin: 0 0 6px; font-size: 16px; }
        .empty-state p { max-width: 340px; margin: 0 auto; color: var(--muted); font-size: 13px; line-height: 1.6; }
        @media (max-width: 640px) { .page-shell { padding: 22px 16px 32px; } .page-header { align-items: stretch; flex-direction: column; } .search-box { width: 100%; } .filter-tabs { flex-wrap: wrap; } }
    </style>
</head>
<body>
    @include('layouts.sidebar-user')

    <header class="dashboard-topbar">
        <button class="dashboard-menu-btn" id="menuBtn" type="button" aria-label="Buka menu" aria-expanded="false">
            <i class="fa-solid fa-bars"></i>
        </button>
        <span class="dashboard-topbar-title">E-Safe School</span>
    </header>

    <main class="page-shell">
        <header class="page-header">
            <div>
                <h1>Notifikasi</h1>
                <div class="page-date">{{ now()->locale('id')->translatedFormat('l, j F Y') }}</div>
            </div>
            <label class="search-box" aria-label="Cari notifikasi">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input id="notificationSearch" type="search" placeholder="Cari sesuatu...">
            </label>
        </header>

        <div class="filter-tabs" role="tablist" aria-label="Filter notifikasi">
            <button class="filter-tab active" type="button" data-filter="all">Semua</button>
            <button class="filter-tab" type="button" data-filter="pengaduan">Pengaduan</button>
            <button class="filter-tab" type="button" data-filter="lostfound">Lost &amp; Found</button>
        </div>

        <section id="notificationList" class="notification-list">
            @forelse($notifications as $notification)
                @php
                    $status = $notification['status'];
                    $isFinished = in_array(strtolower($status), ['selesai', 'dikembalikan', 'ditemukan'], true);
                @endphp
                <article class="notification-card {{ $notification['category'] }}" data-category="{{ $notification['category'] }}" data-search="{{ strtolower($notification['label'].' '.$notification['message'].' '.$status) }}">
                    <div class="notification-label">[ {{ $notification['label'] }} ]</div>
                    <div class="notification-message">
                        {{ $notification['message'] }} - Status:
                        <span class="status-badge {{ $isFinished ? 'finished' : '' }}">{{ $status }}</span>
                    </div>
                    <div class="notification-time">{{ $notification['created_at']?->locale('id')->diffForHumans() ?? 'Waktu tidak tersedia' }}</div>
                </article>
            @empty
                <div class="empty-state">
                    <i class="fa-regular fa-bell-slash"></i>
                    <h2>Belum ada notifikasi</h2>
                    <p>Notifikasi akan muncul di sini setiap ada laporan pengaduan atau lost &amp; found yang kamu kirim.</p>
                </div>
            @endforelse
        </section>
    </main>

    <script>
        const menuButton = document.getElementById('menuBtn');
        const sidebar = document.getElementById('sidebar');
        const sidebarOverlay = document.getElementById('sidebarOverlay');
        const sidebarClose = document.getElementById('sidebarClose');
        const searchInput = document.getElementById('notificationSearch');
        const cards = [...document.querySelectorAll('.notification-card')];
        const emptyState = '<div class="empty-state"><i class="fa-regular fa-bell-slash"></i><h2>Belum ada notifikasi</h2><p>Tidak ada notifikasi yang cocok dengan pilihanmu.</p></div>';

        function toggleSidebar(forceOpen) {
            const shouldOpen = typeof forceOpen === 'boolean' ? forceOpen : !sidebar.classList.contains('open');
            sidebar.classList.toggle('open', shouldOpen);
            sidebarOverlay.classList.toggle('show', shouldOpen);
            menuButton.setAttribute('aria-expanded', String(shouldOpen));
        }

        menuButton.addEventListener('click', () => toggleSidebar());
        sidebarOverlay.addEventListener('click', () => toggleSidebar(false));
        sidebarClose.addEventListener('click', () => toggleSidebar(false));

        let activeFilter = 'all';
        function filterNotifications() {
            const term = searchInput.value.toLowerCase().trim();
            let visible = 0;
            cards.forEach((card) => {
                const matchesFilter = activeFilter === 'all' || card.dataset.category === activeFilter;
                const matchesSearch = card.dataset.search.includes(term);
                card.hidden = !(matchesFilter && matchesSearch);
                if (!card.hidden) visible += 1;
            });
            const existingEmpty = document.querySelector('.filtered-empty');
            if (visible === 0 && cards.length > 0) {
                if (!existingEmpty) {
                    const wrapper = document.createElement('div');
                    wrapper.className = 'filtered-empty';
                    wrapper.innerHTML = emptyState;
                    document.getElementById('notificationList').appendChild(wrapper);
                }
            } else if (existingEmpty) {
                existingEmpty.remove();
            }
        }

        document.querySelectorAll('.filter-tab').forEach((tab) => tab.addEventListener('click', () => {
            document.querySelectorAll('.filter-tab').forEach((item) => item.classList.remove('active'));
            tab.classList.add('active');
            activeFilter = tab.dataset.filter;
            filterNotifications();
        }));
        searchInput.addEventListener('input', filterNotifications);
    </script>
</body>
</html>
