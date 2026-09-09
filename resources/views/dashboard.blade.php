@extends('layouts.app')

@section('page-css')
    <style>
        :root {
            --navy-900: #0b1e3d;
            --navy-800: #122a54;
            --navy-active: #1c3766;
            --bg-page: #f3f6fb;
            --card-bg: #ffffff;
            --text-dark: #16233f;
            --text-muted: #7b8aa3;
            --border-soft: #e7ecf3;
            --blue: #3b82f6;
            --blue-bg: #e8f0fe;
            --green: #16a34a;
            --green-bg: #e6f7ec;
            --purple: #7c3aed;
            --purple-bg: #f0e9fd;
            --orange: #f59e0b;
            --orange-bg: #fef3e0;
        }

        .dashboard-page * {
            box-sizing: border-box;
        }

        .dashboard-page {
            background: var(--bg-page);
            color: var(--text-dark);
            border-radius: 18px;
            overflow: hidden;
        }

        .dashboard-page .app-content {
            padding: 28px 32px;
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        .dashboard-page .topbar {
            background: #fff;
            border-bottom: 1px solid var(--border-soft);
            padding: 18px 32px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .dashboard-page .topbar-title h1 {
            margin: 0;
            font-size: 20px;
        }

        .dashboard-page .topbar-title p {
            margin: 2px 0 0;
            font-size: 13px;
            color: var(--text-muted);
        }

        .dashboard-page .topbar-actions {
            display: flex;
            align-items: center;
            gap: 18px;
        }

        .dashboard-page .search-box {
            display: flex;
            align-items: center;
            gap: 8px;
            background: var(--bg-page);
            border-radius: 10px;
            padding: 9px 14px;
            color: var(--text-muted);
            min-width: 220px;
        }

        .dashboard-page .search-box input {
            border: none;
            background: transparent;
            outline: none;
            font-size: 14px;
            width: 100%;
        }

        .dashboard-page .icon-btn {
            background: var(--bg-page);
            border: none;
            border-radius: 10px;
            width: 38px;
            height: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: var(--text-dark);
        }

        .dashboard-page .user-chip {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .dashboard-page .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: var(--navy-900);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
        }

        .dashboard-page .user-meta {
            display: flex;
            flex-direction: column;
            line-height: 1.2;
        }

        .dashboard-page .user-greeting {
            font-size: 13.5px;
            font-weight: 600;
        }

        .dashboard-page .user-role {
            font-size: 12px;
            color: var(--text-muted);
        }

        .dashboard-page .welcome-banner {
            background: #fff;
            border-radius: 18px;
            padding: 26px 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 10px rgba(15, 30, 60, 0.05);
        }

        .dashboard-page .welcome-text h2 {
            margin: 0 0 6px;
            font-size: 21px;
        }

        .dashboard-page .welcome-text p {
            margin: 0;
            color: var(--text-muted);
            font-size: 14px;
            max-width: 420px;
        }

        .dashboard-page .welcome-illustration {
            font-size: 46px;
            color: var(--navy-900);
            opacity: 0.85;
        }

        .dashboard-page .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 18px;
        }

        .dashboard-page .stat-card {
            background: #fff;
            border-radius: 16px;
            padding: 20px;
            display: flex;
            align-items: flex-start;
            gap: 14px;
            box-shadow: 0 2px 10px rgba(15, 30, 60, 0.05);
        }

        .dashboard-page .stat-icon {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            flex-shrink: 0;
        }

        .dashboard-page .stat-icon--blue   { background: var(--blue-bg);   color: var(--blue); }
        .dashboard-page .stat-icon--green  { background: var(--green-bg);  color: var(--green); }
        .dashboard-page .stat-icon--purple { background: var(--purple-bg); color: var(--purple); }
        .dashboard-page .stat-icon--orange { background: var(--orange-bg); color: var(--orange); }

        .dashboard-page .stat-info {
            display: flex;
            flex-direction: column;
        }

        .dashboard-page .stat-number {
            font-size: 22px;
            font-weight: 700;
            line-height: 1.2;
        }

        .dashboard-page .stat-label {
            font-size: 13.5px;
            font-weight: 600;
            margin-top: 2px;
        }

        .dashboard-page .stat-desc {
            font-size: 12px;
            color: var(--text-muted);
            margin-top: 2px;
        }

        .dashboard-page .content-grid {
            display: grid;
            grid-template-columns: 1.4fr 1fr;
            gap: 20px;
            align-items: start;
        }

        .dashboard-page .panel {
            background: #fff;
            border-radius: 18px;
            padding: 22px 24px;
            box-shadow: 0 2px 10px rgba(15, 30, 60, 0.05);
        }

        .dashboard-page .panel-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 14px;
        }

        .dashboard-page .panel-header h3 {
            margin: 0;
            font-size: 16px;
        }

        .dashboard-page .panel-link {
            font-size: 12.5px;
            color: #fff;
            background: var(--blue);
            padding: 5px 12px;
            border-radius: 999px;
        }

        .dashboard-page .timeline {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            gap: 18px;
        }

        .dashboard-page .timeline-item {
            display: flex;
            gap: 12px;
        }

        .dashboard-page .timeline-icon {
            width: 34px;
            height: 34px;
            border-radius: 10px;
            background: var(--bg-page);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-dark);
            flex-shrink: 0;
        }

        .dashboard-page .timeline-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
        }

        .dashboard-page .timeline-title {
            font-size: 14px;
            font-weight: 600;
        }

        .dashboard-page .timeline-desc {
            margin: 4px 0 2px;
            font-size: 13px;
            color: var(--text-muted);
        }

        .dashboard-page .timeline-time {
            font-size: 12px;
            color: var(--text-muted);
        }

        .dashboard-page .badge {
            font-size: 11px;
            font-weight: 600;
            padding: 3px 10px;
            border-radius: 999px;
            white-space: nowrap;
        }

        .dashboard-page .badge--diproses { background: var(--blue-bg);   color: var(--blue); }
        .dashboard-page .badge--menunggu { background: var(--orange-bg); color: var(--orange); }
        .dashboard-page .badge--selesai  { background: var(--green-bg);  color: var(--green); }

        .dashboard-page .info-list {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .dashboard-page .info-list li {
            display: flex;
            gap: 12px;
        }

        .dashboard-page .info-icon {
            width: 34px;
            height: 34px;
            border-radius: 10px;
            background: var(--blue-bg);
            color: var(--blue);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .dashboard-page .info-list strong {
            font-size: 14px;
        }

        .dashboard-page .info-list p {
            margin: 3px 0 0;
            font-size: 12.5px;
            color: var(--text-muted);
        }

        @media (max-width: 1100px) {
            .dashboard-page .stats-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
            .dashboard-page .content-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 720px) {
            .dashboard-page .app-content {
                padding: 20px;
            }
            .dashboard-page .stats-grid {
                grid-template-columns: 1fr;
            }
            .dashboard-page .welcome-banner {
                flex-direction: column;
                align-items: flex-start;
                gap: 16px;
            }
        }
    </style>
@endsection

@section('main')
<div class="dashboard-page">
    <div class="topbar">
        <div class="topbar-title">
            <h1>Dashboard</h1>
            <p>Ringkasan aktivitas sekolah</p>
        </div>

        <div class="topbar-actions">
            <div class="search-box">
                <span>🔎</span>
                <input type="text" placeholder="Cari data..." aria-label="Cari data" />
            </div>
            <button class="icon-btn" aria-label="Notifikasi">🔔</button>
            <div class="user-chip">
                <div class="user-avatar">{{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}</div>
                <div class="user-meta">
                    <span class="user-greeting">Halo, {{ Auth::user()->name ?? 'User' }}</span>
                    <span class="user-role">{{ session('active_role')['role'] ?? 'Admin' }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <section class="welcome-banner">
            <div class="welcome-text">
                <h2>Selamat datang kembali 👋</h2>
                <p>Semua laporan, aktivitas sekolah, dan perkembangan keamanan lingkungan kini bisa dipantau dalam satu dashboard.</p>
            </div>
            <div class="welcome-illustration" aria-hidden="true">📊</div>
        </section>

        <section class="stats-grid">
            <article class="stat-card">
                <div class="stat-icon stat-icon--blue">📩</div>
                <div class="stat-info">
                    <div class="stat-number">1.284</div>
                    <div class="stat-label">Laporan Masuk</div>
                    <div class="stat-desc">+12% dibanding bulan lalu</div>
                </div>
            </article>

            <article class="stat-card">
                <div class="stat-icon stat-icon--green">✅</div>
                <div class="stat-info">
                    <div class="stat-number">928</div>
                    <div class="stat-label">Selesai</div>
                    <div class="stat-desc">+8% dari target</div>
                </div>
            </article>

            <article class="stat-card">
                <div class="stat-icon stat-icon--purple">🧾</div>
                <div class="stat-info">
                    <div class="stat-number">146</div>
                    <div class="stat-label">Barang Hilang</div>
                    <div class="stat-desc">20 menunggu verifikasi</div>
                </div>
            </article>

            <article class="stat-card">
                <div class="stat-icon stat-icon--orange">📌</div>
                <div class="stat-info">
                    <div class="stat-number">32</div>
                    <div class="stat-label">Aktivitas Baru</div>
                    <div class="stat-desc">Perlu perhatian segera</div>
                </div>
            </article>
        </section>

        <section class="content-grid">
            <div class="panel">
                <div class="panel-header">
                    <h3>Aktivitas Terbaru</h3>
                    <a class="panel-link" href="#">Lihat Semua</a>
                </div>

                <ul class="timeline">
                    <li class="timeline-item">
                        <div class="timeline-icon">📥</div>
                        <div style="flex:1;">
                            <div class="timeline-top">
                                <span class="timeline-title">Laporan kehilangan tas</span>
                                <span class="badge badge--diproses">Diproses</span>
                            </div>
                            <p class="timeline-desc">Dibuat oleh Siti Rahma dari kelas XI IPA 2</p>
                            <span class="timeline-time">12 menit yang lalu</span>
                        </div>
                    </li>

                    <li class="timeline-item">
                        <div class="timeline-icon">⚠️</div>
                        <div style="flex:1;">
                            <div class="timeline-top">
                                <span class="timeline-title">Pengaduan kerusakan lampu</span>
                                <span class="badge badge--menunggu">Menunggu</span>
                            </div>
                            <p class="timeline-desc">Lokasi: Gedung A, lantai 2, ruang laboratorium</p>
                            <span class="timeline-time">1 jam yang lalu</span>
                        </div>
                    </li>

                    <li class="timeline-item">
                        <div class="timeline-icon">✅</div>
                        <div style="flex:1;">
                            <div class="timeline-top">
                                <span class="timeline-title">Barang ditemukan telah diklaim</span>
                                <span class="badge badge--selesai">Selesai</span>
                            </div>
                            <p class="timeline-desc">Sepatu olahraga milik Fikri berhasil dikembalikan</p>
                            <span class="timeline-time">Hari ini</span>
                        </div>
                    </li>
                </ul>
            </div>

            <div class="panel">
                <div class="panel-header">
                    <h3>Informasi Penting</h3>
                </div>

                <ul class="info-list">
                    <li>
                        <div class="info-icon">ℹ️</div>
                        <div>
                            <strong>Audit keamanan laboratorium</strong>
                            <p>Jadwal pengecekan akan dilaksanakan hari Jumat pukul 09.00.</p>
                        </div>
                    </li>
                    <li>
                        <div class="info-icon">🛡️</div>
                        <div>
                            <strong>Peraturan sekolah baru</strong>
                            <p>Setiap penemuan barang harus segera dilaporkan ke petugas keamanan.</p>
                        </div>
                    </li>
                    <li>
                        <div class="info-icon">📣</div>
                        <div>
                            <strong>Pengumuman penting</strong>
                            <p>Pelatihan pengaduan dan safety awareness dijadwalkan minggu depan.</p>
                        </div>
                    </li>
                </ul>
            </div>
        </section>
    </div>
</div>
@endsection
