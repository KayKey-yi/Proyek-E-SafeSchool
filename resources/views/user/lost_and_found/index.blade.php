<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lost &amp; Found - E-Safe School</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/shared/app-user.css') }}">
    <style>
        :root {
            --page-bg: #f4f6fb;
            --card-bg: #ffffff;
            --card-border: #e5e7eb;
            --navy: #16215c;
            --navy-soft: #eef1fb;
            --text: #1f2937;
            --muted: #6b7280;
            --blue: #2f6fed;
            --green-bg: #e4f8ee;
            --green-text: #1daa6b;
            --orange-bg: #fff1df;
            --orange-text: #d28818;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            background: var(--page-bg);
            color: var(--text);
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        }

        a { text-decoration: none; color: inherit; }

        .dashboard-topbar {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 14px 24px;
            border-bottom: 1px solid var(--card-border);
            background: #fff;
        }

        .dashboard-menu-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border: 0;
            border-radius: 8px;
            background: transparent;
            color: var(--navy);
            font-size: 20px;
            cursor: pointer;
        }

        .dashboard-menu-btn:hover {
            background: #f1f5f9;
        }

        .dashboard-topbar-title {
            font-size: 16px;
            font-weight: 700;
            color: #1c1c1c;
        }

        .page-shell {
            max-width: 1200px;
            margin: 24px auto 42px;
            padding: 0 24px;
        }

        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            margin-bottom: 20px;
        }

        .eyebrow {
            margin: 0 0 6px;
            color: var(--blue);
            font-size: 12px;
            font-weight: 700;
            letter-spacing: .08em;
            text-transform: uppercase;
        }

        .page-header h1 {
            margin: 0;
            font-size: 30px;
            line-height: 1.2;
        }

        .primary-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 42px;
            padding: 0 18px;
            border: 0;
            border-radius: 10px;
            background: var(--navy);
            color: #fff;
            font-size: 13px;
            font-weight: 700;
            box-shadow: 0 8px 18px rgba(22, 33, 92, 0.18);
        }

        .toolbar {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 22px;
        }

        .search {
            display: flex;
            align-items: center;
            gap: 10px;
            flex: 1;
            min-height: 44px;
            padding: 0 14px;
            border: 1px solid var(--card-border);
            border-radius: 12px;
            background: #fff;
            color: var(--muted);
        }

        .search input {
            width: 100%;
            border: 0;
            outline: none;
            background: transparent;
            color: var(--text);
            font-size: 14px;
        }

        .list-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 20px;
        }

        .report-card {
            display: block;
            min-height: 100%;
            padding: 14px;
            border: 1px solid var(--card-border);
            border-radius: 16px;
            background: var(--card-bg);
            box-shadow: 0 2px 10px rgba(15, 23, 42, 0.03);
            transition: transform 0.18s ease, box-shadow 0.18s ease;
        }

        .report-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 24px rgba(15, 23, 42, 0.08);
        }

        .report-card[hidden] {
            display: none;
        }

        .report-image {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 150px;
            margin-bottom: 14px;
            border-radius: 12px;
            background: #f3f6fc;
            overflow: hidden;
            color: #b6bfd6;
        }

        .report-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .report-title {
            margin: 0 0 6px;
            font-size: 15px;
            font-weight: 700;
        }

        .report-text {
            margin: 0;
            color: var(--muted);
            font-size: 12.5px;
        }

        .report-date {
            margin-top: 4px;
            margin-bottom: 10px;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 10px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 700;
        }

        .status-badge .dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: currentColor;
            opacity: 0.8;
        }

        .status-pending {
            background: var(--orange-bg);
            color: var(--orange-text);
        }

        .status-done {
            background: var(--green-bg);
            color: var(--green-text);
        }

        .empty-state {
            grid-column: 1 / -1;
            padding: 52px 20px;
            border: 1px dashed var(--card-border);
            border-radius: 16px;
            background: #fff;
            text-align: center;
            color: var(--muted);
        }

        .empty-state strong {
            display: block;
            margin: 12px 0 8px;
            color: var(--text);
            font-size: 18px;
        }

        @media (max-width: 860px) {
            .page-shell { padding: 0 18px; }
            .list-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        }

        @media (max-width: 600px) {
            .dashboard-topbar { padding: 12px 16px; }
            .page-shell { margin-top: 18px; }
            .page-header {
                flex-direction: column;
                align-items: flex-start;
            }
            .primary-btn {
                width: 100%;
            }
            .toolbar {
                flex-direction: column;
                align-items: stretch;
            }
            .list-grid {
                grid-template-columns: 1fr;
            }
        }
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
                <p class="eyebrow">Riwayat barang</p>
                <h1>Lost &amp; Found</h1>
            </div>
            <a class="primary-btn" href="{{ route('item_reports.user.create') }}">Laporkan Barang</a>
        </header>

        <div class="toolbar">
            <label class="search" aria-label="Cari barang">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input id="itemSearch" type="search" placeholder="Cari barang...">
            </label>
        </div>

        <section class="list-grid" aria-label="Daftar laporan Lost & Found">
            @forelse($reports as $report)
                @php
                    $statusName = strtolower($report->status?->status_name ?? 'diproses');
                    $isDone = str_contains($statusName, 'selesai') || str_contains($statusName, 'temu') || str_contains($statusName, 'kembali');
                    $statusLabel = str_contains($statusName, 'kembali') ? 'Sudah Dikembalikan' : ($isDone ? 'Sudah Ditemukan' : 'Menunggu Pemilik');
                @endphp

                <a href="{{ route('item_reports.user.show', $report->id) }}" class="report-card" data-search="{{ strtolower($report->nama_barang.' '.$report->lokasi.' '.($report->kategori_barang ?? '')) }}">
                    <div class="report-image">
                        @if($report->foto)
                            <img src="{{ asset('storage/'.$report->foto) }}" alt="Foto {{ $report->nama_barang }}" loading="lazy">
                        @else
                            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <rect x="4" y="5" width="16" height="14" rx="2"></rect>
                                <circle cx="9" cy="10" r="1.5"></circle>
                                <path d="M5 17l4-4 3 3 2-2 5 4"></path>
                            </svg>
                        @endif
                    </div>
                    <h2 class="report-title">{{ $report->nama_barang }}</h2>
                    <p class="report-text">{{ $report->lokasi ?: 'Lokasi belum dicatat' }}</p>
                    <p class="report-text report-date">{{ \Illuminate\Support\Carbon::parse($report->tanggal ?? $report->created_at)->locale('id')->translatedFormat('d F Y') }}</p>
                    <span class="status-badge {{ $isDone ? 'status-done' : 'status-pending' }}">
                        <span class="dot"></span>
                        {{ $statusLabel }}
                    </span>
                </a>
            @empty
                <div class="empty-state">
                    <svg width="42" height="42" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <rect x="4" y="5" width="16" height="14" rx="2"></rect>
                        <path d="M8 10h8M8 14h5"></path>
                    </svg>
                    <strong>Belum ada laporan</strong>
                    <span>Laporan barang hilang atau ditemukan akan muncul di sini.</span>
                </div>
            @endforelse
        </section>
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

        const searchInput = document.getElementById('itemSearch');
        const cards = [...document.querySelectorAll('.report-card')];

        searchInput?.addEventListener('input', (event) => {
            const term = event.target.value.toLowerCase().trim();
            cards.forEach((card) => {
                const matches = term === '' || card.dataset.search.includes(term);
                card.hidden = !matches;
            });
        });
    </script>
</body>
</html>
