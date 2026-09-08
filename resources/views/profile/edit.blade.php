<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil - E-Safe School</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/shared/app-user.css') }}">
    <style>
        :root { --page-bg:#eef2f7; --navy:#16214b; --muted:#8a93a6; --line:#e7ebf2; --blue:#2f6fed; --green-bg:#e4f8ee; --green:#1daa6b; --orange-bg:#fff1df; --orange:#e08a1f; }
        * { box-sizing:border-box; }
        body { margin:0; min-height:100vh; background:var(--page-bg); color:var(--navy); font-family:"Segoe UI", Tahoma, sans-serif; }
        .dashboard-topbar { display:flex; align-items:center; gap:16px; padding:14px 24px; border-bottom:1px solid #e5e7eb; background:#fff; }
        .dashboard-menu-btn { display:inline-flex; align-items:center; justify-content:center; width:40px; height:40px; border:0; border-radius:8px; background:transparent; color:var(--navy); font-size:20px; cursor:pointer; }
        .dashboard-menu-btn:hover { background:#f1f5f9; }
        .dashboard-topbar-title { font-size:16px; font-weight:700; }
        .profile-main { max-width:1100px; margin:0 auto; padding:28px 34px 44px; }
        .profile-header { display:flex; align-items:center; justify-content:space-between; gap:20px; margin-bottom:24px; }
        .profile-header h1 { margin:0; font-size:30px; letter-spacing:.4px; }
        .profile-date { margin-top:5px; color:var(--muted); font-size:12px; }
        .search-box { display:flex; align-items:center; gap:8px; width:220px; height:36px; padding:0 12px; border:1px solid var(--line); border-radius:20px; background:#fff; color:var(--muted); }
        .search-box input { width:100%; border:0; outline:0; background:transparent; font-size:12px; }
        .profile-card, .history-card { border:1px solid var(--line); border-radius:16px; background:#fff; box-shadow:0 2px 10px rgba(22,33,75,.04); }
        .profile-card { display:flex; align-items:center; gap:38px; padding:30px 36px; margin-bottom:22px; }
        .profile-identity { display:flex; flex:0 0 180px; flex-direction:column; align-items:center; gap:7px; text-align:center; }
        .avatar { display:flex; align-items:center; justify-content:center; width:96px; height:96px; border:3px solid #fff; border-radius:50%; background:linear-gradient(135deg,#dce4f5,#c6d2ee); background-position:center; background-size:cover; box-shadow:0 0 0 3px var(--line); color:var(--navy); font-size:30px; font-weight:700; }
        .photo-form { display:flex; flex-direction:column; align-items:center; gap:7px; }
        .photo-button { padding:6px 11px; border:0; border-radius:7px; background:var(--navy); color:#fff; font-size:11px; font-weight:600; cursor:pointer; }
        .photo-button:hover { background:#25366f; }
        .photo-help { color:var(--muted); font-size:10px; }
        .photo-error { max-width:180px; color:#c0392b; font-size:11px; line-height:1.4; }
        .profile-alert { margin-bottom:18px; padding:11px 14px; border-radius:8px; background:var(--green-bg); color:var(--green); font-size:12px; font-weight:600; }
        .identity-name { margin-top:5px; font-size:17px; font-weight:700; }
        .identity-contact { color:var(--blue); font-size:12px; font-weight:600; overflow-wrap:anywhere; }
        .profile-details { flex:1; min-width:0; }
        .detail-row { display:flex; gap:10px; padding:6px 0; font-size:13px; }
        .detail-label { width:110px; flex-shrink:0; color:var(--muted); }
        .detail-value { font-weight:600; overflow-wrap:anywhere; }
        .detail-divider { height:1px; margin:8px 0; background:var(--line); }
        .history-card { padding:24px 28px 26px; }
        .history-card h2 { margin:0 0 14px; font-size:17px; }
        .history-list { display:flex; flex-direction:column; gap:10px; }
        .history-item { display:flex; align-items:center; justify-content:space-between; gap:16px; padding:13px 16px; border:1px solid var(--line); border-radius:12px; }
        .history-id, .history-date { color:var(--muted); font-size:11px; }
        .history-title { margin:4px 0; color:#20263a; font-size:14px; font-weight:700; }
        .status { padding:6px 13px; border-radius:8px; font-size:12px; font-weight:700; white-space:nowrap; }
        .status.finished { background:var(--green-bg); color:var(--green); }
        .status.processing { background:var(--orange-bg); color:var(--orange); }
        .empty-state { padding:42px 20px 34px; text-align:center; }
        .empty-icon { display:flex; align-items:center; justify-content:center; width:56px; height:56px; margin:0 auto 12px; border-radius:50%; background:var(--page-bg); color:var(--muted); font-size:22px; }
        .empty-state h3 { margin:0 0 6px; font-size:15px; }
        .empty-state p { max-width:300px; margin:0 auto; color:var(--muted); font-size:12px; line-height:1.6; }
        @media (max-width:760px) { .profile-main { padding:22px 18px 36px; } .profile-header { align-items:stretch; flex-direction:column; } .search-box { width:100%; } .profile-card { align-items:stretch; flex-direction:column; gap:24px; padding:26px 22px; } .profile-identity { flex-basis:auto; } .history-card { padding:22px 18px; } }
        @media (max-width:480px) { .history-item { align-items:flex-start; flex-direction:column; } .status { align-self:flex-end; } .detail-row { flex-direction:column; gap:2px; } }
    </style>
</head>
<body>
    @include('layouts.sidebar-user')

    <header class="dashboard-topbar">
        <button class="dashboard-menu-btn" id="menuBtn" type="button" aria-label="Buka menu" aria-expanded="false"><i class="fa-solid fa-bars"></i></button>
        <span class="dashboard-topbar-title">E-Safe School</span>
    </header>

    <main class="profile-main">
        <header class="profile-header">
            <div>
                <h1>PROFIL</h1>
                <div class="profile-date">{{ now()->locale('id')->translatedFormat('l, j F Y') }}</div>
            </div>
            <label class="search-box" aria-label="Cari">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="search" placeholder="Cari sesuatu...">
            </label>
        </header>

        @if(session('status') === 'profile-updated')
            <div class="profile-alert">Profil berhasil diperbarui.</div>
        @endif

        <section class="profile-card" aria-label="Data diri">
            <div class="profile-identity">
                <form class="photo-form" method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    <input type="hidden" name="name" value="{{ $user->name }}">
                    <input type="hidden" name="email" value="{{ $user->email }}">
                    <label for="profile_photo" class="avatar" @if($user->profile_photo) style="background-image:url('{{ asset('storage/'.$user->profile_photo) }}')" @endif>
                        @unless($user->profile_photo){{ $user->initials() }}@endunless
                    </label>
                    <input id="profile_photo" name="profile_photo" type="file" accept=".jpg,.jpeg,.png,.webp" hidden onchange="this.form.submit()">
                    <label for="profile_photo" class="photo-button">Ganti foto</label>
                    @error('profile_photo')<span class="photo-error">{{ $message }}</span>@enderror
                </form>
                <div class="identity-name">{{ $user->name }}</div>
                <div class="identity-contact">{{ $user->username ?: '-' }}</div>
                <div class="identity-contact">{{ $user->email }}</div>
            </div>
            <div class="profile-details">
                <div class="detail-row"><div class="detail-label">Nama</div><div class="detail-value">: {{ $user->name ?: '-' }}</div></div>
                <div class="detail-row"><div class="detail-label">Username</div><div class="detail-value">: {{ $user->username ?: '-' }}</div></div>
                <div class="detail-row"><div class="detail-label">Identitas</div><div class="detail-value">: {{ $user->identitas ?: '-' }}</div></div>
                <div class="detail-divider"></div>
                <div class="detail-row"><div class="detail-label">Email</div><div class="detail-value">: {{ $user->email ?: '-' }}</div></div>
                <div class="detail-row"><div class="detail-label">No. HP</div><div class="detail-value">: -</div></div>
            </div>
        </section>

        <section class="history-card">
            <h2>Riwayat Pengaduan</h2>
            @if($reports->isNotEmpty())
                <div class="history-list">
                    @foreach($reports as $report)
                        @php
                            $status = $report['status'];
                            $isFinished = in_array(strtolower($status), ['selesai', 'dikembalikan', 'ditemukan'], true);
                        @endphp
                    <article class="history-item">
                        <div>
                            <div class="history-id">#{{ strtolower(substr((string) $report['id'], 0, 8)) }}</div>
                            <div class="history-title">{{ $report['title'] }}</div>
                            <div class="history-date">{{ $report['type'] }} · {{ $report['created_at']?->locale('id')->translatedFormat('d F Y, H.i') ?? 'Tanggal tidak tersedia' }} WIB</div>
                        </div>
                        <span class="status {{ $isFinished ? 'finished' : 'processing' }}">{{ $status }}</span>
                    </article>
                    @endforeach
                </div>
            @else
                <div class="empty-state">
                    <div class="empty-icon"><i class="fa-regular fa-folder-open"></i></div>
                    <h3>Belum ada laporan</h3>
                    <p>Riwayat pengaduan dan laporan Lost &amp; Found kamu akan muncul di sini.</p>
                </div>
            @endif
        </section>
    </main>

    <script>
        const menuButton = document.getElementById('menuBtn');
        const sidebar = document.getElementById('sidebar');
        const sidebarOverlay = document.getElementById('sidebarOverlay');
        const sidebarClose = document.getElementById('sidebarClose');
        function toggleSidebar(forceOpen) {
            const shouldOpen = typeof forceOpen === 'boolean' ? forceOpen : !sidebar.classList.contains('open');
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
