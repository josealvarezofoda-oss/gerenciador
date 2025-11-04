<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FitWay - Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Titillium Web', sans-serif;
            background: linear-gradient(135deg, #4A90FF, #6D5DFB, #9B51E0);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            position: relative;
        }
        .logo {
            position: absolute;
            top: 20px;
            left: 20px;
            display: flex;
            align-items: center;
            font-weight: 700;
            font-size: 1.5rem;
            color: white;
            text-shadow: 0 2px 6px rgba(0,0,0,0.5);
        }
        .logo svg {
            width: 50px;
            height: 50px;
            margin-right: 10px;
        }
        .login-card {
            display: flex;
            width: 1000px;
            max-width: 90%;
            border-radius: 1.25rem;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0,0,0,0.25);
            background: #fff;
            transform: translateY(20px);
            opacity: 0;
            transition: all 0.6s ease;
        }
        .login-card.show {
            transform: translateY(0);
            opacity: 1;
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
            padding: 4rem 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .right h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }
        .right p {
            color: #6b7280;
            margin-bottom: 2.5rem;
        }
        input {
            width: 100%;
            padding: 0.85rem 1rem;
            border-radius: 0.85rem;
            border: 1px solid #e5e7eb;
            margin-top: 0.5rem;
            background: #f9fafb;
            transition: all 0.3s ease;
        }
        input:focus {
            outline: none;
            border-color: #4A3FFC;
            box-shadow: 0 0 0 3px rgba(74,63,252,0.2);
        }
        button {
            background: linear-gradient(135deg, #4A90FF, #6D5DFB, #9B51E0);
            color: white;
            font-weight: 600;
            padding: 0.85rem 1rem;
            border-radius: 1rem;
            width: 100%;
            margin-top: 1.25rem;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 6px 20px rgba(74,63,252,0.5);
        }
        button:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 30px rgba(74,63,252,0.7);
            background: linear-gradient(135deg, #6D5DFB, #4A90FF, #9B51E0);
            opacity: 0.95;
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
            margin-bottom: 1.25rem;
        }
        @media(max-width:768px){
            .login-card {
                flex-direction: column;
            }
            .login-card .left {
                height: 200px;
            }
        }
    </style>
</head>
<body>
    <div class="logo">
        <svg viewBox="0 0 64 64" fill="white" xmlns="http://www.w3.org/2000/svg">
            <rect x="4" y="28" width="8" height="8"/>
            <rect x="52" y="28" width="8" height="8"/>
            <rect x="12" y="26" width="40" height="12" rx="2"/>
        </svg>
        FitWay
    </div>

    <div class="login-card">
        <div class="left">
            <img src="https://i.pinimg.com/1200x/15/36/64/1536647ebb3f819f6d320596393019f4.jpg" alt="Ilustração">
        </div>
        <div class="right">
            <h1 class="text-2xl md:text-3xl lg:text-4xl font-bold">
                FitWay <span class="text-[#4A3FFC] whitespace-nowrap">Tudo em um único lugar</span>
            </h1>
            <p>Login na sua conta</p>
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
                    <label class="flex items-center whitespace-nowrap">
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

    <script>
        window.addEventListener('DOMContentLoaded', () => {
            document.querySelector('.login-card').classList.add('show');
        });
    </script>
</body>
</html>
