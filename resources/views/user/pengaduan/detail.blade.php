<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Laporan Saya - E-Safe School</title>
    <style>
        :root {
            --blue-700: #1d4ed8;
            --blue-100: #dbeafe;
            --green-bg: #dcfce7;
            --green-text: #15803d;
            --amber-bg: #fef3c7;
            --amber-text: #a16207;
            --red-bg: #fee2e2;
            --red-text: #dc2626;
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
        .badge-ditolak { background: var(--red-bg); color: var(--red-text); }

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
            font-size: 14px;
            color: var(--slate-500);
        }

        .description-block p {
            margin: 0;
            line-height: 1.7;
            color: var(--slate-700);
            white-space: pre-line;
        }

        .timeline {
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .timeline-item {
            position: relative;
            display: flex;
            gap: 12px;
            padding-bottom: 18px;
        }

        .timeline-item:last-child {
            padding-bottom: 0;
        }

        .timeline-item:not(:last-child)::before {
            content: "";
            position: absolute;
            left: 9px;
            top: 18px;
            bottom: -5px;
            width: 2px;
            background: var(--slate-200);
        }

        .timeline-dot {
            position: relative;
            z-index: 1;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            background: #22c55e;
            border: 2px solid white;
            box-shadow: 0 0 0 2px rgba(34,197,94,0.12);
            flex-shrink: 0;
            margin-top: 2px;
        }

        .timeline-content h4 {
            margin: 0;
            font-size: 14px;
            color: var(--slate-900);
        }

        .timeline-content time {
            display: block;
            margin-top: 4px;
            font-size: 12px;
            color: var(--slate-400);
        }

        .timeline-content p {
            margin: 8px 0 0;
            font-size: 13px;
            line-height: 1.6;
            color: var(--slate-600);
        }

        .back-link {
            display: inline-block;
            margin-top: 24px;
            padding: 10px 16px;
            border-radius: 10px;
            background: var(--slate-900);
            color: var(--white);
            font-weight: 600;
            font-size: 13px;
        }

        @media (max-width: 820px) {
            .content-grid { grid-template-columns: 1fr; }
            .report-main { grid-template-columns: 1fr; }
            .facts { grid-template-columns: 1fr 1fr; }
        }

        @media (max-width: 540px) {
            .nav-links { display: none; }
            .page { padding-left: 16px; padding-right: 16px; }
            .card { padding: 18px; }
            .facts { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
<nav class="topbar">
    <div class="topbar-inner">
        <div class="brand">
            <svg class="brand-mark" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                <path d="M9 12l2 2 4-4"/>
            </svg>
            <span>E-Safe School</span>
        </div>
        <div class="nav-links">
            <a href="{{ route('frontend.index') }}">Beranda</a>
            <a href="{{ url('/lost-and-found') }}">Lost &amp; Found</a>
            <a href="{{ route('complaints.user.index') }}" class="active">Pengaduan</a>
        </div>
    </div>
</nav>

<main class="page">
    <nav class="breadcrumbs" aria-label="Breadcrumb">
        <span>Beranda</span>
        <span>›</span>
        <span>Riwayat Pengaduan</span>
        <span>›</span>
        <span class="crumb-current">Detail</span>
    </nav>

    <h1 class="page-title">Detail Laporan Saya</h1>

    <div class="content-grid">
        <section class="card">
            <div class="status-row">
                @php($statusName = $status?->status_name ?? 'Sedang Diproses')
                @php($statusClass = str_contains(strtolower($statusName), 'selesai') ? 'badge-selesai' : (str_contains(strtolower($statusName), 'tolak') ? 'badge-ditolak' : 'badge-proses'))
                <span class="badge {{ $statusClass }}">{{ $statusName }}</span>
                <span class="report-id">#{{ strtolower(substr($report->id, 0, 8)) }}</span>
            </div>

            <div class="report-main">
                <div class="photo-box">
                    @if($report->foto)
                        <img src="{{ asset('storage/' . $report->foto) }}" alt="Foto laporan {{ $report->judul }}">
                    @else
                        <div class="placeholder">
                            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                                <path d="M4 7h3l1.6-2h6.8L17 7h3a1 1 0 011 1v10a1 1 0 01-1 1H4a1 1 0 01-1-1V8a1 1 0 011-1z" stroke-linejoin="round"/>
                                <circle cx="12" cy="13" r="3.25"/>
                            </svg>
                            <span>Tidak ada foto</span>
                        </div>
                    @endif
                </div>

                <div>
                    <h2 class="report-title">{{ $report->judul }}</h2>
                    <p class="report-date">Dilaporkan pada {{ optional($report->created_at)->locale('id')->translatedFormat('j F Y, H.i') }} WIB</p>

                    <div class="facts">
                        <div>
                            <span class="fact-label">Kategori Pengaduan</span>
                            <div class="fact-value">{{ $report->judul }}</div>
                        </div>
                        <div>
                            <span class="fact-label">Lokasi Kejadian</span>
                            <div class="fact-value">{{ $report->lokasi }}</div>
                        </div>
                        <div>
                            <span class="fact-label">Waktu Kejadian</span>
                            <div class="fact-value">{{ optional($report->created_at)->locale('id')->translatedFormat('j F Y, H.i') }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="description-block">
                <h3>Deskripsi Kejadian</h3>
                <p>{{ $report->deskripsi }}</p>
            </div>
        </section>

        <aside class="card">
            <h3 style="margin:0 0 18px; font-size:16px; color:var(--slate-900);">Riwayat status laporan</h3>
            @php($timeline = [
                ['judul' => 'Laporan Telah Dikirim', 'waktu' => optional($report->created_at)->locale('id')->translatedFormat('j F Y, H.i'), 'deskripsi' => 'Laporan terkirim dan menunggu verifikasi.'],
                ['judul' => 'Laporan Telah Diterima', 'waktu' => optional($report->updated_at)->locale('id')->translatedFormat('j F Y, H.i'), 'deskripsi' => 'Laporan telah diterima dan diverifikasi.'],
                ['judul' => 'Sedang Ditindaklanjuti', 'waktu' => optional($report->updated_at)->locale('id')->translatedFormat('j F Y, H.i'), 'deskripsi' => 'Pihak sekolah sedang menindaklanjuti laporan.'],
                ['judul' => 'Laporan Selesai', 'waktu' => optional($report->updated_at)->locale('id')->translatedFormat('j F Y, H.i'), 'deskripsi' => 'Laporan telah diselesaikan sesuai tindak lanjut.'],
            ])
            <ul class="timeline">
                @foreach($timeline as $item)
                    <li class="timeline-item">
                        <span class="timeline-dot" aria-hidden="true"></span>
                        <div class="timeline-content">
                            <h4>{{ $item['judul'] }}</h4>
                            <time>{{ $item['waktu'] }} WIB</time>
                            <p>{{ $item['deskripsi'] }}</p>
                        </div>
                    </li>
                @endforeach
            </ul>
        </aside>
    </div>

    <a href="{{ route('complaints.user.index') }}" class="back-link">Kembali ke daftar laporan</a>
</main>
</body>
</html>
