<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Password Baru - E-SAFE School</title>
    <style>
        * { box-sizing: border-box; font-family: 'Segoe UI', Arial, sans-serif; }
        body { min-height: 100vh; margin: 0; display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, #4a7fd6 0%, #2f8fd6 40%, #a8c8ea 100%); position: relative; overflow: hidden; }
        body::before, body::after { content: ""; position: absolute; border-radius: 50%; background: rgba(255,255,255,.14); filter: blur(10px); }
        body::before { width: 500px; height: 500px; top: -150px; left: -150px; }
        body::after { width: 400px; height: 400px; right: -120px; bottom: -120px; background: rgba(255,255,255,.11); }
        .card { position: relative; z-index: 1; width: min(400px, calc(100% - 40px)); padding: 38px 35px 32px; background: rgba(255,255,255,.18); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px); border: 1px solid rgba(255,255,255,.35); border-radius: 28px; box-shadow: 0 8px 32px rgba(31,60,100,.25); text-align: center; }
        .logo { width: 110px; height: 110px; margin: 0 auto 22px; padding: 7px; display: flex; border-radius: 50%; background: #fff; border: 3px solid rgba(255,255,255,.6); }
        .logo img { width: 100%; object-fit: contain; }
        h1 { margin: 0 0 22px; color: #fff; font-size: 22px; }
        form { text-align: left; }
        label { display: block; margin: 0 0 7px; color: #fff; font-size: 13px; }
        .field { margin-bottom: 15px; }
        input { width: 100%; padding: 14px 16px; border: 1px solid rgba(255,255,255,.4); border-radius: 14px; outline: none; background: rgba(255,255,255,.15); color: #fff; font-size: 14px; }
        input[readonly] { opacity: .8; }
        button { width: 100%; margin-top: 5px; padding: 15px; border: 0; border-radius: 14px; background: linear-gradient(135deg,#fff 0%,#eaf2fb 100%); color: #2f6fb2; font-size: 15px; font-weight: 700; cursor: pointer; }
        .message { margin-bottom: 16px; padding: 10px; border-radius: 10px; color: #fff; font-size: 13px; background: rgba(224,92,92,.25); }
    </style>
</head>
<body>
    <main class="card">
        <div class="logo"><img src="{{ asset('images/logo-esafe.png') }}" alt="E-SAFE School Logo"></div>
        <h1>Buat Password Baru</h1>
        @if ($errors->any()) <div class="message">{{ $errors->first() }}</div> @endif
        <form method="POST" action="{{ route('user.password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <div class="field">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" readonly required>
            </div>
            <div class="field">
                <label for="password">Password Baru</label>
                <input id="password" type="password" name="password" required autocomplete="new-password">
            </div>
            <div class="field">
                <label for="password_confirmation">Konfirmasi Password Baru</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password">
            </div>
            <button type="submit">Simpan Password Baru</button>
        </form>
    </main>
</body>
</html>
