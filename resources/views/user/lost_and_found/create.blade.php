<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Lapor Lost & Found - E-Safe School</title>
    <style>
        :root {
            --primary: #2b2fa3;
            --primary-dark: #23277f;
            --bg-page: #eef6f4;
            --bg-white: #ffffff;
            --border: #d9dde3;
            --text-dark: #1a1a2e;
            --text-muted: #8a8f98;
            --text-label: #26263a;
            --danger: #c0392b;
            --success: #1d8f5f;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            background: var(--bg-page);
            color: var(--text-dark);
        }

        header.topbar {
            background: #fff;
            display: flex;
            align-items: center;
            padding: 14px 24px;
            border-bottom: 1px solid #eee;
            gap: 20px;
        }

        .menu-icon {
            font-size: 20px;
            cursor: pointer;
            color: #333;
            line-height: 0;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 700;
            font-size: 18px;
            color: var(--primary);
            text-decoration: none;
        }

        .brand svg { flex-shrink: 0; }

        nav.main-nav {
            display: flex;
            gap: 28px;
            margin-left: 24px;
            font-size: 14px;
        }

        nav.main-nav a {
            text-decoration: none;
            color: #444;
            padding: 4px 0;
            cursor: pointer;
        }

        nav.main-nav a.active {
            color: var(--primary);
            font-weight: 600;
            border-bottom: 2px solid var(--primary);
        }

        .page-title-bar {
            padding: 20px 32px 16px;
        }

        .page-title-bar h1 {
            color: var(--primary);
            font-size: 22px;
            margin: 0;
        }

        main {
            max-width: 900px;
            margin: 0 auto 60px;
            padding: 0 32px;
        }

        form.card {
            background: var(--bg-white);
            border-radius: 10px;
            padding: 32px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.06);
        }

        .alert-banner {
            padding: 14px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
            border-left: 4px solid;
        }

        .alert-error {
            background: rgba(192, 57, 43, 0.12);
            color: var(--danger);
            border-left-color: var(--danger);
        }

        .field { margin-bottom: 22px; }

        .field label {
            display: block;
            font-weight: 600;
            font-size: 14px;
            color: var(--text-label);
            margin-bottom: 8px;
        }

        .field input[type="text"],
        .field input[type="date"],
        .field input[type="datetime-local"],
        .field select,
        .field textarea {
            width: 100%;
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 12px 14px;
            font-size: 14px;
            font-family: inherit;
            color: var(--text-dark);
            background: #fff;
            outline: none;
            transition: border-color .15s ease, box-shadow .15s ease;
        }

        .field input:focus,
        .field select:focus,
        .field textarea:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(43,47,163,0.12);
        }

        .field textarea {
            resize: vertical;
            min-height: 100px;
        }

        .char-count {
            text-align: right;
            font-size: 12px;
            color: var(--text-muted);
            margin-top: 6px;
        }

        .upload-box {
            border: 1.5px dashed var(--border);
            border-radius: 8px;
            padding: 36px 20px;
            text-align: center;
            cursor: pointer;
            transition: border-color .15s ease, background .15s ease;
            position: relative;
        }

        .upload-box.dragover {
            border-color: var(--primary);
            background: rgba(43,47,163,0.04);
        }

        .upload-box svg { color: #9aa0aa; margin-bottom: 8px; }

        .upload-box .upload-title {
            font-size: 14px;
            font-weight: 600;
            color: var(--text-dark);
        }

        .upload-box .upload-sub {
            font-size: 12px;
            color: var(--text-muted);
            margin-top: 4px;
        }

        .upload-box input[type="file"] {
            display: none;
        }

        .file-preview-list {
            margin-top: 14px;
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: flex-start;
        }

        .file-preview {
            display: flex;
            align-items: center;
            gap: 8px;
            background: #f3f4f8;
            border-radius: 6px;
            padding: 6px 10px;
            font-size: 12px;
            color: var(--text-dark);
        }

        .file-preview button {
            border: none;
            background: none;
            color: #b23b3b;
            cursor: pointer;
            font-size: 13px;
            padding: 0;
            line-height: 1;
        }

        .error-text {
            color: var(--danger);
            font-size: 12px;
            margin-top: 6px;
            display: none;
        }

        .field-error {
            color: var(--danger);
            font-size: 12px;
            margin-top: 6px;
            display: block;
        }

        .form-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 6px;
            flex-wrap: wrap;
            gap: 16px;
        }

        .anon-check {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            color: var(--text-dark);
        }

        .anon-check input[type="checkbox"] {
            width: 17px;
            height: 17px;
            accent-color: var(--primary);
            cursor: pointer;
        }

        button.submit-btn {
            background: var(--primary);
            color: #fff;
            border: none;
            padding: 12px 26px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: background .15s ease, transform .05s ease;
        }

        button.submit-btn:hover { background: var(--primary-dark); }
        button.submit-btn:active { transform: translateY(1px); }
        button.submit-btn:disabled {
            background: #a7abd6;
            cursor: not-allowed;
        }

        .info-text {
            background: rgba(43,47,163,0.08);
            border-left: 4px solid var(--primary);
            padding: 12px 14px;
            border-radius: 4px;
            font-size: 13px;
            color: var(--primary);
            margin-bottom: 20px;
        }

        @media (max-width: 640px) {
            nav.main-nav { display: none; }
            main { padding: 0 16px; }
            form.card { padding: 20px; }
            .form-footer { flex-direction: column; align-items: stretch; }
            button.submit-btn { width: 100%; }
        }
    </style>
