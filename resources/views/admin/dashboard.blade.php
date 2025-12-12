@extends('layouts.admin')

@section('title', 'Dashboard - FitWay')

@section('content')
<div class="p-8">
    <h1 class="text-3xl font-bold text-indigo-700 mb-8">Painel do Administrador</h1>

    <!-- GRID PRINCIPAL -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- CARD 1 - TOTAL DE ALUNOS -->
        <div class="bg-white rounded-2xl shadow-md p-6 hover:shadow-xl transition-shadow duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-semibold text-gray-700">Alunos</h2>
                    <p class="text-4xl font-bold text-indigo-600 mt-2">{{ $totalAlunos ?? 0 }}</p>
                </div>
                <div class="bg-indigo-100 p-4 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5V10H2v10h5m10 0v-4H7v4m10 0H7" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- CARD 2 - TOTAL DE TREINOS -->
        <div class="bg-white rounded-2xl shadow-md p-6 hover:shadow-xl transition-shadow duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-semibold text-gray-700">Treinos Cadastrados</h2>
                    <p class="text-4xl font-bold text-purple-600 mt-2">{{ $totalTreinos ?? 0 }}</p>
                </div>
                <div class="bg-purple-100 p-4 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m2 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- CARD 3 - EXERCÍCIOS -->
        <div class="bg-white rounded-2xl shadow-md p-6 hover:shadow-xl transition-shadow duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-semibold text-gray-700">Exercícios</h2>
                    <p class="text-4xl font-bold text-pink-600 mt-2">{{ $totalExercicios ?? 0 }}</p>
                </div>
                <div class="bg-pink-100 p-4 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-pink-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-6l-2 1m8-1l-2-1v6m1-10a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
            </div>
        </div>

    </div>

    <!-- GRÁFICO + ATIVIDADES -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-8">

        <!-- GRÁFICO -->
        <div class="lg:col-span-2 bg-white rounded-2xl shadow-md p-6 hover:shadow-xl transition duration-300">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Crescimento dos Alunos</h2>
            <canvas id="graficoAlunos" height="120"></canvas>
        </div>

        <!-- ATIVIDADES RECENTES -->
        <div class="bg-white rounded-2xl shadow-md p-6 hover:shadow-xl transition duration-300">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Atividades Recentes</h2>
            <ul class="space-y-3">
                @forelse($recentActivities ?? [] as $activity)
                    <li class="flex items-center p-3 bg-gray-100 rounded-xl">
                        <span class="material-icons text-indigo-600 mr-3">person</span>
                        {{ $activity->action }} ({{ $activity->user->name ?? 'Sistema' }})
                    </li>
                @empty
                    <li class="text-gray-500">Nenhuma atividade recente.</li>
                @endforelse
            </ul>
        </div>

    </div>
</div>

<!-- SCRIPT DO GRÁFICO -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('graficoAlunos');

new Chart(ctx, {
    type: 'line',
    data: {
        labels: {!! json_encode($chartLabels ?? ['Jan','Fev','Mar','Abr','Mai','Jun']) !!},
        datasets: [{
            label: 'Alunos ativos',
            data: {!! json_encode($chartData ?? [5,9,14,18,22,27]) !!},
            borderWidth: 3,
            tension: 0.4,
            borderColor: '#6366f1',
            backgroundColor: 'rgba(99,102,241,0.1)',
            fill: true
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { display: true }
        },
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>
@endsection
