<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Treino;
use App\Models\Aluno;
use App\Models\Exercicio;
use Illuminate\Http\Request;

class TreinoController extends Controller
{
    public function index()
    {
        $treinos = Treino::with([
                'alunos' => function ($q) {
                    $q->withPivot('dia_semana');
            }
        ])->withCount('alunos')->get();

        $treinos = Treino::withCount('alunos')->get();
        return view('admin.treinos.index', compact('treinos'));
    }

    public function create()
    {
        $alunos = Aluno::with('user')->get();
        $exercicios = Exercicio::orderBy('nome')->get();

        return view('admin.treinos.criar', compact('alunos', 'exercicios'));
    }

    public function store(Request $request)
    {
        // validação única
        $validated = $request->validate([
            'nome' => 'required|string',
            'descricao' => 'nullable|string',
            'categoria' => 'nullable|string',

            // alunos
            'alunos' => 'required|array',
            'alunos.*' => 'required|exists:alunos,id',
            'alunos.*.dia_semana' => 'nullable|string',

            // exercícios
            'exercicios' => 'nullable|array',
            'exercicios.*.exercicio_id' => 'required|exists:exercicios,id',
            'exercicios.*.series' => 'nullable|integer|min:1',
            'exercicios.*.repeticoes' => 'nullable|integer|min:1',
            'exercicios.*.descanso' => 'nullable|integer|min:0',
            'exercicios.*.ordem' => 'nullable|integer|min:1',
        ]);

        // cria o treino
        $treino = Treino::create([
            'nome' => $validated['nome'],
            'descricao' => $validated['descricao'] ?? null,
            'categoria' => $validated['categoria'] ?? null,
        ]);

        $pivotAlunos = [];
        foreach ($validated['alunos'] as $alunoId) {
            $pivotAlunos[$alunoId] = [
                'dia_semana' => $request->dia_semana,
            ];
        }


        $treino->alunos()->sync($pivotAlunos);

        if (isset($validated['exercicios'])) {
            $pivotEx = [];
            foreach ($validated['exercicios'] as $ex) {
                $pivotEx[$ex['exercicio_id']] = [
                    'series' => $ex['series'] ?? null,
                    'repeticoes' => $ex['repeticoes'] ?? null,
                    'descanso' => $ex['descanso'] ?? null,
                    'ordem' => $ex['ordem'] ?? null,
                ];
            }

            $treino->exercicios()->sync($pivotEx);
        }

        return redirect()->route('admin.treinos.index')
                         ->with('success', 'Treino criado com sucesso!');
    }

    public function edit($id)
    {
        $treino = Treino::with('alunos', 'exercicios')->findOrFail($id);
        $alunos = Aluno::with('user')->get();
        $exercicios = Exercicio::orderBy('nome')->get();

        return view('admin.treinos.editar', compact('treino', 'alunos', 'exercicios'));
    }

    public function update(Request $request, $id)
    {
        $treino = Treino::findOrFail($id);

        $validated = $request->validate([
            'nome' => 'required|string',
            'descricao' => 'nullable|string',
            'categoria' => 'nullable|string',

            // alunos
            'alunos' => 'required|array',
            'alunos.*.id' => 'required|exists:alunos,id',
            'alunos.*.dia_semana' => 'nullable|string',

            // exercicios
            'exercicios' => 'nullable|array',
            'exercicios.*.exercicio_id' => 'required|exists:exercicios,id',
            'exercicios.*.series' => 'nullable|integer|min:1',
            'exercicios.*.repeticoes' => 'nullable|integer|min:1',
            'exercicios.*.descanso' => 'nullable|integer|min:0',
            'exercicios.*.ordem' => 'nullable|integer|min:1',
        ]);

        $treino->update([
            'nome' => $validated['nome'],
            'descricao' => $validated['descricao'] ?? null,
            'categoria' => $validated['categoria'] ?? null,
        ]);

        // atualizar alunos
        $pivotAlunos = [];
        foreach ($validated['alunos'] as $a) {
            $pivotAlunos[$a['id']] = [
                'dia_semana' => $a['dia_semana'] ?? null,
            ];
        }

        $treino->alunos()->sync($pivotAlunos);

        // atualizar exercicios
        if (isset($validated['exercicios'])) {
            $pivotEx = [];

            foreach ($validated['exercicios'] as $ex) {
                $pivotEx[$ex['exercicio_id']] = [
                    'series' => $ex['series'] ?? null,
                    'repeticoes' => $ex['repeticoes'] ?? null,
                    'descanso' => $ex['descanso'] ?? null,
                    'ordem' => $ex['ordem'] ?? null,
                ];
            }

            $treino->exercicios()->sync($pivotEx);
        } else {
            $treino->exercicios()->detach();
        }

        return redirect()->route('admin.treinos.index')
                         ->with('success', 'Treino atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $treino = Treino::findOrFail($id);
        $treino->alunos()->detach();
        $treino->exercicios()->detach();
        $treino->delete();

        return back()->with('success', 'Treino deletado com sucesso!');
    }
}
