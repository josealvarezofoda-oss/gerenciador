<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Treino;

class AlunoController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();
        $aluno = $user->aluno;

        if (!$aluno) {
            return redirect()->route('home')->with('error', 'Aluno não encontrado.');
        }

        $imc = null;
        if ($aluno->peso && $aluno->altura && $aluno->altura > 0) {
            $imc = round($aluno->peso / (($aluno->altura / 100) ** 2), 1);
        }

        return view('aluno.dashboard', compact('user', 'aluno', 'imc'));
    }

    public function meusTreinos()
    {
        $user = auth()->user();

        $treinos = $user->treinos()
            ->orderByRaw("
                CASE 
                    WHEN dia_semana = 'segunda' THEN 1
                    WHEN dia_semana = 'terca' THEN 2
                    WHEN dia_semana = 'quarta' THEN 3
                    WHEN dia_semana = 'quinta' THEN 4
                    WHEN dia_semana = 'sexta' THEN 5
                    WHEN dia_semana = 'sabado' THEN 6
                    WHEN dia_semana = 'domingo' THEN 7
                    ELSE 8
                END
            ")
            ->get();

        return view('aluno.treinos.index', compact('treinos'));
    }
}
