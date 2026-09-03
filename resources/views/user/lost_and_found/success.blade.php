<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Diterima - E-Safe School</title>
    <style>
        :root {
            --primary: #2b2fa3;
            --bg-page: #eef6f4;
            --success: #1d8f5f;
            --text-dark: #1a1a2e;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            background: var(--bg-page);
            color: var(--text-dark);
        }

        .success-container {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 20px;
        }

        .success-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            padding: 60px 40px;
            text-align: center;
            max-width: 500px;
            width: 100%;
        }

        .success-icon {
            width: 80px;
            height: 80px;
            background: rgba(29, 143, 95, 0.15);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 24px;
        }

        .success-icon svg {
            width: 48px;
            height: 48px;
            color: var(--success);
            stroke-width: 1.5;
        }

        .success-text {
            font-size: 24px;
            font-weight: 700;
            color: var(--text-dark);
            margin: 0 0 12px 0;
        }

        .success-desc {
            font-size: 14px;
            color: #666;
            margin: 0 0 32px 0;
            line-height: 1.6;
        }

        .actions {
            display: flex;
            gap: 12px;
            flex-direction: column;
        }

        .actions a {
            padding: 12px 24px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all .2s ease;
        }

        .actions a.btn-primary {
            background: var(--primary);
            color: #fff;
        }

        .actions a.btn-primary:hover {
            background: #23277f;
        }

        .actions a.btn-outline {
            background: #f0f0f0;
            color: var(--text-dark);
            border: 1px solid #ddd;
        }

        .actions a.btn-outline:hover {
            background: #e8e8e8;
        }

        @media (max-width: 640px) {
            .success-card {
                padding: 40px 24px;
            }

            .success-text {
                font-size: 20px;
            }

            .success-desc {
                font-size: 13px;
            }
        }
    </style>
</head>
<body>
    <div class="success-container">
        <div class="success-card">
            <div class="success-icon">
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 22s8-4.2 8-10.5V5.5L12 3 4 5.5v6C4 17.8 12 22 12 22z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M9 12l2 2 4-4" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <p class="success-text">Terima Kasih!</p>
            <p class="success-desc">
                Laporan Lost & Found Anda telah diterima. Kami akan memproses laporan Anda dalam waktu singkat.
            </p>
            <div class="actions">
                <a href="{{ url('/') }}" class="btn-primary">← Kembali ke Beranda</a>
                <a href="{{ url('/lost-and-found') }}" class="btn-outline">Lihat Laporan Lain</a>
            </div>
        </div>
    </div>
</body>
</html>
