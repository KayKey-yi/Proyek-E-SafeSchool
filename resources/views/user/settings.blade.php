<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>E-Safe School - Pengaturan</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<style>
  * { box-sizing: border-box; margin: 0; padding: 0; }
  body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Arial, sans-serif; background: #eef0f3; color: #1f2430; }
  .app { display: flex; min-height: 100vh; }
  .sidebar { width: 250px; position: fixed; inset: 0 auto 0 0; background: #101d46; color: #cfd4e6; display: flex; flex-direction: column; flex-shrink: 0; z-index: 10; transition: width .2s ease; overflow: hidden; }
  .sidebar.collapsed { width: 56px; }
  .sidebar-header { display: flex; align-items: center; gap: 10px; padding: 22px; color: #fff; font-weight: 700; font-size: 16px; border-bottom: 1px solid rgba(255,255,255,.06); }
  .sidebar-header .icon { font-size: 19px; line-height: 1; }
  .sidebar-toggle { display: inline-flex; align-items: center; justify-content: center; width: 20px; height: 20px; padding: 0; border: 0; background: transparent; color: #fff; font-size: 18px; cursor: pointer; }
  .sidebar.collapsed .sidebar-header { justify-content: center; padding: 18px 0; }
  .sidebar.collapsed .sidebar-header > span:last-of-type, .sidebar.collapsed .nav, .sidebar.collapsed .sidebar-footer { display: none; }
  .nav { flex: 1; padding: 10px 0; }
  .nav-item { display: flex; align-items: center; gap: 12px; padding: 11px 22px; font-size: 14.5px; color: #b7bedb; cursor: pointer; text-decoration: none; border-left: 3px solid transparent; }
  .nav-item .icon { width: 18px; text-align: center; font-size: 15px; }
  .nav-item:hover { background: rgba(255,255,255,.04); color: #fff; }
  .nav-item.active { background: #17245a; color: #fff; border-left-color: #4c6ef5; }
  .sidebar-footer { padding: 16px 22px 22px; border-top: 1px solid rgba(255,255,255,.06); }
  .sidebar-footer .nav-item { padding: 8px 0; }
  .main { flex: 1; margin-left: 250px; display: flex; flex-direction: column; min-width: 0; transition: margin-left .2s ease; }
  .main.sidebar-collapsed { margin-left: 56px; }
  .topbar { display: flex; align-items: center; justify-content: space-between; height: 64px; background: #fff; padding: 16px 32px; border-bottom: 1px solid #e6e8ee; }
  .topbar-title { display: flex; align-items: center; gap: 10px; font-size: 17px; font-weight: 700; }
  .topbar-title .back { color: #4a5170; font-size: 17px; text-decoration: none; }
  .topbar-right { display: flex; align-items: center; gap: 14px; }
  .search-box { display: flex; align-items: center; gap: 6px; background: #f3f4f7; border: 1px solid #e6e8ee; border-radius: 6px; padding: 6px 12px; font-size: 12.5px; color: #9aa0b4; width: 190px; }
  .search-box input { border: none; background: transparent; outline: none; font-size: 12.5px; width: 100%; color: #4a5170; }
  .topbar-right .icon-btn { font-size: 16px; color: #6b7190; }
  .topbar-right .chevron { font-size: 11px; color: #9aa0b4; }
  .content { padding: 28px 32px; flex: 1; background: #f2f7f8; }
  .panel { background: #fff; border-radius: 6px; padding: 28px 32px; min-height: 332px; max-width: 900px; }
  .field-group { margin-bottom: 21px; }
  .field-group:last-child { margin-bottom: 0; }
  .field-group h3 { font-size: 14.5px; font-weight: 700; color: #1f2430; margin-bottom: 10px; }
  .field-group .value { font-size: 13px; color: #6b7190; padding-bottom: 10px; border-bottom: 1px solid #969696; }
  .about-row { display: flex; justify-content: space-between; align-items: center; padding: 12px 0; border-bottom: 1px solid #e6e8ee; font-size: 13px; }
  .about-row .label { color: #1f2430; font-weight: 600; }
  .about-row .value { color: #6b7190; }
  @media (max-width: 768px) { .sidebar { transform: translateX(-100%); transition: transform .2s ease; } .sidebar.open { transform: translateX(0); } .main { margin-left: 0; } .content { padding: 20px 16px; } .topbar { padding: 14px 16px; } .topbar-right .search-box { width: 140px; } }
  @media (max-width: 520px) { .topbar-right .search-box { display: none; } .panel { padding: 22px 18px; } }
</style>
</head>
<body>
<div class="app">
  <aside class="sidebar" id="sidebar">
    <div class="sidebar-header"><button class="sidebar-toggle" id="sidebarToggle" type="button" aria-label="Sembunyikan menu" aria-expanded="true"><span class="icon"><i class="fa-solid fa-bars"></i></span></button><span>E-Safe School</span></div>
    <nav class="nav">
      <a class="nav-item" href="{{ route('user.dashboard') }}"><span class="icon"><i class="fa-solid fa-table-columns"></i></span><span>Dashboard</span></a>
      <a class="nav-item" href="{{ route('complaints.user.index.short') }}"><span class="icon"><i class="fa-solid fa-file-lines"></i></span><span>Pengaduan</span></a>
      <a class="nav-item" href="{{ route('item_reports.user.index') }}"><span class="icon"><i class="fa-solid fa-box-archive"></i></span><span>Lost &amp; Found</span></a>
      <a class="nav-item" href="{{ route('user.notifications') }}"><span class="icon"><i class="fa-solid fa-bell"></i></span><span>Notifikasi</span></a>
      <a class="nav-item" href="{{ route('profile.edit') }}"><span class="icon"><i class="fa-solid fa-user"></i></span><span>Profil</span></a>
      <a class="nav-item active" href="{{ route('user.settings') }}"><span class="icon"><i class="fa-solid fa-gear"></i></span><span>Pengaturan</span></a>
    </nav>
    <div class="sidebar-footer"><form method="POST" action="{{ route('logout') }}">@csrf<button type="submit" class="nav-item" style="width:100%;border:0;background:transparent;text-align:left;"><span class="icon"><i class="fa-solid fa-right-from-bracket"></i></span><span>Keluar</span></button></form></div>
  </aside>
  <main class="main">
    <header class="topbar">
      <div class="topbar-title"><a class="back" href="{{ route('user.dashboard') }}" aria-label="Kembali"><i class="fa-solid fa-arrow-left"></i></a><span id="page-title">Bahasa dan Waktu</span></div>
      <div class="topbar-right"><label class="search-box"><i class="fa-solid fa-magnifying-glass"></i><input type="search" placeholder="Cari Sesuatu..." aria-label="Cari sesuatu"></label><span class="icon-btn"><i class="fa-solid fa-bell"></i></span><span class="icon-btn"><i class="fa-solid fa-user"></i></span><span class="chevron"><i class="fa-solid fa-chevron-down"></i></span></div>
    </header>
    <section class="content">
      <div class="panel" id="panel-bahasa">
        <div class="field-group"><h3>Bahasa</h3><div class="value">Bahasa Indonesia</div></div>
        <div class="field-group"><h3>Waktu</h3><div class="value">Zona Waktu (Waktu Indonesia Barat)</div></div>
      </div>
      <div class="panel" id="panel-tentang" hidden>
        <div class="about-row"><span class="label">Versi Aplikasi</span><span class="value">1.0.0</span></div>
        <div class="about-row"><span class="label">Pengembang</span><span class="value">E-Safe School Team</span></div>
        <div class="about-row"><span class="label">Kebijakan Privasi</span><span class="value">Lihat Kebijakan</span></div>
        <div class="about-row"><span class="label">Syarat &amp; Ketentuan</span><span class="value">Lihat Ketentuan</span></div>
        <div class="about-row" style="border-bottom:0"><span class="label">Bantuan</span><span class="value">Hubungi Kami</span></div>
      </div>
    </section>
  </main>
</div>
<script>
  const sidebar = document.getElementById('sidebar');
  const main = document.querySelector('.main');
  const menuButton = document.getElementById('sidebarToggle');
  function showSetting(page) {
    const about = page === 'tentang';
    document.getElementById('panel-bahasa').hidden = about;
    document.getElementById('panel-tentang').hidden = !about;
    document.getElementById('page-title').textContent = about ? 'Tentang' : 'Bahasa dan Waktu';
  }
  document.querySelectorAll('.settings-about').forEach((link) => link.addEventListener('click', () => showSetting('tentang')));
  menuButton.addEventListener('click', () => {
    const isCollapsed = main.classList.toggle('sidebar-collapsed');
    sidebar.classList.toggle('collapsed', isCollapsed);
    sidebar.classList.toggle('open', !isCollapsed);
    menuButton.setAttribute('aria-label', isCollapsed ? 'Tampilkan menu' : 'Sembunyikan menu');
    menuButton.setAttribute('aria-expanded', String(!isCollapsed));
  });
  if (window.location.hash === '#tentang') showSetting('tentang');
</script>
</body>
</html>
