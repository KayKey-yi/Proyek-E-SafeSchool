<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>E-Safe School - Pengaturan</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<link rel="stylesheet" href="{{ asset('assets/css/shared/app-user.css') }}">
<style>
  * { box-sizing: border-box; margin: 0; padding: 0; }
  body { min-height: 100vh; font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Arial, sans-serif; background: #eef0f3; color: #1f2430; }
  .app { display: flex; height: 100vh; min-height: 100vh; }
  .main { display: flex; min-width: 0; height: 100vh; flex: 1; flex-direction: column; }
  .settings-menu-btn { display: inline-flex; align-items: center; justify-content: center; width: 40px; height: 40px; border: 0; border-radius: 8px; background: transparent; color: #16215c; font-size: 20px; cursor: pointer; }
  .settings-menu-btn:hover { background: #f1f5f9; }
  .detail-back-btn { display: none; align-items: center; justify-content: center; width: 24px; height: 24px; border: 0; background: transparent; color: #4a5170; font-size: 17px; cursor: pointer; }
  .topbar { display: flex; align-items: center; justify-content: space-between; height: 64px; background: #fff; padding: 16px 32px; border-bottom: 1px solid #e6e8ee; }
  .topbar-title { display: flex; align-items: center; gap: 10px; font-size: 17px; font-weight: 700; }
  .title-stack { display: flex; flex-direction: column; gap: 3px; }
  .page-date { color: #6b7190; font-size: 10px; font-weight: 400; }
  .topbar-title .back { color: #4a5170; font-size: 17px; text-decoration: none; }
  .topbar-right { display: flex; align-items: center; gap: 14px; }
  .search-box { display: flex; align-items: center; gap: 6px; background: #f3f4f7; border: 1px solid #e6e8ee; border-radius: 6px; padding: 6px 12px; font-size: 12.5px; color: #9aa0b4; width: 190px; }
  .search-box input { border: none; background: transparent; outline: none; font-size: 12.5px; width: 100%; color: #4a5170; }
  .topbar-right .icon-btn { font-size: 16px; color: #6b7190; }
  .topbar-right .chevron { font-size: 11px; color: #9aa0b4; }
  .content { min-height: 0; padding: 28px 32px; flex: 1; overflow: auto; background: #f2f7f8; }
  .panel { width: 100%; max-width: 900px; margin: 0 auto; background: #fff; border-radius: 0; padding: 15px 14px; min-height: 332px; }
  .field-group { margin-bottom: 18px; }
  .field-group:last-child { margin-bottom: 0; }
  .field-group h3 { font-size: 12px; font-weight: 700; color: #1f2430; margin-bottom: 5px; }
  .field-group .value { font-size: 10px; color: #6b7190; padding-bottom: 8px; border-bottom: 1px solid #969696; }
  .about-panel { width: 100%; max-width: 760px; min-height: 390px; margin: 0 auto; border: 1px solid #969696; border-radius: 4px; padding: 18px 20px 28px; }
  .about-meta { padding-bottom: 8px; border-bottom: 1px solid #969696; text-align: left; }
  .about-meta h3, .about-description h3 { font-size: 15px; font-weight: 700; margin-bottom: 6px; }
  .about-meta p { color: #6b7190; font-size: 13px; }
  .about-description { max-width: 650px; margin: 0 auto; padding-top: 12px; text-align: left; }
  .about-description h2 { margin: 14px 0 18px; text-align: center; font-size: 30px; }
  .about-description p { max-width: 650px; margin: 0 auto; color: #1f2430; font-size: 14px; line-height: 1.6; text-align: justify; overflow-wrap: break-word; }
  .settings-card { width: 100%; max-width: 900px; margin: 0 auto; background: #fff; border: 1px solid #f0f0f0; min-height: 332px; }
  .settings-option { display: flex; align-items: center; gap: 16px; min-height: 76px; padding: 0 22px; color: inherit; text-decoration: none; }
  .settings-option + .settings-option { border-top: 1px solid #969696; }
  .settings-option:hover { background: #fafbfe; }
  .settings-icon { display: flex; align-items: center; justify-content: center; width: 38px; height: 38px; flex: 0 0 38px; color: #111; font-size: 30px; }
  .settings-copy { display: flex; min-width: 0; flex: 1; flex-direction: column; align-items: flex-start; }
  .settings-title { margin-bottom: 3px; font-size: 14px; font-weight: 700; }
  .settings-description { color: #555; font-size: 11px; }
  .detail-back { display: inline-flex; align-items: center; gap: 7px; margin-bottom: 24px; border: 0; background: transparent; color: #4a5170; font-size: 13px; cursor: pointer; }
  @media (max-width: 768px) { .content { padding: 20px 16px; } .topbar { padding: 14px 16px; } .topbar-right .search-box { width: 140px; } }
  @media (max-width: 520px) { body { overflow: auto; } }
  @media (max-width: 520px) { .topbar-right .search-box { display: none; } .panel { padding: 22px 18px; } .settings-option { padding: 0 16px; gap: 12px; } }
</style>
</head>
<body>
<div class="app">
  @include('layouts.sidebar-user')
  <main class="main">
    <header class="topbar">
      <div class="topbar-title"><button class="settings-menu-btn" id="menuBtn" type="button" aria-label="Buka menu" aria-expanded="false"><i class="fa-solid fa-bars"></i></button><button class="detail-back-btn" id="detailBack" type="button" aria-label="Kembali ke Pengaturan"><i class="fa-solid fa-arrow-left"></i></button><span class="title-stack"><span id="page-title">Pengaturan</span><span class="page-date" id="page-date">{{ now()->locale('id')->translatedFormat('l, j F Y') }}</span></span></div>
      <div class="topbar-right"><label class="search-box"><i class="fa-solid fa-magnifying-glass"></i><input type="search" placeholder="Cari Sesuatu..." aria-label="Cari sesuatu"></label></div>
    </header>
    <section class="content">
      <div class="settings-card" id="settings-menu" aria-label="Pilihan pengaturan">
        <a class="settings-option" href="#bahasa-dan-waktu" data-setting="bahasa">
          <span class="settings-icon"><i class="fa-solid fa-globe"></i></span>
          <span class="settings-copy"><span class="settings-title">Bahasa dan Waktu</span><span class="settings-description">Bahasa &bull; Tampilan Waktu</span></span>
        </a>
        <a class="settings-option" href="#tentang" data-setting="tentang">
          <span class="settings-icon"><i class="fa-solid fa-circle-info"></i></span>
          <span class="settings-copy"><span class="settings-title">Tentang</span><span class="settings-description">Versi &bull; Tentang Website</span></span>
        </a>
      </div>
      <div class="panel" id="panel-bahasa" hidden>
        <div class="field-group"><h3>Bahasa</h3><div class="value">Bahasa Indonesia</div></div>
        <div class="field-group"><h3>Waktu</h3><div class="value">Zona Waktu (Waktu Indonesia Barat)</div></div>
      </div>
      <div class="panel" id="panel-tentang" hidden>
        <div class="about-panel">
          <div class="about-meta"><h3>Versi</h3><p>26.08.2024</p></div>
          <div class="about-description">
            <h3>Tentang Website</h3>
            <h2>E-Safe School</h2>
            <p>E-Safe School adalah aplikasi berbasis web/mobile yang menyediakan layanan pengaduan kejadian di lingkungan sekolah serta Lost &amp; Found dalam satu platform. Melalui fitur pengaduan, siswa dapat melaporkan berbagai kejadian atau permasalahan yang terjadi di lingkungan sekolah agar dapat ditindaklanjuti oleh pihak terkait. Sementara itu, fitur Lost &amp; Found memungkinkan siswa untuk melaporkan barang yang hilang maupun menemukan di lingkungan sekolah, sehingga memudahkan proses pencarian dan pengembalian barang. E-Safe School merupakan perpaduan teknologi sekolah yang lebih aman, nyaman, responsif, dan tertata.</p>
          </div>
        </div>
      </div>
    </section>
  </main>
</div>
<script>
  const sidebar = document.getElementById('sidebar');
  const menuButton = document.getElementById('menuBtn');
  const sidebarOverlay = document.getElementById('sidebarOverlay');
  const sidebarClose = document.getElementById('sidebarClose');
  const detailBack = document.getElementById('detailBack');
  let currentSetting = 'menu';
  function showSetting(page) {
    const menu = page === 'menu';
    const about = page === 'tentang';
    currentSetting = page;
    document.getElementById('settings-menu').hidden = !menu;
    document.getElementById('panel-bahasa').hidden = menu || about;
    document.getElementById('panel-tentang').hidden = menu || !about;
    document.getElementById('page-title').textContent = menu ? 'Pengaturan' : (about ? 'Tentang' : 'Bahasa dan Waktu');
    document.getElementById('page-date').hidden = !menu;
    detailBack.style.display = menu ? 'none' : 'inline-flex';
  }
  document.querySelectorAll('[data-setting]').forEach((control) => control.addEventListener('click', (event) => {
    event.preventDefault();
    showSetting(control.dataset.setting);
  }));
  detailBack.addEventListener('click', () => showSetting('menu'));
  function toggleSidebar(forceOpen) {
    const shouldOpen = typeof forceOpen === 'boolean' ? forceOpen : !sidebar.classList.contains('open');
    sidebar.classList.toggle('open', shouldOpen);
    sidebarOverlay.classList.toggle('show', shouldOpen);
    menuButton.setAttribute('aria-expanded', String(shouldOpen));
  }
  menuButton.addEventListener('click', () => toggleSidebar());
  sidebarOverlay.addEventListener('click', () => toggleSidebar(false));
  sidebarClose.addEventListener('click', () => toggleSidebar(false));
  if (window.location.hash === '#tentang') showSetting('tentang');
  if (window.location.hash === '#bahasa-dan-waktu') showSetting('bahasa');
</script>
</body>
</html>