</head>
<body>
    <header class="topbar">
        <span class="menu-icon">&#9776;</span>
        <a href="{{ url('/') }}" class="brand">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 2L4 5v6c0 5.5 3.4 9.7 8 11 4.6-1.3 8-5.5 8-11V5l-8-3z" stroke="#2b2fa3" stroke-width="1.8" fill="none"/>
                <path d="M9 12l2 2 4-4" stroke="#2b2fa3" stroke-width="1.8" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            E-Safe School
        </a>
        <nav class="main-nav">
            <a href="{{ url('/') }}">Beranda</a>
            <a href="{{ route('item_reports.user.index') }}">Riwayat Lost & Found</a>
            <a href="{{ route('item_reports.user.create') }}" class="active">Buat Laporan</a>
            <a href="{{ route('complaints.user.index') }}">Pengaduan</a>
        </nav>
    </header>

    <div class="page-title-bar">
        <h1>Lapor Lost & Found</h1>
    </div>

    <main>
        <form class="card" id="lostFoundForm" method="POST" action="{{ route('item_reports.user.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="info-text">
                💡 Gunakan form ini untuk melaporkan barang yang hilang atau barang yang Anda temukan di sekolah.
            </div>

            <div class="field">
                <label for="jenis_laporan">Jenis Laporan <span style="color: var(--danger);">*</span></label>
                <select id="jenis_laporan" name="jenis_laporan" required>
                    <option value="">-- Pilih Jenis --</option>
                    <option value="Kehilangan" {{ old('jenis_laporan') === 'Kehilangan' ? 'selected' : '' }}>Kehilangan</option>
                    <option value="Temuan" {{ old('jenis_laporan') === 'Temuan' ? 'selected' : '' }}>Temuan</option>
                </select>
                @error('jenis_laporan')
                    <div class="field-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="field">
                <label for="nama_barang">Nama Barang <span style="color: var(--danger);">*</span></label>
                <input type="text" id="nama_barang" name="nama_barang" value="{{ old('nama_barang') }}" placeholder="Contoh: Dompet, Hp, Kacamata" required>
                @error('nama_barang')
                    <div class="field-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="field">
                <label for="kategori_barang">Kategori Barang</label>
                <input type="text" id="kategori_barang" name="kategori_barang" value="{{ old('kategori_barang') }}" placeholder="Contoh: Elektronik, Aksesori, Pakaian">
                @error('kategori_barang')
                    <div class="field-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="field">
                <label for="merek">Merek</label>
                <input type="text" id="merek" name="merek" value="{{ old('merek') }}" placeholder="Contoh: Apple, Samsung, Tidak Ada">
                @error('merek')
                    <div class="field-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="field">
                <label for="warna">Warna</label>
                <input type="text" id="warna" name="warna" value="{{ old('warna') }}" placeholder="Contoh: Hitam, Biru, Merah">
                @error('warna')
                    <div class="field-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="field">
                <label for="ciri_ciri">Ciri-ciri / Deskripsi Barang <span style="color: var(--danger);">*</span></label>
                <textarea id="ciri_ciri" name="ciri_ciri" maxlength="500" placeholder="Jelaskan ciri-ciri khusus barang (maksimal 500 karakter)" required>{{ old('ciri_ciri') }}</textarea>
                <div class="char-count"><span id="charCount">{{ strlen(old('ciri_ciri') ?? '') }}</span>/500</div>
                @error('ciri_ciri')
                    <div class="field-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="field">
                <label for="lokasi">Lokasi <span style="color: var(--danger);">*</span></label>
                <input type="text" id="lokasi" name="lokasi" value="{{ old('lokasi') }}" placeholder="Tempat barang hilang/ditemukan" required>
                @error('lokasi')
                    <div class="field-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="field">
                <label for="tanggal">Tanggal Hilang/Ditemukan <span style="color: var(--danger);">*</span></label>
                <input type="date" id="tanggal" name="tanggal" value="{{ old('tanggal') }}" required>
                @error('tanggal')
                    <div class="field-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="field">
                <label for="foto">Foto Barang (Opsional)</label>
                <div class="upload-box" id="uploadBox">
                    <input type="file" id="foto" name="foto" accept=".png,.jpg,.jpeg">
                    <svg width="34" height="34" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 16V4M12 4l-4 4M12 4l4 4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <div class="upload-title">Klik atau drag file ke sini</div>
                    <div class="upload-sub">PNG, JPG, JPEG (Maks. 5MB)</div>
                </div>
                <div class="error-text" id="fileError">Ukuran file melebihi 5MB atau format tidak didukung.</div>
                <div class="file-preview-list" id="filePreviewList"></div>
                @error('foto')
                    <div class="field-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-footer">
                <label class="anon-check">
                    <input type="checkbox" id="is_anonymous" name="is_anonymous" value="1" {{ old('is_anonymous', '1') ? 'checked' : '' }}>
                    Laporkan secara anonim
                </label>
                <button type="submit" class="submit-btn">Kirim Laporan</button>
            </div>
        </form>
    </main>

    <script>
        const ciriCiri = document.getElementById('ciri_ciri');
        const charCount = document.getElementById('charCount');
        const uploadBox = document.getElementById('uploadBox');
        const fileInput = document.getElementById('foto');
        const filePreviewList = document.getElementById('filePreviewList');
        const fileError = document.getElementById('fileError');

        const MAX_SIZE = 5 * 1024 * 1024;
        const ALLOWED_TYPES = ['image/png', 'image/jpeg'];
        let selectedFile = null;

        // Character counter
        ciriCiri.addEventListener('input', () => {
            charCount.textContent = ciriCiri.value.length;
        });

        // Upload handlers
        uploadBox.addEventListener('click', () => fileInput.click());

        uploadBox.addEventListener('dragover', (e) => {
            e.preventDefault();
            uploadBox.classList.add('dragover');
        });

        uploadBox.addEventListener('dragleave', () => {
            uploadBox.classList.remove('dragover');
        });

        uploadBox.addEventListener('drop', (e) => {
            e.preventDefault();
            uploadBox.classList.remove('dragover');
            if (e.dataTransfer.files.length > 0) {
                handleFile(e.dataTransfer.files[0]);
            }
        });

        fileInput.addEventListener('change', (e) => {
            if (e.target.files.length > 0) {
                handleFile(e.target.files[0]);
            }
        });

        function handleFile(file) {
            fileError.style.display = 'none';

            if (!ALLOWED_TYPES.includes(file.type)) {
                fileError.textContent = 'Format tidak didukung. Gunakan PNG, JPG, atau JPEG.';
                fileError.style.display = 'block';
                selectedFile = null;
                fileInput.value = '';
                renderPreview();
                return;
            }

            if (file.size > MAX_SIZE) {
                fileError.textContent = 'Ukuran file melebihi 5MB.';
                fileError.style.display = 'block';
                selectedFile = null;
                fileInput.value = '';
                renderPreview();
                return;
            }

            selectedFile = file;
            renderPreview();
        }

        function renderPreview() {
            filePreviewList.innerHTML = '';
            if (selectedFile) {
                const chip = document.createElement('div');
                chip.className = 'file-preview';
                chip.innerHTML = `<span>📎 ${selectedFile.name}</span>`;

                const removeBtn = document.createElement('button');
                removeBtn.type = 'button';
                removeBtn.textContent = '✕';
                removeBtn.addEventListener('click', (e) => {
                    e.preventDefault();
                    selectedFile = null;
                    fileInput.value = '';
                    renderPreview();
                    fileError.style.display = 'none';
                });

                chip.appendChild(removeBtn);
                filePreviewList.appendChild(chip);
            }
        }
    </script>
</body>
</html>
