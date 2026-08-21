<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>E-Safe School - Laporan Diterima</title>
<style>
:root{--blue-900:#1e3a8a;--blue-700:#1d4ed8;--blue-card:#dfe9fb;--blue-border:#c3d4f5;--slate-50:#f4f7f8;--gray-100:#f3f4f6}
*{box-sizing:border-box;margin:0;padding:0}body{min-height:100vh;background:var(--slate-50);font-family:'Segoe UI',Roboto,Helvetica,Arial,sans-serif}a{color:inherit;text-decoration:none}.navbar{border-bottom:1px solid var(--gray-100);background:#fff}.navbar .inner{max-width:1200px;margin:0 auto;padding:16px 24px;display:flex;align-items:center;gap:16px}.menu-btn{display:flex;color:#1f2937;background:none;border:0;cursor:pointer}.brand{display:flex;align-items:center;gap:8px}.brand-name{color:var(--blue-700);font-size:15px;font-weight:700}.content{max-width:1200px;margin:0 auto;padding:48px 24px}.success-card{display:flex;flex-direction:column;align-items:center;justify-content:center;padding:80px 24px;border:1px solid var(--blue-border);border-radius:12px;background:var(--blue-card);text-align:center}.success-icon{margin-bottom:24px}.success-text{color:var(--blue-900);font-size:18px;font-weight:800;letter-spacing:.3px;text-transform:uppercase}.actions{display:flex;justify-content:center;flex-wrap:wrap;gap:16px;margin-top:32px}.btn{padding:12px 28px;border:1px solid transparent;border-radius:8px;font-size:14px;font-weight:700;cursor:pointer;transition:background .15s ease}.btn-primary{background:var(--blue-900);color:#fff}.btn-primary:hover{background:#16306e}.btn-outline{border-color:var(--blue-700);background:#fff;color:var(--blue-900)}.btn-outline:hover{background:#f5f8ff}@media(max-width:600px){.content{padding:32px 16px}.success-card{padding:64px 20px}.success-text{font-size:16px}}
</style>
</head>
<body>
<nav class="navbar"><div class="inner"><button class="menu-btn" id="menuBtn" type="button" aria-label="Menu"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 6h16M4 12h16M4 18h16"/></svg></button><a href="{{ url('/') }}" class="brand"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#1d4ed8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4.2 8-10.5V5.5L12 3 4 5.5v5c0 6.8 8 11.5 8 11.5z"/><path d="M9 12l2 2 4-4"/></svg><span class="brand-name">E-Safe School</span></a></div></nav>
<main class="content"><div class="success-card"><div class="success-icon"><svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="#1e3a8a" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 21s8-4.2 8-10.5V5.5L12 3 4 5.5v5C4 16.8 12 21 12 21z"/><path d="M9 12l2 2 4-4"/></svg></div><p class="success-text">Terima Kasih, Laporan Anda Telah Diterima</p></div><div class="actions"><a href="{{ route('complaints.user.index') }}" class="btn btn-primary">Pantau Status Laporan</a><a href="{{ route('frontend.index') }}" class="btn btn-outline">Halaman Utama</a></div></main>
</body>
</html>
