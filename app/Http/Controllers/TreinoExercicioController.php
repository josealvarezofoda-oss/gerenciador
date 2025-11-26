<?php

namespace App\Http\Controllers;

use App\Models\TreinoExercicio;
use App\Models\AlunoTreino;
use App\Models\Presenca;
use Illuminate\Http\Request;

class TreinoExercicioController extends Controller
{
    public function concluir($pivotId)
    {
        // Pegar o pivot pela tabela treino_exercicios (o pivot)
        $pivot = TreinoExercicio::where('id', $pivotId)->firstOrFail();

        // Marcar como concluído
        $pivot->concluido = 1;
        $pivot->save();

        // ID do treino
        $treinoId = $pivot->treino_id;

        // Contar os exercícios daquele treino (todos os pivots)
        $total = TreinoExercicio::where('treino_id', $treinoId)->count();
        $concluidos = TreinoExercicio::where('treino_id', $treinoId)
            ->where('concluido', 1)
            ->count();

        // Se concluiu todos, registrar presença
        if ($total == $concluidos) {

            $alunoTreino = AlunoTreino::where('treino_id', $treinoId)->first();

            if ($alunoTreino) {
                $jaTemPresenca = Presenca::where('aluno_id', $alunoTreino->aluno_id)
                    ->where('treino_id', $treinoId)
                    ->where('data', now()->toDateString())
                    ->exists();

                if (! $jaTemPresenca) {
                    Presenca::create([
                        'aluno_id' => $alunoTreino->aluno_id,
                        'treino_id' => $treinoId,
                        'status' => 'presente',
                        'data' => now()->toDateString()
                    ]);
                }
            }
        }

        return redirect()->route('aluno.treinos.index');
    }
}
