<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Buat Pengaduan Baru - E-Safe School</title>
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

        select.select-placeholder { color: var(--text-muted); }

        .toast {
            position: fixed;
            bottom: 24px;
            left: 50%;
            transform: translateX(-50%) translateY(10px);
            background: var(--text-dark);
            color: #fff;
            padding: 12px 20px;
            border-radius: 8px;
            font-size: 14px;
            opacity: 0;
            pointer-events: none;
            transition: opacity .2s ease, transform .2s ease;
        }

        .toast.show {
            opacity: 1;
            transform: translateX(-50%) translateY(0);
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
            <a href="#">Lost &amp; Found</a>
            <a href="{{ route('complaints.user.index') }}" class="active">Pengaduan</a>
        </nav>
    </header>

    <div class="page-title-bar">
        <h1>Buat Pengaduan Baru</h1>
    </div>

    <main>
        <form class="card" id="pengaduanForm" method="POST" action="{{ route('complaints.user.store') }}" enctype="multipart/form-data">
            @csrf

            @if (isset($errors) && $errors->any())
                <div class="alert-banner alert-error">
                    <strong>Validasi Gagal:</strong> {{ $errors->first() }}
                </div>
            @endif

            <div class="field">
                <label for="kategori">Kategori Pengaduan <span style="color: var(--danger);">*</span></label>
                <select id="kategori" name="kategori" required>
                    <option value="">-- Pilih Kategori --</option>
                    <option value="Bullying" {{ old('kategori') === 'Bullying' ? 'selected' : '' }}>Bullying</option>
                    <option value="Kekerasan" {{ old('kategori') === 'Kekerasan' ? 'selected' : '' }}>Kekerasan</option>
                    <option value="Kehilangan Barang" {{ old('kategori') === 'Kehilangan Barang' ? 'selected' : '' }}>Kehilangan Barang</option>
                    <option value="Kerusakan Fasilitas" {{ old('kategori') === 'Kerusakan Fasilitas' ? 'selected' : '' }}>Kerusakan Fasilitas</option>
                    <option value="Lainnya" {{ old('kategori') === 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                </select>
                @error('kategori')
                    <div class="field-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="field">
                <label for="lokasi">Lokasi Kejadian <span style="color: var(--danger);">*</span></label>
                <select id="lokasi" name="lokasi" class="select-placeholder" required>
                    <option value="" disabled {{ old('lokasi') ? '' : 'selected' }}>Pilih Lokasi Kejadian</option>
                    @foreach (['Ruang Kelas', 'Kantin', 'Perpustakaan', 'Lapangan Olahraga', 'Area Parkir', 'Toilet', 'Lainnya'] as $location)
                        <option value="{{ $location }}" {{ old('lokasi') === $location ? 'selected' : '' }}>{{ $location }}</option>
                    @endforeach
                </select>
                @error('lokasi')
                    <div class="field-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="field">
                <label for="waktu">Waktu Kejadian <span style="color: var(--danger);">*</span></label>
                <input type="datetime-local" id="waktu" name="waktu" value="{{ old('waktu') }}" required>
                @error('waktu')
                    <div class="field-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="field">
                <label for="deskripsi">Deskripsi Kejadian <span style="color: var(--danger);">*</span></label>
                <textarea id="deskripsi" name="deskripsi" maxlength="500" placeholder="Jelaskan kejadian secara detail (maksimal 500 karakter)" required>{{ old('deskripsi') }}</textarea>
                <div class="char-count"><span id="charCount">{{ strlen(old('deskripsi') ?? '') }}</span>/500</div>
                @error('deskripsi')
                    <div class="field-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="field">
                <label for="bukti">Upload Bukti (Opsional)</label>
                <div class="upload-box" id="uploadBox">
                    <input type="file" id="bukti" name="bukti" accept=".png,.jpg,.jpeg">
                    <svg width="34" height="34" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 16V4M12 4l-4 4M12 4l4 4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <div class="upload-title">Klik atau drag file ke sini</div>
                    <div class="upload-sub">PNG, JPG, JPEG (Maks. 5MB)</div>
                </div>
                <div class="error-text" id="fileError">Ukuran file melebihi 5MB atau format tidak didukung.</div>
                <div class="file-preview-list" id="filePreviewList"></div>
                @error('bukti')
                    <div class="field-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-footer">
                <label class="anon-check">
                    <input type="checkbox" id="anonim" name="anonim" value="1" {{ old('anonim', '1') ? 'checked' : '' }}>
                    Kirim secara anonim
                </label>
                <button type="submit" class="submit-btn">Kirim Pengaduan</button>
            </div>
        </form>
    </main>

    <div class="toast" id="toast">Pengaduan berhasil dikirim.</div>

    <script>
        const deskripsi = document.getElementById('deskripsi');
        const charCount = document.getElementById('charCount');
        const uploadBox = document.getElementById('uploadBox');
        const fileInput = document.getElementById('bukti');
        const filePreviewList = document.getElementById('filePreviewList');
        const fileError = document.getElementById('fileError');

        const MAX_SIZE = 5 * 1024 * 1024;
        const ALLOWED_TYPES = ['image/png', 'image/jpeg'];
        let selectedFile = null;

        // Character counter
        deskripsi.addEventListener('input', () => {
            charCount.textContent = deskripsi.value.length;
        });

        const lokasi = document.getElementById('lokasi');
        lokasi.addEventListener('change', () => {
            lokasi.classList.toggle('select-placeholder', lokasi.value === '');
        });

        // Upload box handlers
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
