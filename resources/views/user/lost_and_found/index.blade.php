<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Lost &amp; Found - E-Safe School</title>
<style>
  :root { --primary:#2b2fa3; --primary-dark:#23277f; --bg-page:#eef6f4; --bg-white:#fff; --border:#e1e4ea; --text-dark:#1a1a2e; --text-muted:#8a8f98; }
  * { box-sizing:border-box; }
  body { margin:0; min-height:100vh; background:var(--bg-page); color:var(--text-dark); font-family:-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Helvetica,Arial,sans-serif; }
  a { color:inherit; }
  header.topbar { display:flex; align-items:center; gap:20px; padding:14px 24px; background:#fff; border-bottom:3px solid var(--primary); }
  .menu-icon { color:#333; font-size:20px; line-height:0; }
  .brand { display:flex; align-items:center; gap:8px; color:var(--primary); font-size:18px; font-weight:700; text-decoration:none; }
  .brand svg { flex-shrink:0; }
  nav.main-nav { display:flex; gap:28px; margin-left:24px; font-size:14px; }
  nav.main-nav a { padding:4px 0; color:#444; text-decoration:none; }
  nav.main-nav a.active { border-bottom:2px solid var(--primary); color:var(--primary); font-weight:600; }
  .page-title-bar { padding:20px 32px 16px; }
  .page-title-bar h1 { margin:0; color:var(--primary); font-size:22px; }
  main { max-width:900px; margin:0 auto 40px; padding:0 32px; }
  .report-list { display:flex; flex-direction:column; gap:14px; }
  .report-card { display:flex; align-items:center; justify-content:space-between; gap:16px; padding:18px 22px; background:var(--bg-white); border:1px solid var(--border); border-radius:10px; }
  .report-id { margin-bottom:6px; color:var(--text-muted); font-size:12px; }
  .report-name { margin-bottom:8px; color:var(--text-dark); font-size:15px; font-weight:700; }
  .report-date { color:var(--text-muted); font-size:12px; font-weight:600; }
  .status-badge { flex-shrink:0; padding:9px 18px; border-radius:20px; font-size:13px; font-weight:700; white-space:nowrap; }
  .status-diproses { background:#dbe6fb; color:#2c5cc5; }
  .status-ditemukan { background:#d7f3e0; color:#1e8a4c; }
  .status-dikembalikan { background:#fbe6bd; color:#b8791a; }
  .end-of-list { padding:30px 0 10px; color:var(--text-muted); font-size:13px; font-weight:600; text-align:center; }
  .end-of-list svg { display:block; margin:0 auto 8px; color:#b7bcc6; }
  .empty-state { padding:70px 24px; background:var(--bg-white); border:1px solid var(--border); border-radius:10px; color:var(--text-muted); text-align:center; }
  .empty-state svg { margin-bottom:14px; color:#c3c8d1; }
  .empty-title { margin-bottom:6px; color:var(--text-dark); font-size:15px; font-weight:600; }
  .empty-sub { margin-bottom:20px; color:var(--text-muted); font-size:13px; }
  .cta-btn { display:inline-block; padding:10px 22px; border:0; border-radius:8px; background:var(--primary); color:#fff; font-size:14px; font-weight:600; text-decoration:none; }
  .cta-btn:hover { background:var(--primary-dark); }
  .pagination { display:flex; justify-content:center; margin-top:20px; }
  @media (max-width:640px) { nav.main-nav { display:none; } main { padding:0 16px; } .page-title-bar { padding-right:16px; padding-left:16px; } .report-card { align-items:flex-start; flex-direction:column; } .status-badge { align-self:flex-start; } }
</style>
</head>
<body>
<header class="topbar">
  <span class="menu-icon">&#9776;</span>
  <a href="{{ route('frontend.index') }}" class="brand">
    <svg width="22" height="22" viewBox="0 0 24 24" fill="none"><path d="M12 2L4 5v6c0 5.5 3.4 9.7 8 11 4.6-1.3 8-5.5 8-11V5l-8-3z" stroke="currentColor" stroke-width="1.8"/><path d="M9 12l2 2 4-4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
    E-Safe School
  </a>
  <nav class="main-nav">
    <a href="{{ route('frontend.index') }}">Beranda</a>
    <a href="{{ route('item_reports.user.index') }}" class="active">Lost &amp; Found</a>
    <a href="{{ route('complaints.user.index') }}">Pengaduan</a>
  </nav>
</header>
<div class="page-title-bar"><h1>Lost &amp; Found</h1></div>
<main>
  @if ($reports->count())
    <div class="report-list">
      @foreach ($reports as $report)
        @php
          $statusName = strtolower($report->status?->status_name ?? 'diproses');
          $statusClass = str_contains($statusName, 'kembali') ? 'status-dikembalikan' : (str_contains($statusName, 'selesai') || str_contains($statusName, 'temu') ? 'status-ditemukan' : 'status-diproses');
          $statusLabel = str_contains($statusName, 'kembali') ? 'Dikembalikan' : (str_contains($statusName, 'selesai') || str_contains($statusName, 'temu') ? 'Ditemukan' : 'Sedang Diproses');
        @endphp
        <article class="report-card">
          <div>
            <div class="report-id">#{{ $report->id }}</div>
            <div class="report-name">{{ $report->nama_barang }}</div>
            <div class="report-date">{{ optional($report->created_at)->locale('id')->translatedFormat('j F Y, H.i') }} WIB</div>
          </div>
          <span class="status-badge {{ $statusClass }}">{{ $statusLabel }}</span>
        </article>
      @endforeach
    </div>
    @if ($reports->hasMorePages())
      <div class="pagination">{{ $reports->links() }}</div>
    @else
      <div class="end-of-list"><svg width="26" height="26" viewBox="0 0 24 24" fill="none"><path d="M12 16V4M12 4l-4 4M12 4l4 4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/><path d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>Tidak ada lagi data</div>
    @endif
  @else
    <div class="empty-state">
      <svg width="40" height="40" viewBox="0 0 24 24" fill="none"><path d="M12 16V4M12 4l-4 4M12 4l4 4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/><path d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
      <div class="empty-title">Belum ada laporan</div>
      <div class="empty-sub">Laporan barang hilang atau ditemukan akan muncul di sini.</div>
      <a class="cta-btn" href="{{ route('item_reports.user.create') }}">Buat Laporan Baru</a>
    </div>
  @endif
</main>
</body>
</html>
