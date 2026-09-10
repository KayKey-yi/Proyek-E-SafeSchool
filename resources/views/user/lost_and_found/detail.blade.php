<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Laporan Lost & Found - E-Safe School</title>
    <style>
        :root {
            --blue-700: #1d4ed8;
            --blue-100: #dbeafe;
            --green-bg: #dcfce7;
            --green-text: #15803d;
            --amber-bg: #fef3c7;
            --amber-text: #a16207;
            --slate-50: #f5f7fb;
            --slate-100: #edf2f7;
            --slate-200: #dfe6ee;
            --slate-400: #94a3b8;
            --slate-500: #64748b;
            --slate-700: #334155;
            --slate-900: #0f172a;
            --white: #ffffff;
        }

        * { box-sizing: border-box; }
        body {
            margin: 0;
            min-height: 100vh;
            font-family: "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            background: var(--slate-50);
            color: var(--slate-900);
        }

        a { text-decoration: none; color: inherit; }

        .topbar {
            background: var(--white);
            border-bottom: 1px solid var(--slate-200);
        }

        .topbar-inner {
            max-width: 1200px;
            margin: 0 auto;
            padding: 16px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .brand {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            font-weight: 700;
            color: var(--blue-700);
        }

        .brand-mark {
            width: 18px;
            height: 18px;
            display: inline-block;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 30px;
            font-size: 14px;
            color: var(--slate-500);
            font-weight: 500;
        }

        .nav-links a.active,
        .nav-links a:hover {
            color: var(--blue-700);
        }

        .page {
            max-width: 1100px;
            margin: 0 auto;
            padding: 30px 24px 60px;
        }

        .breadcrumbs {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            color: var(--slate-500);
            margin-bottom: 18px;
        }

        .crumb-current {
            color: var(--slate-700);
            font-weight: 600;
        }

        .page-title {
            margin: 0 0 22px;
            color: var(--slate-900);
            font-size: clamp(24px, 2vw, 32px);
        }

        .content-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 24px;
        }

        .card {
            background: rgba(255,255,255,0.8);
            border: 1px solid var(--slate-200);
            border-radius: 18px;
            box-shadow: 0 1px 2px rgba(15, 23, 42, 0.04);
            padding: 24px;
        }

        .status-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 22px;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            border-radius: 999px;
            padding: 8px 14px;
            font-size: 13px;
            font-weight: 700;
            white-space: nowrap;
        }

        .badge-proses { background: var(--blue-100); color: var(--blue-700); }
        .badge-selesai { background: var(--green-bg); color: var(--green-text); }
        .badge-ditolak { background: #fee2e2; color: #dc2626; }

        .report-id {
            color: var(--slate-400);
            font-size: 13px;
            font-weight: 600;
        }

        .report-main {
            display: grid;
            grid-template-columns: minmax(180px, 240px) 1fr;
            gap: 22px;
            align-items: start;
        }

        .photo-box {
            width: 100%;
            height: 210px;
            border-radius: 14px;
            background: var(--slate-100);
            border: 1px solid var(--slate-200);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--slate-400);
            overflow: hidden;
        }

        .photo-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .placeholder {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 8px;
            font-size: 12px;
        }

        .report-title {
            margin: 0;
            font-size: 22px;
            color: var(--slate-900);
        }

        .report-date {
            margin-top: 6px;
            color: var(--slate-500);
            font-size: 13px;
        }

        .facts {
            display: grid;
            grid-template-columns: repeat(2, minmax(140px, 1fr));
            gap: 20px 18px;
            margin-top: 24px;
        }

        .fact-label {
            display: block;
            color: var(--slate-500);
            font-size: 13px;
            margin-bottom: 6px;
        }

        .fact-value {
            color: var(--slate-900);
            font-weight: 700;
            font-size: 15px;
        }

        .description-block {
            margin-top: 28px;
            border-top: 1px solid var(--slate-100);
            padding-top: 18px;
        }

        .description-block h3 {
            margin: 0 0 10px;
            font-size: 15px;
            color: var(--slate-700);
        }

        .description-block p {
            margin: 0;
            line-height: 1.6;
            color: var(--slate-700);
        }

        .side-card {
            display: flex;
            flex-direction: column;
            gap: 18px;
        }

        .mini-title {
            margin: 0 0 12px;
            font-size: 15px;
            color: var(--slate-700);
        }

        .meta-list {
            display: grid;
            gap: 16px;
        }

        .meta-item {
            display: grid;
            gap: 4px;
        }

        .meta-label {
            color: var(--slate-500);
            font-size: 12px;
        }

        .meta-value {
            color: var(--slate-900);
            font-weight: 700;
            font-size: 14px;
        }

        .btn-row {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 12px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            padding: 11px 16px;
            font-size: 14px;
            font-weight: 600;
            border: 1px solid transparent;
            cursor: pointer;
        }

        .btn-primary {
            background: var(--blue-700);
            color: var(--white);
        }

        .btn-secondary {
            background: var(--white);
            border-color: var(--slate-200);
            color: var(--slate-700);
        }

        @media (max-width: 820px) {
            .content-grid {
                grid-template-columns: 1fr;
            }

            .report-main {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <header class="topbar">
        <div class="topbar-inner">
            <a href="{{ route('frontend.index') }}" class="brand">
                <svg class="brand-mark" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                    <path d="M9 12l2 2 4-4"/>
                </svg>
                <span>E-Safe School</span>
            </a>
            <nav class="nav-links">
                <a href="{{ route('frontend.index') }}">Beranda</a>
                <a href="{{ url('/lost-and-found') }}" class="active">Lost &amp; Found</a>
                <a href="{{ route('complaints.user.index') }}">Pengaduan</a>
            </nav>
        </div>
    </header>

    <main class="page">
        <div class="breadcrumbs">
            <a href="{{ url('/lost-and-found') }}">Lost &amp; Found</a>
            <span>/</span>
            <span class="crumb-current">Detail Barang</span>
        </div>

        <h1 class="page-title">Detail Laporan Saya</h1>

        <div class="content-grid">
            <section class="card">
                <div class="status-row">
                    @php
                        $statusName = strtolower($status?->status_name ?? 'Diproses');
                        $badgeClass = str_contains($statusName, 'selesai') ? 'badge-selesai' : (str_contains($statusName, 'tolak') ? 'badge-ditolak' : 'badge-proses');
                    @endphp
                    <span class="badge {{ $badgeClass }}">{{ $status?->status_name ?? 'Diproses' }}</span>
                    <span class="report-id">#{{ strtolower(substr($report->id, 0, 8)) }}</span>
                </div>

                <div class="report-main">
                    <div class="photo-box">
                        @if($report->foto)
                            <img src="{{ asset('storage/' . $report->foto) }}" alt="Foto {{ $report->nama_barang }}">
                        @else
                            <div class="placeholder">
                                <svg width="42" height="42" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                                    <rect x="3" y="5" width="18" height="14" rx="2"/>
                                    <circle cx="9" cy="10" r="2"/>
                                    <path d="M5 18l4-4 3 3 3-4 4 5"/>
                                </svg>
                                <span>Foto Barang</span>
                            </div>
                        @endif
                    </div>

                    <div>
                        <h2 class="report-title">{{ $report->nama_barang }}</h2>
                        <div class="report-date">Ditemukan pada {{ \Illuminate\Support\Carbon::parse($report->tanggal ?? $report->created_at)->locale('id')->translatedFormat('j F Y') }}</div>

                        <div class="facts">
                            <div>
                                <span class="fact-label">Jenis laporan</span>
                                <span class="fact-value">{{ $report->jenis_laporan ?? 'Lost & Found' }}</span>
                            </div>
                            <div>
                                <span class="fact-label">Kategori</span>
                                <span class="fact-value">{{ $report->kategori_barang ?: '-' }}</span>
                            </div>
                            <div>
                                <span class="fact-label">Merek</span>
                                <span class="fact-value">{{ $report->merek ?: '-' }}</span>
                            </div>
                            <div>
                                <span class="fact-label">Warna</span>
                                <span class="fact-value">{{ $report->warna ?: '-' }}</span>
                            </div>
                        </div>

                        <div class="description-block">
                            <h3>Ciri-ciri barang</h3>
                            <p>{{ $report->ciri_ciri ?: 'Tidak ada deskripsi ciri-ciri yang dicatat.' }}</p>
                        </div>
                    </div>
                </div>
            </section>

            <aside class="card side-card">
                <div>
                    <h3 class="mini-title">Informasi laporan</h3>
                    <div class="meta-list">
                        <div class="meta-item">
                            <span class="meta-label">Lokasi</span>
                            <span class="meta-value">{{ $report->lokasi ?: '-' }}</span>
                        </div>
                        <div class="meta-item">
                            <span class="meta-label">Tanggal lapor</span>
                            <span class="meta-value">{{ \Illuminate\Support\Carbon::parse($report->created_at)->locale('id')->translatedFormat('j F Y') }}</span>
                        </div>
                        <div class="meta-item">
                            <span class="meta-label">Pelapor</span>
                            <span class="meta-value">{{ $report->is_anonymous ? 'Anonim' : (auth()->user()->name ?? 'Saya') }}</span>
                        </div>
                    </div>
                </div>

                <div>
                    <h3 class="mini-title">Tindakan</h3>
                    <div class="btn-row">
                        <a href="{{ url('/lost-and-found') }}" class="btn btn-secondary">Kembali</a>
                        <a href="{{ route('item_reports.user.index') }}" class="btn btn-primary">Lihat semua laporan</a>
                    </div>
                </div>
            </aside>
        </div>
    </main>
</body>
</html>
