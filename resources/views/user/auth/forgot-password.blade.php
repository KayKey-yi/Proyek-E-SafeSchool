<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - E-SAFE School</title>
    <style>
        * { box-sizing: border-box; font-family: 'Segoe UI', Arial, sans-serif; }
        body { min-height: 100vh; margin: 0; display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, #4a7fd6 0%, #2f8fd6 40%, #a8c8ea 100%); position: relative; overflow: hidden; }
        body::before, body::after { content: ""; position: absolute; border-radius: 50%; background: rgba(255,255,255,.14); filter: blur(10px); }
        body::before { width: 500px; height: 500px; top: -150px; left: -150px; }
        body::after { width: 400px; height: 400px; right: -120px; bottom: -120px; background: rgba(255,255,255,.11); }
        .card { position: relative; z-index: 1; width: min(400px, calc(100% - 40px)); padding: 45px 35px 35px; background: rgba(255,255,255,.18); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px); border: 1px solid rgba(255,255,255,.35); border-radius: 28px; box-shadow: 0 8px 32px rgba(31,60,100,.25); text-align: center; }
        .logo { width: 120px; height: 120px; margin: 0 auto 24px; padding: 7px; display: flex; border-radius: 50%; background: #fff; border: 3px solid rgba(255,255,255,.6); box-shadow: 0 6px 20px rgba(31,60,100,.3); }
        .logo img { width: 100%; object-fit: contain; }
        h1 { margin: 0 0 8px; color: #fff; font-size: 22px; }
        p { margin: 0 0 24px; color: rgba(255,255,255,.85); font-size: 13px; line-height: 1.5; }
        form { text-align: left; }
        label { display: block; margin-bottom: 8px; color: #fff; font-size: 13px; }
        input { width: 100%; padding: 15px 16px; border: 1px solid rgba(255,255,255,.4); border-radius: 14px; outline: none; background: rgba(255,255,255,.15); color: #fff; font-size: 14px; }
        input::placeholder { color: rgba(255,255,255,.75); }
        button { width: 100%; margin-top: 18px; padding: 15px; border: 0; border-radius: 14px; background: linear-gradient(135deg,#fff 0%,#eaf2fb 100%); color: #2f6fb2; font-size: 15px; font-weight: 700; cursor: pointer; }
        .message { margin-bottom: 16px; padding: 10px; border-radius: 10px; color: #fff; font-size: 13px; background: rgba(224,92,92,.25); }
        .status { background: rgba(16,185,129,.2); }
        .back { display: block; margin-top: 20px; color: rgba(255,255,255,.9); font-size: 13px; text-decoration: underline; }
    </style>
</head>
<body>
    <main class="card">
        <div class="logo"><img src="{{ asset('images/logo-esafe.png') }}" alt="E-SAFE School Logo"></div>
        <h1>Lupa Password?</h1>
        <p>Masukkan email Anda dan kami akan mengirimkan link untuk membuat password baru.</p>
        @if (session('status')) <div class="message status">{{ session('status') }}</div> @endif
        @if ($errors->any()) <div class="message">{{ $errors->first() }}</div> @endif
        <form method="POST" action="{{ route('user.password.email') }}">
            @csrf
            <label for="email">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="Masukkan email Anda" required autofocus>
            <button type="submit">Kirim Link Reset</button>
        </form>
        <a class="back" href="{{ route('user.login') }}">Kembali ke Login</a>
    </main>
</body>
</html>
