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

        .dashboard-topbar {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 14px 24px;
            border-bottom: 1px solid #e5e7eb;
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
            color: #16215c;
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
            max-width: 1100px;
            margin: 0 auto;
            padding: 18px 18px 30px;
            background: transparent;
        }

        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            margin-bottom: 14px;
            background: transparent;
            border: none;
            border-radius: 0;
            box-shadow: none;
            padding: 0;
        }

        .title-block {
            margin: 0;
            background: transparent;
            border: none;
            box-shadow: none;
        }

        .title-block h1 {
            margin: 0;
            font-size: 22px;
            line-height: 1.3;
            font-weight: 700;
        }

        .title-block .date {
            margin-top: 4px;
            font-size: 14px;
            color: var(--muted);
        }

        .search-box {
            width: 220px;
            height: 36px;
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 0 12px;
            background: var(--input-bg);
            border: 1px solid #d1d1d1;
            border-radius: 8px;
            color: var(--muted);
        }

        .search-box svg {
            flex-shrink: 0;
        }

        .search-box input {
            width: 100%;
            border: 0;
            outline: 0;
            background: transparent;
            color: var(--text);
            font-size: 14px;
        }

        .search-box input::placeholder {
            color: #7f7f7f;
        }

        .report-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .report-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            padding: 16px 18px;
            border: 2px solid #d0d0d0;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.22);
        }

        .report-main {
            min-width: 0;
            flex: 1;
        }

        .report-id {
            margin-bottom: 5px;
            font-size: 12px;
            font-weight: 700;
            color: #2d2d2d;
        }

        .report-title {
            margin-bottom: 4px;
            font-size: 18px;
            font-weight: 700;
            line-height: 1.35;
        }

        .report-date {
            font-size: 13px;
            color: var(--muted);
        }

        .badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 110px;
            padding: 8px 14px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 700;
            white-space: nowrap;
        }

        .badge-blue {
            background: var(--blue-bg);
            color: var(--blue-text);
        }

        .badge-green {
            background: var(--green-bg);
            color: var(--green-text);
        }

        .empty-state {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 340px;
            padding: 24px;
            border: 1px solid var(--card-border);
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.18);
            text-align: center;
        }

        .empty-state-inner {
            max-width: 320px;
        }

        .empty-state-icon {
            width: 72px;
            height: 72px;
            margin: 0 auto 16px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #3456c5;
            background: #edf3ff;
        }

        .empty-state h3 {
            margin: 0 0 8px;
            font-size: 18px;
            color: #262626;
        }

        .empty-state p {
            margin: 0;
            font-size: 13px;
            line-height: 1.6;
            color: var(--muted);
        }

        @media (max-width: 640px) {
            .topbar {
                flex-direction: column;
                align-items: flex-start;
            }

            .search-box {
                width: 100%;
            }

            .report-item {
                flex-direction: column;
                align-items: flex-start;
            }

            .badge {
                align-self: flex-end;
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

    <div class="page-shell">
        <div class="topbar">
            <div class="title-block">
                <h1>Pengaduan</h1>
                <div class="date">{{ now()->locale('id')->translatedFormat('l, j F Y') }}</div>
            </div>

            <label class="search-box" aria-label="Cari pengaduan">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="6"></circle>
                    <path d="M16 16L21 21"></path>
                </svg>
                <input type="text" placeholder="Cari sesuatu..." />
            </label>
        </div>

        @if($reports->isEmpty())
            <div class="empty-state">
                <div class="empty-state-inner">
                    <div class="empty-state-icon">
                        <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9 12h6M9 16h6M9 8h1"/>
                            <path d="M7 3h7l5 5v13a1 1 0 01-1 1H7a1 1 0 01-1-1V4a1 1 0 011-1z"/>
                        </svg>
                    </div>
                    <h3>Belum ada riwayat pengaduan</h3>
                    <p>Kamu belum pernah membuat laporan. Laporan yang kamu buat akan muncul di sini.</p>
                </div>
            </div>
        @else
            <div class="report-list">
                @foreach($reports as $report)
                    @php
                        $statusName = $statuses[$report->status_id]->status_name ?? 'Sedang Diproses';
                        $statusClass = str_contains(strtolower($statusName), 'selesai') ? 'badge-green' : 'badge-blue';
                    @endphp

                    <div class="report-item">
                        <div class="report-main">
                            <div class="report-id">#{{ strtolower(substr((string) $report->id, 0, 8)) }}</div>
                            <div class="report-title">{{ $report->judul }}</div>
                            <div class="report-date">{{ optional($report->created_at)->locale('id')->translatedFormat('d F Y, H.i') }} WIB</div>
                        </div>
                        <div class="badge {{ $statusClass }}">{{ $statusName }}</div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

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
