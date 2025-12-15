<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FitWay - Aluno</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background: #f4f6fa;
        }

        .sidebar {
            width: 85px;             /* <-- AUMENTADO DE 70px PARA 85px */
            transition: width 0.30s ease;
            overflow: hidden;
        }

        .sidebar:hover {
            width: 240px;
        }

        .label {
            opacity: 0;
            white-space: nowrap;
            overflow: hidden;
            transition: opacity 0.25s ease;
        }

        .sidebar:hover .label {
            opacity: 1;
        }

        .nav-item {
            justify-content: center;
        }

        .sidebar:hover .nav-item {
            justify-content: flex-start;
        }

        .fitway {
            font-size: 22px;
            font-weight: 700;
            white-space: nowrap;
            text-align: center;
            width: 100%;
        }

        .fitway-container {
            width: 100%;
            display: flex;
            justify-content: center;
        }
    </style>
</head>

<body class="flex min-h-screen">

    <div class="sidebar bg-gradient-to-b from-blue-900 to-blue-900 text-white flex flex-col shadow-lg">


        <div class="fitway-container p-4 h-[70px] border-b border-white/20">
            <span class="fitway">FitWay</span>
        </div>

        <nav class="flex flex-col mt-4 space-y-1">

            <a href="{{ route('aluno.dashboard') }}"
               class="nav-item flex items-center gap-4 px-4 py-3 hover:bg-white/20 transition rounded-md">
                <span class="material-icons">person</span>
                <span class="label text-lg font-medium">Meu Perfil</span>
            </a>

            <a href="{{ route('aluno.treinos.index') }}"
               class="nav-item flex items-center gap-4 px-4 py-3 hover:bg-white/20 transition rounded-md">
                <span class="material-icons">fitness_center</span>
                <span class="label text-lg font-medium">Meus Treinos</span>
            </a>

        </nav>

        <form action="{{ route('logout') }}" method="POST" class="mt-auto p-4">
            @csrf
            <button class="nav-item flex items-center gap-4 w-full px-4 py-3 bg-red-500 hover:bg-red-600 transition rounded-lg">
                <span class="material-icons text-xl">logout</span>
                <span class="label font-medium">Sair</span>
            </button>
        </form>

    </div>

    <div class="flex-1 p-8 overflow-auto">
        @yield('content')
    </div>

</body>
</html>
