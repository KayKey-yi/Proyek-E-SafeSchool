<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - E-SAFE School</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Arial, sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #4a7fd6 0%, #2f8fd6 40%, #a8c8ea 100%);
            position: relative;
            overflow: hidden;
        }

        body::before,
        body::after {
            content: "";
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.14);
            filter: blur(10px);
        }

        body::before {
            width: 500px;
            height: 500px;
            top: -150px;
            left: -150px;
        }

        body::after {
            width: 400px;
            height: 400px;
            right: -120px;
            bottom: -120px;
            background: rgba(255, 255, 255, 0.11);
        }

        .login-container {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 400px;
            margin: 20px;
            padding: 45px 35px 35px;
            display: flex;
            flex-direction: column;
            align-items: center;
            background: rgba(255, 255, 255, 0.18);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.35);
            border-radius: 28px;
            box-shadow: 0 8px 32px rgba(31, 60, 100, 0.25);
        }

        .logo-circle {
            width: 150px;
            height: 150px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 30px;
            overflow: hidden;
            background-color: #ffffff;
            border: 3px solid rgba(255, 255, 255, 0.6);
            border-radius: 50%;
            box-shadow: 0 6px 20px rgba(31, 60, 100, 0.3);
        }

        .logo-circle img {
            width: 100%;
            height: 100%;
            padding: 8px;
            object-fit: contain;
        }

        .welcome-text {
            margin-bottom: 4px;
            color: #ffffff;
            font-size: 22px;
            font-weight: 700;
            text-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
        }

        .welcome-subtext {
            margin-bottom: 28px;
            color: rgba(255, 255, 255, 0.85);
            font-size: 13px;
            text-align: center;
        }

        form {
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 18px;
        }

        .input-group {
            position: relative;
            width: 100%;
        }

        .input-group .icon {
            position: absolute;
            top: 50%;
            left: 18px;
            transform: translateY(-50%);
            color: rgba(255, 255, 255, 0.9);
            font-size: 17px;
            pointer-events: none;
        }

        .input-group input {
            width: 100%;
            padding: 16px 18px 16px 50px;
            outline: none;
            border: 1px solid rgba(255, 255, 255, 0.4);
            border-radius: 14px;
            background: rgba(255, 255, 255, 0.15);
            color: #ffffff;
            font-size: 14.5px;
            transition: all 0.25s ease;
        }

        .input-group input:focus {
            border-color: rgba(255, 255, 255, 0.7);
            background: rgba(255, 255, 255, 0.25);
        }

        .input-group input::placeholder {
            color: rgba(255, 255, 255, 0.75);
        }

        .input-group input:-webkit-autofill,
        .input-group input:-webkit-autofill:hover,
        .input-group input:-webkit-autofill:focus,
        .input-group input:-webkit-autofill:active {
            -webkit-box-shadow: 0 0 0 1000px rgba(80, 120, 190, 0.55) inset !important;
            -webkit-text-fill-color: #ffffff !important;
            caret-color: #ffffff;
            transition: background-color 5000s ease-in-out 0s;
        }

        .btn-login {
            width: 100%;
            padding: 16px;
            margin-top: 6px;
            border: none;
            border-radius: 14px;
            background: linear-gradient(135deg, #ffffff 0%, #eaf2fb 100%);
            color: #2f6fb2;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 0 6px 18px rgba(20, 40, 80, 0.2);
            transition: transform 0.15s ease, box-shadow 0.15s ease;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 22px rgba(20, 40, 80, 0.28);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .error-message {
            width: 100%;
            padding: 10px 14px;
            margin-bottom: 18px;
            border: 1px solid rgba(224, 92, 92, 0.5);
            border-radius: 10px;
            background: rgba(224, 92, 92, 0.25);
            color: #ffffff;
            font-size: 13px;
            text-align: center;
        }

        .status-message {
            width: 100%;
            padding: 10px 14px;
            margin-bottom: 18px;
            border: 1px solid rgba(16, 185, 129, 0.45);
            border-radius: 10px;
            background: rgba(16, 185, 129, 0.2);
            color: #ffffff;
            font-size: 13px;
            text-align: center;
        }

        .register-link {
            margin-top: 22px;
            color: rgba(255, 255, 255, 0.85);
            font-size: 13px;
            text-align: center;
        }

        .register-link a {
            color: #ffffff;
            font-weight: 700;
            text-decoration: underline;
        }

        .footer-text {
            margin-top: 18px;
            color: rgba(255, 255, 255, 0.7);
            font-size: 11px;
            letter-spacing: 1px;
            text-align: center;
        }

        @media (max-width: 480px) {
            .login-container {
                padding: 35px 24px 28px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="logo-circle">
            <img src="{{ asset('images/logo-esafe.png') }}" alt="E-SAFE School Logo">
        </div>

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
                <input type="text" name="email" placeholder="Username atau Email" required autofocus autocomplete="username">
            </div>

            <div class="input-group">
                <span class="icon" aria-hidden="true">&#128274;</span>
                <input type="password" name="password" placeholder="Password" required autocomplete="current-password">
            </div>

            <button type="submit" class="btn-login">Login</button>
        </form>

        <div class="register-link">
            Belum punya akun? <a href="{{ route('user.register') }}">Daftar di sini</a>
        </div>

        <div class="footer-text">LAPOR &nbsp;–&nbsp; AMAN &nbsp;–&nbsp; TEMUKAN</div>
    </div>
</body>
</html>