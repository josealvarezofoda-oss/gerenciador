<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aluno;
use App\Models\Treino;
use App\Models\Exercicio;
use App\Models\ActivityLog;
use App\Models\Mensalidade;
use App\Models\Presenca;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // =====================
        // TOTAIS BÁSICOS
        // =====================
        $totalAlunos = Aluno::count();
        $totalTreinos = Treino::count();
        $totalExercicios = Exercicio::count();

        // =====================
        // CRESCIMENTO (6 MESES)
        // =====================
        $months = [];
        $counts = [];

        for ($i = 5; $i >= 0; $i--) {
            $dt = Carbon::now()->subMonths($i);
            $months[] = $dt->format('M');

            $counts[] = Aluno::whereBetween(
                'data_matricula',
                [$dt->copy()->startOfMonth(), $dt->copy()->endOfMonth()]
            )->count();
        }

        // =====================
        // ATIVIDADES RECENTES
        // =====================
        $recentActivities = ActivityLog::with('user')
            ->latest()
            ->take(6)
            ->get();

        // =====================
        // FINANCEIRO (MÊS ATUAL)
        // =====================
        $mensalidadesMes = Mensalidade::whereMonth('mes_referencia', now()->month)
            ->whereYear('mes_referencia', now()->year);

        // Quantidade de mensalidades
        $qtdMensalidades = $mensalidadesMes->count();

        // Valores
        $valorTotal = (clone $mensalidadesMes)->sum('valor');

        $valorPago = (clone $mensalidadesMes)
            ->where('status', 'pago')
            ->sum('valor');

        $valorPendente = (clone $mensalidadesMes)
            ->where('status', 'pendente')
            ->sum('valor');

        // Quantidade de alunos (financeiro)
        $alunosPagos = (clone $mensalidadesMes)
            ->where('status', 'pago')
            ->distinct('aluno_id')
            ->count('aluno_id');

        $alunosPendentes = (clone $mensalidadesMes)
            ->where('status', 'pendente')
            ->distinct('aluno_id')
            ->count('aluno_id');


        // =====================
        // PRESENÇA (MÊS ATUAL)
        // =====================
        $totalPresencas = Presenca::whereMonth('data', now()->month)
            ->whereYear('data', now()->year)
            ->count();

        $presencasPresentes = Presenca::where('status', 'presente')
            ->whereMonth('data', now()->month)
            ->whereYear('data', now()->year)
            ->count();

        $presencasFaltas = Presenca::where('status', 'faltou')
            ->whereMonth('data', now()->month)
            ->whereYear('data', now()->year)
            ->count();

        return view('admin.dashboard', compact(
            'totalAlunos',
            'totalTreinos',
            'totalExercicios',
            'months',
            'counts',
            'recentActivities',
            'qtdMensalidades',
            'valorTotal',
            'valorPago',
            'valorPendente',
            'alunosPagos',
            'alunosPendentes',
            'totalPresencas',
            'presencasPresentes',
            'presencasFaltas'
        ));
    }
}
