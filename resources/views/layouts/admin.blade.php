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
        @keyframes fadeSlide { from {opacity:0; transform:translateY(12px);} to {opacity:1; transform:translateY(0);} }
        .animate-soft { animation: fadeSlide .45s ease-out; }
    </style>
</head>

<body class="flex min-h-screen">

    <!-- SIDEBAR ADMIN -->
    <div 
        x-data="{ hover:false, ready:false }"
        @mouseenter="hover = true; setTimeout(() => ready = true, 180)"
        @mouseleave="hover = false; ready = false"
        class="bg-gradient-to-b from-indigo-600 to-purple-600 text-white flex flex-col shadow-xl transition-all duration-500 ease-in-out"
        :class="{ 'w-64': hover, 'w-20': !hover }"
    >

        <!-- LOGO -->
        <div class="flex items-center justify-center p-4 border-b border-white/20 w-full overflow-hidden">
            <h1 class="text-2xl font-bold tracking-wide transition-all duration-500"
                  :class="{ 'opacity-100 scale-100': hover, 'opacity-100 scale-90': !hover }">
                FitWay
            </h1>
        </div>

        <!-- NAV -->
        <nav class="flex flex-col mt-6 space-y-1">

            <!-- PERFIL -->
            <a href="{{ route('admin.dashboard') }}" 
                class="flex items-center px-6 py-3 mx-2 rounded-lg hover:bg-white/20 transition duration-300 text-lg font-medium">
                <span class="material-icons">person</span>
                <span class="ml-3 whitespace-nowrap transition-all duration-300" 
                    x-show="hover && ready">Perfil do Admin</span>
            </a>

            <!-- ALUNOS -->
            <a href="{{ route('admin.alunos.index') }}" 
                class="flex items-center px-6 py-3 mx-2 rounded-lg hover:bg-white/20 transition duration-300 text-lg font-medium">
                <span class="material-icons">group</span>
                <span class="ml-3 whitespace-nowrap transition-all duration-300" 
                    x-show="hover && ready">Gerenciar Alunos</span>
            </a>

            <!-- TREINOS & EXERCÍCIOS (ATUALIZADO) -->
            <div x-data="{ menu:false }">

                <!-- BOTÃO MELHORADO -->
                <button 
                    @click="menu = !menu"
                    class="w-full flex items-center px-6 py-3 mx-2 rounded-lg 
                           bg-white/10 hover:bg-white/20
                           transition-all duration-300 text-lg font-medium
                           shadow-sm hover:shadow-md"
                >
                    <span class="material-icons text-xl">fitness_center</span>

                    <span class="ml-3 whitespace-nowrap transition-all duration-300"
                          x-show="hover && ready">
                        Treinos & Exercícios
                    </span>

                    <!-- ÍCONE ANIMADO -->
                    <span class="material-icons ml-auto transition-transform duration-300"
                        x-show="hover && ready"
                        :class="{ 'rotate-180': menu }">
                        expand_more
                    </span>
                </button>

                <!-- MENU INTERNO -->
                <div 
                    x-show="menu && hover && ready"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 -translate-y-2"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    class="ml-12 mt-2 space-y-2 animate-soft"
                >
                    <a href="{{ route('admin.treinos.index') }}"
                    class="block px-4 py-2 rounded-lg bg-white/10 hover:bg-white/20 transition">
                        • Listar Treinos
                    </a>

                    <a href="{{ route('admin.treinos.criar') }}"
                    class="block px-4 py-2 rounded-lg bg-white/10 hover:bg-white/20 transition">
                        • Criar Treino
                    </a>

                    <a href="{{ route('admin.exercicios.index') }}"
                    class="block px-4 py-2 rounded-lg bg-white/10 hover:bg-white/20 transition">
                        • Listar Exercícios
                    </a>

                    <a href="{{ route('admin.exercicios.create') }}"
                    class="block px-4 py-2 rounded-lg bg-white/10 hover:bg-white/20 transition">
                        • Criar Exercício
                    </a>
                </div>
            </div>

        </nav>

        <!-- LOGOUT -->
        <form action="{{ route('logout') }}" method="POST" class="mt-auto p-4">
            @csrf
            <button 
                class="flex items-center w-full px-4 py-2 bg-red-500 hover:bg-red-600 rounded-lg transition duration-300 font-medium">
                <span class="material-icons">logout</span>
                <span class="ml-3 whitespace-nowrap transition-all duration-300"
                    x-show="hover && ready">Sair</span>
            </button>
        </form>

    </div>

    <!-- CONTEÚDO -->
    <div class="flex-1 p-8 overflow-auto animate-soft">
        @yield('content')
    </div>

</body>
</html>
