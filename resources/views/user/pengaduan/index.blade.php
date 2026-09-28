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
            --page-bg: #f4f6fb;
            --card-bg: #ffffff;
            --card-border: #e5e7eb;
            --navy: #16215c;
            --text: #1f2937;
            --muted: #6b7280;
            --blue: #2f6fed;
            --blue-bg: #dfeafc;
            --blue-text: #3c6bcf;
            --green-bg: #e4f8ee;
            --green-text: #1daa6b;
            --grey-bg: #eceef1;
            --grey-text: #5b6472;
            --red-bg: #fde8e8;
            --red-text: #e33434;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            background: var(--page-bg);
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            color: var(--text);
        }

        a { color: inherit; text-decoration: none; }

        .page-shell { max-width: 1200px; margin: 24px auto 42px; padding: 0 24px; }
        .page-header { display: flex; align-items: center; justify-content: space-between; gap: 18px; margin-bottom: 20px; }
        .eyebrow { margin: 0 0 6px; color: var(--blue); font-size: 12px; font-weight: 700; letter-spacing: .08em; text-transform: uppercase; }
        .page-header h1 { margin: 0; font-size: 22px; line-height: 1.2; }
        .primary-btn { display: inline-flex; align-items: center; justify-content: center; min-height: 42px; padding: 0 18px; border: 0; border-radius: 10px; background: var(--navy); color: #fff; font-size: 13px; font-weight: 700; box-shadow: 0 8px 18px rgba(22, 33, 92, .18); }
        .toolbar { display: flex; align-items: center; gap: 16px; margin-bottom: 22px; }
        .search { display: flex; align-items: center; gap: 10px; flex: 1; min-height: 44px; padding: 0 14px; border: 1px solid var(--card-border); border-radius: 12px; background: #fff; color: var(--muted); }
        .search input { width: 100%; border: 0; outline: none; background: transparent; color: var(--text); font-size: 14px; }
        .list-grid { display: grid; grid-template-columns: 1fr; gap: 14px; }
        .report-link { display: block; }
        .report-card { display: flex; align-items: center; justify-content: space-between; gap: 24px; min-height: 118px; padding: 18px; border: 1px solid var(--card-border); border-radius: 16px; background: var(--card-bg); box-shadow: 0 2px 10px rgba(15, 23, 42, .03); transition: transform .18s ease, box-shadow .18s ease; }
        .report-card:hover { transform: translateY(-2px); box-shadow: 0 12px 24px rgba(15, 23, 42, .08); }
        .report-card[hidden] { display: none; }
        .report-info { min-width: 0; }
        .report-id { margin-bottom: 8px; color: var(--muted); font-size: 12px; }
        .report-title { margin: 0 0 8px; font-size: 15px; font-weight: 700; overflow-wrap: anywhere; }
        .report-date { margin: 0; color: var(--muted); font-size: 12px; }
        .report-status { display: flex; flex: 0 0 220px; flex-direction: column; align-items: flex-end; gap: 8px; }
        .badge { display: inline-flex; min-width: 118px; justify-content: center; padding: 7px 12px; border-radius: 999px; font-size: 12px; font-weight: 700; }
        .badge-proses { background: var(--blue-bg); color: var(--blue-text); }
        .badge-selesai { background: var(--green-bg); color: var(--green-text); }
        .badge-ditolak { background: var(--red-bg); color: var(--red-text); }
        .reason-text { color: var(--muted); font-size: 12px; text-align: right; }
        .list-end { margin: 18px 0 0; color: var(--muted); font-size: 12px; text-align: center; }
        .empty-state { display: flex; min-height: 300px; grid-column: 1 / -1; align-items: center; justify-content: center; flex-direction: column; padding: 52px 20px; border: 1px dashed var(--card-border); border-radius: 16px; background: #fff; color: var(--muted); text-align: center; }
        .empty-state svg { color: #b6bfd6; }
        .empty-state strong { display: block; margin: 12px 0 8px; color: var(--text); font-size: 18px; }
        .empty-state span { font-size: 13px; }
        .no-results { display: none; padding: 24px; color: var(--muted); text-align: center; }
        .no-results.visible { display: block; }
        @media (max-width: 860px) { .page-shell { padding: 0 18px; } }
        @media (max-width: 600px) {
            .page-shell { margin-top: 18px; }
            .page-header { align-items: flex-start; flex-direction: column; }
            .primary-btn { width: 100%; }
            .toolbar { flex-direction: column; align-items: stretch; }
            .report-card { align-items: flex-start; flex-direction: column; gap: 16px; }
            .report-status { flex-basis: auto; width: 100%; align-items: flex-start; }
            .reason-text { text-align: left; }
        }
    </style>
</head>
<body>
    @include('layouts.sidebar-user')

    <x-navbar active="pengaduan" />

    <main class="page-shell">
        <header class="page-header">
            <div>
                <p class="eyebrow">Riwayat Pengaduan</p>
                <h1>Pengaduan</h1>
            </div>
            <a class="primary-btn" href="{{ route('complaints.user.create') }}">Buat Pengaduan</a>
        </header>

        <div class="toolbar">
            <label class="search" aria-label="Cari pengaduan">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input id="complaintSearch" type="search" placeholder="Cari pengaduan...">
            </label>
        </div>

        <section class="list-grid" aria-label="Daftar pengaduan">
            @forelse($reports as $report)
            @php
                $statusName = strtolower($statuses[$report->status_id]->status_name ?? 'diajukan');

                if (str_contains($statusName, 'selesai') || str_contains($statusName, 'finish') || str_contains($statusName, 'done') || str_contains($statusName, 'complete')) {
                    $statusClass = 'badge-selesai';
                    $statusLabel = 'Selesai';
                } elseif (str_contains($statusName, 'tolak') || str_contains($statusName, 'reject')) {
                    $statusClass = 'badge-ditolak';
                    $statusLabel = 'Ditolak';
                } elseif (str_contains($statusName, 'proses') || str_contains($statusName, 'process')) {
                    $statusClass = 'badge-proses';
                    $statusLabel = 'Sedang Diproses';
                } else {
                    $statusClass = 'badge-proses';
                    $statusLabel = 'Diajukan';
                }

                $reportCode = '#'.strtolower(substr((string) $report->id, 0, 8));
                $rejectionReason = $report->getAttribute('alasan_penolakan') ?? $report->getAttribute('alasan');
            @endphp
            <a href="{{ route('complaints.user.show', $report->id) }}" class="report-link report-card" data-search="{{ strtolower($report->judul.' '.$report->id.' '.$reportCode) }}" aria-label="Lihat detail pengaduan {{ $report->judul }}">
                <div class="report-info">
                    <div class="report-id">{{ $reportCode }}</div>
                    <h2 class="report-title">{{ $report->judul }}</h2>
                    <p class="report-date">{{ optional($report->created_at)->locale('id')->translatedFormat('j F Y, H.i') }} WIB</p>
                </div>
                <div class="report-status">
                    <span class="badge {{ $statusClass }}">{{ $statusLabel }}</span>
                    @if($statusClass === 'badge-ditolak' && $rejectionReason)
                        <span class="reason-text">Alasan : {{ $rejectionReason }}</span>
                    @endif
                </div>
            </a>
            @empty
                <div class="empty-state">
                    <svg width="42" height="42" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                        <path d="M7 3h7l5 5v11a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2z" />
                        <path d="M14 3v5h5M8 13h8M8 17h6" />
                    </svg>
                    <strong>Belum ada pengaduan</strong>
                    <span>Pengaduan yang kamu buat akan muncul di sini.</span>
                </div>
            @endforelse
        </section>
        @if($reports->isNotEmpty())
            <p class="list-end" id="listEnd">Tidak ada lagi data</p>
            <p class="no-results" id="noResults">Tidak ada pengaduan yang cocok dengan pencarian.</p>
        @endif
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

        const searchInput = document.getElementById('complaintSearch');
        const reportCards = [...document.querySelectorAll('.report-card')];
        const listEnd = document.getElementById('listEnd');
        const noResults = document.getElementById('noResults');

        searchInput?.addEventListener('input', (event) => {
            const term = event.target.value.toLowerCase().trim();
            let visibleCount = 0;

            reportCards.forEach((card) => {
                const matches = term === '' || card.dataset.search.includes(term);
                card.hidden = !matches;
                visibleCount += matches ? 1 : 0;
            });

            if (listEnd) {
                listEnd.hidden = term !== '';
            }
            noResults?.classList.toggle('visible', term !== '' && visibleCount === 0);
        });
    </script>
</body>
</html>