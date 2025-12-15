<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Exercicio;
use Illuminate\Http\Request;

class ExercicioController extends Controller
{
    public function index()
    {
        $exercicios = Exercicio::orderBy('id', 'desc')->get();

        return view('admin.exercicios.index', compact('exercicios'));
    }

    public function create()
    {
        return view('admin.exercicios.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'tipo' => 'nullable|string|max:255',
            'maquina' => 'nullable|string|max:255',
            'descricao' => 'nullable|string',
            'imagem' => 'nullable|image|max:4096',
        ]);

        if ($request->hasFile('imagem')) {
            $validated['imagem'] = $request->file('imagem')->store('exercicios', 'public');
        }

        Exercicio::create($validated);

        activity_log('Exercício criado', [
            'exercicio' => $validated['nome']
        ]);


        return redirect()
            ->route('admin.exercicios.index')
            ->with('success', 'Exercício criado com sucesso!');
    }

    public function edit($id)
    {
        $exercicio = Exercicio::findOrFail($id);

        return view('admin.exercicios.editar', compact('exercicio'));
    }

    public function update(Request $request, $id)
    {
        $exercicio = Exercicio::findOrFail($id);

        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'tipo' => 'nullable|string|max:255',
            'maquina' => 'nullable|string|max:255',
            'descricao' => 'nullable|string',
            'imagem' => 'nullable|image|max:4096',
        ]);

        if ($request->hasFile('imagem')) {
            $validated['imagem'] = $request->file('imagem')->store('exercicios', 'public');
        }

        $exercicio->update($validated);

        activity_log('Exercício atualizado', [
            'exercicio_id' => $exercicio->id,
            'nome' => $validated['nome']
        ]);


        return redirect()
            ->route('admin.exercicios.index')
            ->with('success', 'Exercício atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $exercicio = Exercicio::findOrFail($id);
        $exercicio->delete();

        activity_log('Exercício deletado', [
            'exercicio_id' => $exercicio->id,
            'nome' => $exercicio->nome
        ]);

        return redirect()
            ->route('admin.exercicios.index')
            ->with('success', 'Exercício excluído com sucesso!');
    }

    public function concluirExercicio($id)
{
    $ex = TreinoExercicio::findOrFail($id);
    $ex->concluido = 1;
    $ex->save();

    $treinoId = $ex->treino_id;

    $total = TreinoExercicio::where('treino_id', $treinoId)->count();
    $concluidos = TreinoExercicio::where('treino_id', $treinoId)->where('concluido', 1)->count();

    if ($total == $concluidos) {
        $alunoTreino = AlunoTreino::where('treino_id', $treinoId)->first();

        if ($alunoTreino) {
            Presenca::create([
                'aluno_id' => $alunoTreino->aluno_id,
                'treino_id' => $treinoId,
                'status' => 'presente',
                'data' => now()->toDateString()
            ]);
        }
    }

    return back()->with('success', 'Exercício concluído!');
}

}
