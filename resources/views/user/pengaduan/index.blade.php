<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaduan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/shared/app-user.css') }}">
    <style>
        :root {
            --page-bg: #efefef;
            --card-border: #d5d5d5;
            --text: #202020;
            --muted: #767676;
            --blue-bg: #dfeafc;
            --blue-text: #3c6bcf;
            --green-bg: #dff5e8;
            --green-text: #2b875e;
            --input-bg: #f3f3f3;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            background: var(--page-bg);
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            color: var(--text);
        }

        a { color: inherit; text-decoration: none; }

        .navbar {
            min-height: 50px;
            border-bottom: 1px solid #e8e8e8;
            background: #fff;
        }

        .navbar .inner {
            max-width: 1200px;
            margin: 0 auto;
            padding: 14px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
        }

        .brand {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            color: #1d4ed8;
            font-size: 15px;
            font-weight: 700;
        }

        .brand svg { flex: 0 0 auto; }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 28px;
            color: #222;
            font-size: 13px;
        }

        .nav-links a { padding: 4px 0; }
        .nav-links a:hover,
        .nav-links a.active { color: #1d4ed8; }

        .page-header {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px 32px 16px;
        }

        .page-header h1 {
            margin: 0;
            color: #1742b5;
            font-size: 22px;
            line-height: 1.2;
        }

        .list-wrapper {
            max-width: 1200px;
            min-height: 529px;
            margin: 0 auto 32px;
            padding: 8px 42px 40px;
            background: #fff;
        }

        .report-link { display: block; }

        .report-card {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
            min-height: 118px;
            margin: 0 0 16px;
            padding: 18px 18px;
            border: 1px solid #aaa;
            border-radius: 15px;
            background: #fff;
            transition: border-color .15s ease, box-shadow .15s ease;
        }

        .report-card:hover {
            border-color: #6d6d6d;
            box-shadow: 0 2px 8px rgba(0, 0, 0, .06);
        }

        .report-info { min-width: 0; }
        .report-id { margin-bottom: 16px; color: #666; font-size: 12px; }
        .report-title { margin-bottom: 18px; font-size: 18px; font-weight: 700; overflow-wrap: anywhere; }
        .report-date { color: #666; font-size: 12px; font-weight: 600; }

        .report-status {
            display: flex;
            flex: 0 0 280px;
            flex-direction: column;
            align-items: flex-end;
            gap: 10px;
        }

        .badge {
            display: inline-flex;
            min-width: 118px;
            justify-content: center;
            padding: 9px 16px;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 700;
        }

        .badge-proses { background: var(--blue-bg); color: var(--blue-text); }
        .badge-selesai { background: var(--green-bg); color: var(--green-text); }
        .badge-ditolak { background: #fde8e8; color: #e33434; }
        .reason-text { color: #bdbdbd; font-size: 12px; text-align: right; }

        .empty-state {
            display: flex;
            min-height: 300px;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            color: #aaa;
            text-align: center;
        }

        .empty-state svg { color: #c7c7c7; }
        .empty-state p { margin: 8px 0 4px; font-size: 17px; }
        .new-report { color: #1d4ed8; font-size: 14px; }

        @media (max-width: 700px) {
            .navbar .inner { padding: 12px 16px; }
            .nav-links { gap: 14px; font-size: 11px; }
            .page-header { padding: 20px 16px 14px; }
            .list-wrapper { margin: 0 8px 24px; padding: 8px 14px 28px; }
            .report-card { align-items: flex-start; flex-direction: column; gap: 16px; }
            .report-status { flex-basis: auto; width: 100%; align-items: flex-start; }
            .reason-text { text-align: left; }
        }
    </style>
</head>
<body>
<nav class="navbar"><div class="inner"><div class="nav-left"><a href="{{ route('frontend.index') }}" class="brand"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#1d4ed8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="M9 12l2 2 4-4"/></svg><span class="brand-name">E-Safe School</span></a></div><div class="nav-links"><a href="{{ route('frontend.index') }}">Beranda</a><a href="{{ url('/lost-and-found') }}">Lost &amp; Found</a><a href="{{ route('complaints.user.index') }}" class="active">Pengaduan</a></div></div></nav>
<div class="page-header"><h1>Pengaduan Saya</h1></div>
<div class="list-wrapper" id="reportList">
@forelse($reports as $report)
@php($statusName = strtolower($statuses[$report->status_id]->status_name ?? 'sedang diproses'))
@php($statusClass = str_contains($statusName, 'selesai') ? 'badge-selesai' : (str_contains($statusName, 'tolak') ? 'badge-ditolak' : 'badge-proses'))
<a href="{{ route('complaints.user.show', $report->id) }}" class="report-link" aria-label="Lihat detail laporan {{ $report->judul }}">
    <div class="report-card"><div class="report-info"><div class="report-id">#{{ strtolower(substr($report->id, 0, 8)) }}</div><div class="report-title">{{ $report->judul }}</div><div class="report-date">{{ optional($report->created_at)->locale('id')->translatedFormat('j F Y, H.i') }} WIB</div></div><div class="report-status"><span class="badge {{ $statusClass }}">{{ $statuses[$report->status_id]->status_name ?? 'Sedang Diproses' }}</span>@if($statusClass === 'badge-ditolak')<span class="reason-text">Status laporan ditolak oleh petugas.</span>@endif</div></div>
</a>
@empty
<div class="empty-state"><svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3v10"/><path d="M8 9l4 4 4-4"/><path d="M4 15v3a2 2 0 002 2h12a2 2 0 002-2v-3"/></svg><p>Belum ada pengaduan</p><a href="{{ route('complaints.user.create') }}" class="new-report">Buat Pengaduan</a></div>
@endforelse
</div>
</body>
</html>
