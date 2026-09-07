<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - E-Safe School</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/shared/app-user.css') }}">
    <style>
        :root{--blue-900:#16215c;--blue-700:#1d4ed8;--blue-100:#dbeafe;--page:#f4f6fb;--text:#111827;--muted:#6b7280;--border:#e5e7eb;--green:#15803d;--green-bg:#dcfce7;--amber:#b45309;--amber-bg:#fef3c7}
        body{background:var(--page);color:var(--text)}
        .dashboard-main{min-height:100vh;padding:32px 24px 48px}
        .dashboard-topbar{display:flex;align-items:center;gap:16px;padding:14px 24px;border-bottom:1px solid var(--border);background:#fff}
        .dashboard-menu-btn{display:inline-flex;align-items:center;justify-content:center;width:40px;height:40px;border:0;border-radius:8px;background:transparent;color:var(--blue-900);font-size:20px;cursor:pointer}
        .dashboard-menu-btn:hover{background:#f1f5f9}
        .dashboard-topbar-title{font-size:16px;font-weight:700}
        .dashboard-container{max-width:1180px;margin:0 auto}
        .dashboard-header{display:flex;align-items:flex-start;justify-content:space-between;gap:24px;margin-bottom:28px}
        .eyebrow{margin-bottom:6px;color:var(--blue-700);font-size:12px;font-weight:700;letter-spacing:.08em;text-transform:uppercase}
        h1{margin:0 0 8px;font-size:30px;line-height:1.2}
        .intro{margin:0;color:var(--muted);font-size:14px}
        .quick-actions{display:flex;flex-wrap:wrap;gap:10px}
        .action{display:inline-flex;align-items:center;gap:8px;padding:10px 14px;border-radius:8px;font-size:13px;font-weight:700}
        .action-primary{background:var(--blue-900);color:#fff}.action-secondary{border:1px solid var(--border);background:#fff;color:var(--text)}
        .stats-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin-bottom:22px}
        .stat-card,.activity-panel,.tips-panel{border:1px solid var(--border);border-radius:12px;background:#fff}
        .stat-card{display:flex;align-items:center;gap:14px;padding:20px}
        .stat-icon{display:flex;align-items:center;justify-content:center;width:44px;height:44px;border-radius:10px;background:var(--blue-100);color:var(--blue-700);font-size:18px}
        .stat-label{margin:0 0 5px;color:var(--muted);font-size:12px}.stat-value{margin:0;font-size:25px;line-height:1;font-weight:800}
        .dashboard-grid{display:grid;grid-template-columns:minmax(0,1.5fr) minmax(280px,1fr);gap:22px}
        .panel-header{display:flex;align-items:center;justify-content:space-between;gap:16px;padding:20px 22px;border-bottom:1px solid var(--border)}
        .panel-header h2{margin:0;font-size:17px}.panel-link{color:var(--blue-700);font-size:12px;font-weight:700}
        .activity-list{padding:4px 22px 10px}.activity-item{display:flex;align-items:flex-start;gap:14px;padding:17px 0;border-bottom:1px solid #f0f1f4}.activity-item:last-child{border-bottom:0}
        .activity-icon{display:flex;align-items:center;justify-content:center;width:34px;height:34px;flex:0 0 34px;border-radius:9px;background:#f1f5f9;color:var(--blue-700)}
        .activity-content{min-width:0;flex:1}.activity-title{margin:0 0 4px;font-size:14px;font-weight:700;overflow-wrap:anywhere}.activity-meta{margin:0;color:var(--muted);font-size:12px}
        .status{display:inline-block;padding:5px 9px;border-radius:999px;background:var(--amber-bg);color:var(--amber);font-size:11px;font-weight:700;white-space:nowrap}.status-finished{background:var(--green-bg);color:var(--green)}
        .empty-state{padding:46px 22px;text-align:center;color:var(--muted);font-size:13px}.empty-state i{display:block;margin-bottom:12px;color:#9ca3af;font-size:28px}
        .tips-panel{padding:22px}.tips-panel h2{margin:0 0 16px;font-size:17px}.tip{display:flex;gap:12px;margin-top:15px}.tip i{width:20px;padding-top:2px;color:var(--blue-700)}.tip strong{display:block;margin-bottom:3px;font-size:13px}.tip p{margin:0;color:var(--muted);font-size:12px;line-height:1.5}
        @media(max-width:800px){.dashboard-header{display:block}.quick-actions{margin-top:18px}.dashboard-grid{grid-template-columns:1fr}}
        @media(max-width:560px){.dashboard-main{padding:24px 16px 40px}.stats-grid{grid-template-columns:1fr}.panel-header{padding:17px}.activity-list{padding-right:17px;padding-left:17px}.status{font-size:10px}}
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

    <main class="dashboard-main">
        <div class="dashboard-container">
            <header class="dashboard-header">
                <div>
                    <p class="eyebrow">Aktivitas akun</p>
                    <h1>Halo, {{ Auth::user()->name }}!</h1>
                    <p class="intro">Pantau semua laporan yang pernah kamu kirim dari satu tempat.</p>
                </div>
                <div class="quick-actions">
                    <a class="action action-primary" href="{{ route('complaints.user.create') }}"><i class="fa-solid fa-plus"></i> Buat Pengaduan</a>
                    <a class="action action-secondary" href="{{ route('item_reports.user.create') }}"><i class="fa-solid fa-box-open"></i> Laporkan Barang</a>
                </div>
            </header>

            <section class="stats-grid" aria-label="Ringkasan laporan">
                <article class="stat-card"><div class="stat-icon"><i class="fa-solid fa-file-lines"></i></div><div><p class="stat-label">Total pengaduan</p><p class="stat-value">{{ $complaintsCount }}</p></div></article>
                <article class="stat-card"><div class="stat-icon"><i class="fa-solid fa-box-archive"></i></div><div><p class="stat-label">Laporan Lost &amp; Found</p><p class="stat-value">{{ $itemsCount }}</p></div></article>
                <article class="stat-card"><div class="stat-icon"><i class="fa-solid fa-circle-check"></i></div><div><p class="stat-label">Laporan selesai</p><p class="stat-value">{{ $finishedCount }}</p></div></article>
            </section>

            <section class="dashboard-grid">
                <div class="activity-panel">
                    <div class="panel-header"><h2>Aktivitas terbaru</h2><a class="panel-link" href="{{ route('complaints.user.index.short') }}">Lihat pengaduan</a></div>
                    <div class="activity-list">
                        @forelse($activities->take(8) as $activity)
                            @php($isFinished = in_array(strtolower($activity['status']), ['selesai', 'dikembalikan', 'ditemukan'], true))
                            <article class="activity-item">
                                <div class="activity-icon"><i class="{{ $activity['type'] === 'Pengaduan' ? 'fa-solid fa-file-lines' : 'fa-solid fa-box-archive' }}"></i></div>
                                <div class="activity-content"><p class="activity-title">{{ $activity['type'] }}: {{ $activity['title'] }}</p><p class="activity-meta">{{ $activity['created_at']?->translatedFormat('d F Y, H:i') ?? 'Tanggal tidak tersedia' }}</p></div>
                                <span class="status {{ $isFinished ? 'status-finished' : '' }}">{{ $activity['status'] }}</span>
                            </article>
                        @empty
                            <div class="empty-state"><i class="fa-regular fa-folder-open"></i>Belum ada aktivitas. Laporan yang kamu kirim akan tampil di sini.</div>
                        @endforelse
                    </div>
                </div>

                <aside class="tips-panel">
                    <h2>Informasi penting</h2>
                    <div class="tip"><i class="fa-solid fa-shield-halved"></i><div><strong>Jaga privasi</strong><p>Identitas dan data laporan digunakan hanya untuk membantu penanganan.</p></div></div>
                    <div class="tip"><i class="fa-solid fa-circle-info"></i><div><strong>Lengkapi informasi</strong><p>Detail lokasi, waktu, dan ciri-ciri membantu laporan diproses lebih cepat.</p></div></div>
                    <div class="tip"><i class="fa-solid fa-bell"></i><div><strong>Periksa status</strong><p>Kunjungi halaman ini secara berkala untuk melihat perkembangan laporanmu.</p></div></div>
                </aside>
            </section>
        </div>
    </main>

    <script>
        const menuButton = document.getElementById('menuBtn');
        const sidebar = document.getElementById('sidebar');
        const sidebarOverlay = document.getElementById('sidebarOverlay');
        const sidebarClose = document.getElementById('sidebarClose');

        function toggleSidebar(forceOpen) {
            const shouldOpen = typeof forceOpen === 'boolean'
                ? forceOpen
                : !sidebar.classList.contains('open');

            sidebar.classList.toggle('open', shouldOpen);
            sidebarOverlay.classList.toggle('show', shouldOpen);
            menuButton.setAttribute('aria-expanded', String(shouldOpen));
        }

        menuButton.addEventListener('click', () => toggleSidebar());
        sidebarOverlay.addEventListener('click', () => toggleSidebar(false));
        sidebarClose.addEventListener('click', () => toggleSidebar(false));
    </script>
</body>
</html>
