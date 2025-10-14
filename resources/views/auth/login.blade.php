<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FitWay - Login</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Fonts: Titillium Web -->
    <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Titillium Web', sans-serif;
            /* Degradê full screen */
            background: linear-gradient(135deg, #4A90FF, #6D5DFB, #9B51E0);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .login-card {
            display: flex;
            width: 900px;
            max-width: 95%;
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            background: #fff;
        }

        .login-card .left {
            flex: 1;
            position: relative;
        }

        .login-card .left img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .login-card .right {
            flex: 1;
            padding: 3rem 2rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .right h1 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .right p {
            color: #6b7280;
            margin-bottom: 2rem;
        }

        input {
            width: 100%;
            padding: 0.75rem 1rem;
            border-radius: 0.75rem;
            border: 1px solid #e5e7eb;
            margin-top: 0.5rem;
            background: #f9fafb;
        }

        input:focus {
            outline: none;
            border-color: #4A3FFC;
            box-shadow: 0 0 0 3px rgba(74,63,252,0.2);
        }

        button {
            background: #4A3FFC;
            color: white;
            padding: 0.75rem 1rem;
            border-radius: 0.75rem;
            font-weight: 600;
            width: 100%;
            margin-top: 1rem;
            border: none;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            opacity: 0.9;
        }

        a {
            font-size: 0.9rem;
            color: #4A3FFC;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .form-group {
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>

    <div class="login-card">
        <div class="left">
            <img src="https://i.pinimg.com/1200x/15/36/64/1536647ebb3f819f6d320596393019f4.jpg" alt="Ilustração">
        </div>

        <div class="right">
            <h1>FitWay <span style="color:#4A3FFC;">Tudo em um lugar</span></h1>
            <p>Logue na sua conta</p>

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <input type="email" name="email" placeholder="Seu email" required />
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <input type="password" name="password" placeholder="Sua senha" required />
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-between items-center mb-4">
                    <label class="flex items-center">
                        <input type="checkbox" name="remember" class="mr-2">
                        Manter-me Conectado
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">Esqueceu sua senha?</a>
                    @endif
                </div>

                <button type="submit">Login</button>
            </form>
        </div>
    </div>

</body>
</html>
