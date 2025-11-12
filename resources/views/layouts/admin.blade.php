<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FitWay - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        body { font-family: 'Roboto', sans-serif; background: #f4f6fa; }
        .fade { animation: fade 0.4s ease-in-out; }
        @keyframes fade { from {opacity:0; transform:translateY(10px);} to {opacity:1; transform:translateY(0);} }
    </style>
</head>

<body class="flex min-h-screen" x-data="{ open: true }">
    <!-- Sidebar -->
    <div 
        class="bg-gradient-to-b from-indigo-600 to-purple-600 text-white flex flex-col shadow-lg transition-all duration-300"
        :class="{ 'w-64': open, 'w-20': !open }"
    >
        <!-- Topo -->
        <div class="flex items-center justify-between p-4 border-b border-white/20">
            <h1 class="text-2xl font-bold tracking-wide" x-show="open" x-transition>FitWay</h1>
            <button @click="open = !open" class="text-white focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>

        <!-- Navegação -->
        <nav class="flex flex-col mt-6 space-y-1">
            <a href="{{ route('admin.dashboard') }}" 
               class="flex items-center px-6 py-3 mx-2 rounded-lg hover:bg-white/20 transition text-lg font-medium">
                <span class="material-icons mr-3" x-show="open">person</span>
                <span x-show="open">Perfil do Admin</span>
                <span x-show="!open" class="mx-auto material-icons">person</span>
            </a>

            <a href="{{ route('admin.alunos.index') }}" 
               class="flex items-center px-6 py-3 mx-2 rounded-lg hover:bg-white/20 transition text-lg font-medium">
                <span class="material-icons mr-3" x-show="open">group</span>
                <span x-show="open">Gerenciar Alunos</span>
                <span x-show="!open" class="mx-auto material-icons">group</span>
            </a>

            <a href="{{ route('admin.treinos.index', ['aluno' => 1]) }}" 
               class="flex items-center px-6 py-3 mx-2 rounded-lg hover:bg-white/20 transition text-lg font-medium">
                <span class="material-icons mr-3" x-show="open">fitness_center</span>
                <span x-show="open">Gerenciar Treinos</span>
                <span x-show="!open" class="mx-auto material-icons">fitness_center</span>
            </a>
        </nav>

        <!-- Botão de sair -->
        <form action="{{ route('logout') }}" method="POST" class="mt-auto p-4">
            @csrf
            <button 
                class="flex items-center w-full px-4 py-2 bg-red-500 hover:bg-red-600 rounded-lg transition font-medium">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h6a2 2 0 012 2v1"/>
                </svg>
                <span x-show="open">Sair</span>
            </button>
        </form>
    </div>

    <!-- Conteúdo principal -->
    <div class="flex-1 p-8 overflow-auto">
        @yield('content')
    </div>
</body>
</html>
