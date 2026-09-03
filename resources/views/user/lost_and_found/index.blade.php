<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Lost & Found - E-Safe School</title>
    <style>
        :root { --primary: #2b2fa3; --primary-dark: #23277f; --page: #eef6f4; --ink: #1a1a2e; --muted: #727784; --line: #e1e4e9; --green: #1d8f5f; --amber: #a76700; }
        * { box-sizing: border-box; }
        body { margin: 0; background: var(--page); color: var(--ink); font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif; }
        a { color: inherit; text-decoration: none; }
        .topbar { display: flex; align-items: center; gap: 20px; padding: 14px 24px; background: #fff; border-bottom: 1px solid #eee; }
        .menu-icon { color: #333; font-size: 20px; line-height: 0; }
        .brand { display: flex; align-items: center; gap: 8px; color: var(--primary); font-size: 18px; font-weight: 700; }
        .brand svg { flex-shrink: 0; }
        .main-nav { display: flex; gap: 28px; margin-left: 24px; font-size: 14px; }
        .main-nav a { padding: 4px 0; color: #444; }
        .main-nav a.active { border-bottom: 2px solid var(--primary); color: var(--primary); font-weight: 600; }
        .page-title-bar { max-width: 1080px; margin: 0 auto; padding: 30px 32px 20px; }
        .eyebrow { margin: 0 0 6px; color: var(--green); font-size: 12px; font-weight: 700; letter-spacing: .08em; text-transform: uppercase; }
        h1 { margin: 0; color: var(--primary); font-size: 28px; }
        .intro { max-width: 620px; margin: 8px 0 0; color: var(--muted); font-size: 14px; line-height: 1.6; }
        main { max-width: 1080px; margin: 0 auto 60px; padding: 0 32px; }
        .toolbar { display: flex; align-items: center; justify-content: space-between; gap: 16px; margin-bottom: 18px; }
        .result-count { color: var(--muted); font-size: 13px; }
        .report-button { display: inline-flex; align-items: center; gap: 8px; padding: 11px 17px; border-radius: 8px; background: var(--primary); color: #fff; font-size: 13px; font-weight: 600; }
        .report-button:hover { background: var(--primary-dark); }
        .reports { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 16px; }
        .report-card { display: flex; min-width: 0; overflow: hidden; background: #fff; border: 1px solid var(--line); border-radius: 10px; box-shadow: 0 2px 5px rgba(24, 35, 60, .04); }
        .report-photo { width: 150px; min-height: 205px; flex-shrink: 0; background: #f0f2f5; }
        .report-photo img { display: block; width: 100%; height: 100%; object-fit: cover; }
        .photo-empty { display: flex; align-items: center; justify-content: center; height: 100%; color: #9aa0aa; font-size: 12px; text-align: center; }
        .report-content { min-width: 0; padding: 18px; }
        .report-head { display: flex; align-items: flex-start; justify-content: space-between; gap: 10px; }
        .report-type { margin: 0 0 5px; color: var(--primary); font-size: 11px; font-weight: 700; letter-spacing: .06em; text-transform: uppercase; }
        .report-name { margin: 0; overflow-wrap: anywhere; font-size: 18px; line-height: 1.3; }
        .status { flex-shrink: 0; padding: 5px 8px; border-radius: 999px; background: #fff3da; color: var(--amber); font-size: 11px; font-weight: 700; text-transform: capitalize; }
        .report-description { margin: 12px 0 14px; color: #555b67; font-size: 13px; line-height: 1.5; }
        .report-meta { display: grid; gap: 7px; color: var(--muted); font-size: 12px; }
        .meta-item { display: flex; gap: 7px; align-items: baseline; }
        .meta-label { width: 52px; flex-shrink: 0; color: #363b48; font-weight: 600; }
        .empty { padding: 64px 24px; border: 1px dashed #c9ced7; border-radius: 10px; background: rgba(255,255,255,.65); text-align: center; }
        .empty svg { color: var(--primary); }
        .empty h2 { margin: 14px 0 6px; font-size: 19px; }
        .empty p { margin: 0 auto 20px; max-width: 420px; color: var(--muted); font-size: 13px; line-height: 1.6; }
        .pagination { margin-top: 22px; }
        .pagination nav { display: flex; justify-content: center; }
        @media (max-width: 760px) { .main-nav { display: none; } .page-title-bar, main { padding-right: 16px; padding-left: 16px; } .reports { grid-template-columns: 1fr; } }
        @media (max-width: 480px) { .toolbar { align-items: stretch; flex-direction: column; } .report-button { justify-content: center; } .report-photo { width: 112px; } .report-content { padding: 14px; } .report-head { display: block; } .status { display: inline-block; margin-top: 10px; } }
    </style>
</head>
<body>
    <header class="topbar">
        <span class="menu-icon">&#9776;</span>
        <a href="{{ url('/') }}" class="brand">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 2L4 5v6c0 5.5 3.4 9.7 8 11 4.6-1.3 8-5.5 8-11V5l-8-3z" stroke="currentColor" stroke-width="1.8"/><path d="M9 12l2 2 4-4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
            E-Safe School
        </a>
        <nav class="main-nav">
            <a href="{{ url('/') }}">Beranda</a>
            <a href="{{ route('item_reports.user.index') }}" class="active">Riwayat Lost & Found</a>
            <a href="{{ route('item_reports.user.create') }}">Buat Laporan</a>
            <a href="{{ route('complaints.user.index') }}">Pengaduan</a>
        </nav>
    </header>

    <div class="page-title-bar">
        <p class="eyebrow">Lost & Found</p>
        <h1>Riwayat Laporan</h1>
        <p class="intro">Lihat laporan kehilangan dan temuan dari seluruh pengguna E-Safe School. Informasi ini tersimpan bersama sehingga dapat dilihat dari perangkat lain.</p>
    </div>

    <main>
        <div class="toolbar">
            <span class="result-count">{{ $reports->total() }} laporan tercatat</span>
            <a href="{{ route('item_reports.user.create') }}" class="report-button"><span aria-hidden="true">+</span> Buat Laporan</a>
        </div>

        @if ($reports->count())
            <section class="reports" aria-label="Daftar riwayat laporan">
                @foreach ($reports as $report)
                    <article class="report-card">
                        <div class="report-photo">
                            @if ($report->foto)
                                <img src="{{ asset('storage/' . $report->foto) }}" alt="Foto {{ $report->nama_barang }}">
                            @else
                                <div class="photo-empty">Tidak ada foto</div>
                            @endif
                        </div>
                        <div class="report-content">
                            <div class="report-head">
                                <div>
                                    <p class="report-type">{{ $report->jenis_laporan }}</p>
                                    <h2 class="report-name">{{ $report->nama_barang }}</h2>
                                </div>
                                <span class="status">{{ $report->status?->status_name ?? 'diproses' }}</span>
                            </div>
                            <p class="report-description">{{ $report->ciri_ciri ?: 'Tidak ada deskripsi tambahan.' }}</p>
                            <div class="report-meta">
                                <div class="meta-item"><span class="meta-label">Lokasi</span><span>{{ $report->lokasi ?: '-' }}</span></div>
                                <div class="meta-item"><span class="meta-label">Tanggal</span><span>{{ $report->tanggal ? \Carbon\Carbon::parse($report->tanggal)->translatedFormat('d F Y') : '-' }}</span></div>
                                <div class="meta-item"><span class="meta-label">Pelapor</span><span>{{ $report->is_anonymous ? 'Anonim' : ($report->user?->name ?? 'Pengguna') }}</span></div>
                            </div>
                        </div>
                    </article>
                @endforeach
            </section>
            <div class="pagination">{{ $reports->links() }}</div>
        @else
            <section class="empty">
                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M4 7.5A2.5 2.5 0 0 1 6.5 5h11A2.5 2.5 0 0 1 20 7.5v9a2.5 2.5 0 0 1-2.5 2.5h-11A2.5 2.5 0 0 1 4 16.5v-9Z"/><path d="m4 8 5.2 4.2a4.4 4.4 0 0 0 5.6 0L20 8"/></svg>
                <h2>Belum ada laporan</h2>
                <p>Riwayat akan muncul di sini setelah laporan kehilangan atau temuan pertama dibuat.</p>
                <a href="{{ route('item_reports.user.create') }}" class="report-button">Buat Laporan Pertama</a>
            </section>
        @endif
    </main>
</body>
</html>
