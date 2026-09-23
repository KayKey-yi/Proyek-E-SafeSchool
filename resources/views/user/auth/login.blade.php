<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - E-Safe School</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        *{box-sizing:border-box;margin:0;padding:0;font-family:'Segoe UI',Roboto,Helvetica,Arial,sans-serif}

        /* ── Background gradient blob (senada home.blade.php) ── */
        body{
            min-height:100vh;
            display:flex;
            align-items:center;
            justify-content:center;
            background:#dbeafe;
            position:relative;
            overflow:hidden;
        }

        /* Blob 1 – biru kuat kiri bawah */
        body::before{
            content:'';
            position:absolute;
            width:520px; height:520px;
            bottom:-120px; left:-100px;
            background:radial-gradient(circle,#1d4ed8 0%,#3b82f6 60%,transparent 100%);
            border-radius:50%;
            filter:blur(90px);
            opacity:.55;
        }
        /* Blob 2 – cyan/putih kanan atas */
        body::after{
            content:'';
            position:absolute;
            width:420px; height:420px;
            top:-80px; right:-80px;
            background:radial-gradient(circle,#bfdbfe 0%,#e0f2fe 60%,transparent 100%);
            border-radius:50%;
            filter:blur(80px);
            opacity:.7;
        }
        /* Blob 3 – teal tengah */
        .blob-mid{
            position:absolute;
            width:300px; height:300px;
            top:50%; left:30%;
            transform:translate(-50%,-50%);
            background:radial-gradient(circle,#38bdf8 0%,transparent 70%);
            border-radius:50%;
            filter:blur(70px);
            opacity:.35;
            pointer-events:none;
        }

        /* ── Wrapper 2-panel ── */
        .login-wrapper{
            position:relative;
            z-index:1;
            display:flex;
            width:820px;
            max-width:calc(100vw - 32px);
            min-height:460px;
            border-radius:28px;
            overflow:hidden;
            box-shadow:0 20px 60px rgba(30,58,138,.22), 0 4px 20px rgba(30,58,138,.12);
        }

        /* ── PANEL KIRI – form ── */
        .panel-left{
            flex:1;
            padding:52px 44px;
            display:flex;
            flex-direction:column;
            justify-content:center;
            background:rgba(255,255,255,.18);
            backdrop-filter:blur(24px);
            -webkit-backdrop-filter:blur(24px);
            border:1px solid rgba(255,255,255,.4);
            border-right:none;
            border-radius:28px 0 0 28px;
        }

        .brand-row{
            display:flex;
            align-items:center;
            gap:10px;
            margin-bottom:32px;
        }
        .brand-logo{
            width:38px; height:38px;
            border-radius:10px;
            background:#fff;
            padding:4px;
            display:flex;
            align-items:center;
            justify-content:center;
            box-shadow:0 2px 8px rgba(30,58,138,.18);
        }
        .brand-logo img{width:100%;height:100%;object-fit:contain}
        .brand-name{
            font-size:16px;
            font-weight:800;
            color:#1e3a8a;
            letter-spacing:.3px;
        }

        .panel-left h1{
            font-size:28px;
            font-weight:800;
            color:#fff;
            letter-spacing:.5px;
            margin-bottom:6px;
            text-shadow:0 2px 12px rgba(30,58,138,.2);
        }
        .panel-left .subtitle{
            font-size:13px;
            color:rgba(255,255,255,.8);
            margin-bottom:32px;
        }

        /* Error / status */
        .alert{
            padding:10px 14px;
            border-radius:10px;
            font-size:13px;
            margin-bottom:18px;
            text-align:center;
        }
        .alert-error{background:rgba(239,68,68,.2);border:1px solid rgba(239,68,68,.35);color:#fff}
        .alert-success{background:rgba(16,185,129,.2);border:1px solid rgba(16,185,129,.35);color:#fff}

        /* Input fields */
        .field-label{
            display:block;
            font-size:10.5px;
            font-weight:700;
            letter-spacing:.08em;
            text-transform:uppercase;
            color:rgba(255,255,255,.75);
            margin-bottom:6px;
        }
        .field-wrap{
            position:relative;
            margin-bottom:18px;
        }
        .field-wrap i{
            position:absolute;
            top:50%; left:15px;
            transform:translateY(-50%);
            color:rgba(255,255,255,.6);
            font-size:14px;
            pointer-events:none;
        }
        .field-wrap input{
            width:100%;
            padding:13px 16px 13px 42px;
            background:rgba(255,255,255,.12);
            border:1.5px solid rgba(255,255,255,.3);
            border-radius:50px;
            color:#fff;
            font-size:14px;
            outline:none;
            transition:border-color .2s,background .2s;
        }
        .field-wrap input::placeholder{color:rgba(255,255,255,.5)}
        .field-wrap input:focus{
            border-color:rgba(255,255,255,.75);
            background:rgba(255,255,255,.22);
        }
        /* autofill override */
        .field-wrap input:-webkit-autofill,
        .field-wrap input:-webkit-autofill:focus{
            -webkit-box-shadow:0 0 0 1000px rgba(59,130,246,.45) inset !important;
            -webkit-text-fill-color:#fff !important;
            caret-color:#fff;
        }

        /* Tombol login */
        .btn-login{
            width:100%;
            padding:14px;
            margin-top:4px;
            border:none;
            border-radius:50px;
            background:#fff;
            color:#1e40af;
            font-size:14.5px;
            font-weight:800;
            letter-spacing:.5px;
            cursor:pointer;
            box-shadow:0 6px 20px rgba(30,58,138,.2);
            transition:transform .15s,box-shadow .15s;
        }
        .btn-login:hover{transform:translateY(-2px);box-shadow:0 10px 28px rgba(30,58,138,.3)}
        .btn-login:active{transform:translateY(0)}

        .forgot-link{
            display:block;
            text-align:center;
            margin-top:14px;
            font-size:12.5px;
            color:rgba(255,255,255,.75);
            text-decoration:underline;
            text-underline-offset:3px;
        }
        .forgot-link:hover{color:#fff}

        .footer-tagline{
            margin-top:28px;
            font-size:10.5px;
            letter-spacing:1.5px;
            color:rgba(255,255,255,.5);
            text-align:center;
            text-transform:uppercase;
        }

        /* ── PANEL KANAN – ilustrasi ── */
        .panel-right{
            width:300px;
            flex-shrink:0;
            display:flex;
            flex-direction:column;
            align-items:center;
            justify-content:center;
            gap:20px;
            background:#fff;
            border-radius:0 28px 28px 0;
            padding:40px 28px;
        }

        /* Logo besar di panel kanan */
        .logo-big{
            width:130px; height:130px;
            border-radius:50%;
            background:#eff6ff;
            border:3px solid #bfdbfe;
            display:flex;
            align-items:center;
            justify-content:center;
            box-shadow:0 6px 24px rgba(30,58,138,.1);
            overflow:hidden;
        }
        .logo-big img{width:90%;height:90%;object-fit:contain}

        .panel-right h2{
            font-size:20px;
            font-weight:800;
            color:#1e3a8a;
            text-align:center;
            line-height:1.3;
        }
        .panel-right p{
            font-size:13px;
            color:#6b7280;
            text-align:center;
            line-height:1.6;
        }

        /* Ilustrasi ikon shield */
        .shield-icon{
            width:80px; height:80px;
            display:flex;
            align-items:center;
            justify-content:center;
            border-radius:50%;
            background:linear-gradient(135deg,#dbeafe 0%,#e0f2fe 100%);
            color:#1d4ed8;
            font-size:36px;
        }

        /* Dots dekorasi */
        .dots{
            display:flex;
            gap:8px;
        }
        .dots span{
            width:8px; height:8px;
            border-radius:50%;
            background:#bfdbfe;
        }
        .dots span:nth-child(2){background:#93c5fd}
        .dots span:nth-child(3){background:#60a5fa}

        /* ── Responsive ── */
        @media(max-width:680px){
            .panel-right{display:none}
            .panel-left{border-radius:24px;border:1px solid rgba(255,255,255,.4)}
            .login-wrapper{border-radius:24px;width:100%;max-width:400px}
            .panel-left{padding:40px 28px}
        }
        @media(max-width:360px){
            .panel-left{padding:32px 20px}
            .panel-left h1{font-size:24px}
        }
    </style>
</head>
<body>
    <div class="blob-mid"></div>

    <div class="login-wrapper">

        {{-- ── PANEL KIRI: Form Login ── --}}
        <div class="panel-left">

            {{-- Brand row --}}
            <div class="brand-row">
                <div class="brand-logo">
                    <img src="{{ asset('images/logo-esafe.png') }}" alt="E-Safe School">
                </div>
                <span class="brand-name">E-Safe School</span>
            </div>

            <h1>MASUK</h1>
            <p class="subtitle">Masuk untuk melanjutkan ke E-Safe School</p>

            {{-- Alert error --}}
            @if ($errors->any())
                <div class="alert alert-error">{{ $errors->first() }}</div>
            @endif

            {{-- Alert status (misal: reset password berhasil) --}}
            @if (session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif

            <form method="POST" action="{{ route('user.login.store') }}">
                @csrf

                <label class="field-label" for="email">Email</label>
                <div class="field-wrap">
                    <i class="fa-regular fa-envelope"></i>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        placeholder="email@sekolah.sch.id"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        autocomplete="email"
                    >
                </div>

                <label class="field-label" for="password">Password</label>
                <div class="field-wrap">
                    <i class="fa-solid fa-lock"></i>
                    <input
                        id="password"
                        type="password"
                        name="password"
                        placeholder="••••••••"
                        required
                        autocomplete="current-password"
                    >
                </div>

                <button type="submit" class="btn-login">MASUK</button>
            </form>

            <a href="{{ route('user.password.request') }}" class="forgot-link">Lupa Password?</a>

            <div class="footer-tagline">Lapor &nbsp;–&nbsp; Aman &nbsp;–&nbsp; Temukan</div>
        </div>

<<<<<<< HEAD
        {{-- ── PANEL KANAN: Ilustrasi ── --}}
        <div class="panel-right">
            <div class="logo-big">
                <img src="{{ asset('images/logo-esafe.png') }}" alt="E-Safe School Logo">
=======
        <div class="welcome-text">Selamat Datang</div>
        <div class="welcome-subtext">Masuk untuk melanjutkan ke E-SAFE School</div>

        @if ($errors->any())
            <div class="error-message">
                {{ $errors->first() }}
            </div>
        @endif

        @if (session('status'))
            <div class="status-message">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('user.login.store') }}">
            @csrf

            <div class="input-group">
                <span class="icon" aria-hidden="true">&#128100;</span>
                <input type="text" name="identitas" placeholder="NIS (5 digit), NISN (10 digit), atau NIP (8 digit)" value="{{ old('identitas') }}" required autofocus autocomplete="username">
>>>>>>> ac5f79cf2f7a94e4e57ecbfbbfe5fdb3b11532c3
            </div>

            <h2>E-Safe School</h2>

            <div class="shield-icon">
                <i class="fa-solid fa-shield-halved"></i>
            </div>

            <p>Platform pengaduan &amp; lost&nbsp;&amp;&nbsp;found untuk sekolah yang aman dan nyaman.</p>

            <div class="dots">
                <span></span><span></span><span></span>
            </div>
        </div>

    </div>
</body>
</html>
