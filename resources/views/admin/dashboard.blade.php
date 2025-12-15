@extends('layouts.admin')

@section('title', 'Dashboard - FitWay')

@section('content')
<div class="p-8">
    <h1 class="text-3xl font-bold text-indigo-700 mb-8">Painel do Administrador</h1>

    <!-- CARDS DE RESUMO -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-20 gap-6">

        <!-- ALUNOS -->
        <div class="bg-white rounded-2xl shadow-md p-6 hover:shadow-xl transition">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-sm font-semibold text-gray-500">Alunos</h2>
                    <p class="text-4xl font-bold text-indigo-600">{{ $totalAlunos ?? 0 }}</p>
                </div>
                <div class="bg-indigo-100 p-4 rounded-full">
                    <svg class="h-8 w-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-width="2" d="M17 20h5V10H2v10h5" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- TREINOS -->
        <div class="bg-white rounded-2xl shadow-md p-6 hover:shadow-xl transition">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-sm font-semibold text-gray-500">Treinos</h2>
                    <p class="text-4xl font-bold text-purple-600">{{ $totalTreinos ?? 0 }}</p>
                </div>
                <div class="bg-purple-100 p-4 rounded-full">
                    <svg class="h-8 w-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-width="2" d="M9 12h6" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- EXERCÍCIOS -->
        <div class="bg-white rounded-2xl shadow-md p-6 hover:shadow-xl transition">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-sm font-semibold text-gray-500">Exercícios</h2>
                    <p class="text-4xl font-bold text-pink-600">{{ $totalExercicios ?? 0 }}</p>
                </div>
                <div class="bg-pink-100 p-4 rounded-full">
                    <svg class="h-8 w-8 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-width="2" d="M12 6v12" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- PRESENÇAS -->
        <div class="bg-white rounded-2xl shadow-md p-6 hover:shadow-xl transition">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-sm font-semibold text-gray-500">Presenças</h2>
                    <p class="text-4xl font-bold text-yellow-500">{{ $totalPresencas ?? 0 }}</p>
                </div>
                <div class="bg-yellow-100 p-4 rounded-full">
                    <svg class="h-8 w-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- GRÁFICOS + ATIVIDADES -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-10">

        <!-- CRESCIMENTO DE ALUNOS -->
        <div class="lg:col-span-2 bg-white rounded-2xl shadow-md p-6">
            <h2 class="text-lg font-semibold text-gray-700 mb-4">Crescimento dos Alunos</h2>
            <canvas id="graficoAlunos" height="120"></canvas>
        </div>

        <!-- FINANCEIRO -->
        <div class="bg-white rounded-2xl shadow-md p-6">
            <h2 class="text-lg font-semibold text-gray-700 mb-4">Financeiro do Mês</h2>

            <canvas id="graficoFinanceiro" height="160"></canvas>

            <div class="flex justify-around mt-4 text-sm font-semibold">
                <div class="flex items-center gap-2 text-red-500">
                    <span class="w-3 h-3 rounded-full bg-red-500 inline-block"></span>
                    Pendente: R$ {{ number_format($valorPendente ?? 0, 2, ',', '.') }} 
                    ({{ $alunosPendentes ?? 0 }} alunos)
                </div>
                <div class="flex items-center gap-2 text-green-600">
                    <span class="w-3 h-3 rounded-full bg-green-500 inline-block"></span>
                    Pago: R$ {{ number_format($valorPago ?? 0, 2, ',', '.') }} 
                    ({{ $alunosPagos ?? 0 }} alunos)
                </div>

            </div>
        </div>


        <!-- ATIVIDADES -->
        <div class="bg-white rounded-2xl shadow-md p-6 w-[1610px]">
            <h2 class="text-lg font-semibold text-gray-700 mb-4">Atividades Recentes</h2>
            <ul class="space-y-3">
                @forelse($recentActivities ?? [] as $activity)
                    <li class="p-3 bg-gray-100 rounded-xl text-sm">
                        {{ $activity->action }} ({{ $activity->user->name ?? 'Sistema' }})
                    </li>
                @empty
                    <li class="text-gray-500">Nenhuma atividade recente.</li>
                @endforelse
            </ul>
        </div>

    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
new Chart(document.getElementById('graficoAlunos'), {
    type: 'line',
    data: {
        labels: {!! json_encode($months ?? []) !!},
        datasets: [{
            label: 'Alunos',
            data: {!! json_encode($counts ?? []) !!},
            borderColor: '#6366f1',
            backgroundColor: 'rgba(99,102,241,0.15)',
            tension: 0.4,
            fill: true
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    stepSize: 1,
                    precision: 0 
                }
            }
        }
    }
});

new Chart(document.getElementById('graficoFinanceiro'), {
    type: 'doughnut',
    data: {
        labels: ['Pago', 'Pendente'],
        datasets: [{
            data: [
                {{ max($valorPago ?? 0, 0) }},
                {{ max($valorPendente ?? 0, 0) }}
            ],
            backgroundColor: ['#22c55e', '#ef4444'],
            borderWidth: 1
        }]
    },
    options: {
        plugins: {
            legend: {
                display: false // esconde a legenda do Chart, pois já colocamos abaixo
            },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        let label = context.label || '';
                        let value = context.raw || 0;
                        return label + ': R$ ' + value.toLocaleString('pt-BR', {minimumFractionDigits: 2});
                    }
                }
            }
        }
    }
});

</script>
@endpush
@endsection
