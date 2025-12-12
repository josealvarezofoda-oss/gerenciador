<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Treino; // adapte se seu model tiver outro nome
use App\Models\Exercicio;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'is_admin']); // ver abaixo sobre middleware is_admin
    }

    public function index()
    {
        $totalAlunos = User::where('role', 'aluno')->count(); // adapte se usa is_admin boolean
        $totalTreinos = Treino::count();
        $totalExercicios = Exercicio::count();

        // últimos 6 meses - labels e counts
        $months = [];
        $counts = [];
        for ($i = 5; $i >= 0; $i--) {
            $dt = Carbon::now()->subMonths($i);
            $months[] = $dt->format('M'); // Jan, Feb...
            $start = $dt->copy()->startOfMonth()->toDateString();
            $end = $dt->copy()->endOfMonth()->toDateString();
            $counts[] = User::where('role', 'aluno')->whereBetween('created_at', [$start, $end])->count();
        }

        $recentActivities = ActivityLog::with('user')->latest()->take(6)->get();

        return view('admin.dashboard', [
            'totalAlunos' => $totalAlunos,
            'totalTreinos' => $totalTreinos,
            'totalExercicios' => $totalExercicios,
            'chartLabels' => $months,
            'chartData' => $counts,
            'recentActivities' => $recentActivities,
        ]);
    }
}
