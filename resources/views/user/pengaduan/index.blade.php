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
