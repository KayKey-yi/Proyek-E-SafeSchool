<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
            background-color: #edf3f4;
        }

        .login-container {
            width: 100%;
            max-width: 420px;
            padding: 40px 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .logo-circle {
         .logo-circle {
         width: 190px;
         height: 190px;
         border-radius: 50%;
         background-color: #ffffff;
         border: 6px solid #dfe6e8;
         display: flex;
         align-items: center;
         justify-content: center;
         overflow: hidden;
         margin-bottom: 45px;
        }

        .logo-circle img {
          width: 100%;
          height: 100%;
          object-fit: contain;
          padding: 10px;
        }
        }

        .logo-icon {
            font-size: 34px;
            color: #2f8fd6;
            line-height: 1;
        }

        .logo-title {
            color: #1f6fb2;
            font-weight: 800;
            font-size: 20px;
            letter-spacing: 1px;
            margin-top: 4px;
        }

        .logo-subtitle {
            color: #2f8fd6;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 2px;
            margin-top: 2px;
        }

        .logo-caption {
            color: #333;
            font-size: 7px;
            letter-spacing: 1px;
            margin-top: 3px;
        }

        form {
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .input-group {
            position: relative;
            width: 100%;
        }

        .input-group .icon {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: #ffffff;
            font-size: 18px;
            pointer-events: none;
        }

        .input-group input {
            width: 100%;
            padding: 18px 20px 18px 55px;
            border-radius: 12px;
            border: none;
            outline: none;
            background-color: #b0abe8;
            color: #ffffff;
            font-size: 15px;
        }

        .input-group input::placeholder {
            color: #f0eefc;
        }

        .btn-login {
            width: 100%;
            padding: 18px;
            border-radius: 12px;
            border: 1px solid #c9c9c9;
            background-color: #ffffff;
            color: #1a1a1a;
            font-size: 18px;
            font-weight: 700;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .btn-login:hover {
            background-color: #f5f5f5;
        }

        .error-message {
            color: #e05c5c;
            font-size: 13px;
            text-align: center;
            margin-top: -8px;
        }
    </style>
</head>
<body>

    <div class="login-container">

        <div class="logo-circle">
           <img src="{{ asset('images/logo-esafe.png') }}" alt="E-SAFE School">
        </div>

        @if ($errors->any())
            <div class="error-message">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="input-group">
                <span class="icon">&#128100;</span>
                <input type="text" name="username" placeholder="Username" required autofocus>
            </div>

            <div class="input-group">
                <span class="icon">&#128274;</span>
                <input type="password" name="password" placeholder="Password" required>
            </div>

            <button type="submit" class="btn-login">Login</button>

        </form>

    </div>

</body>
</html>