<?php

namespace App\Http\Controllers;

use App\Models\Treino;
use App\Models\Aluno;
use Illuminate\Http\Request;

class AlunoController extends Controller
{
    public function create()
    {
        return view('alunos.create');
    }

    public function store(Request $request)
    {
        Aluno::create($request->all());
        return redirect()->route('alunos.index');
    }

    public function edit(Aluno $aluno)
    {
        return view('alunos.edit', compact('aluno'));
    }

    public function update(Request $request, Aluno $aluno)
    {
        $aluno->update($request->all());
        return redirect()->route('alunos.index');
    }

    public function destroy(Aluno $aluno)
    {
        $aluno->delete();
        return redirect()->route('alunos.index');
    }

    public function dashboard()
    {
        $aluno = auth()->user();

        $treinoAtual = $aluno->treinos()->latest()->first();

        $historico = $aluno->treinos()->orderBy('created_at', 'desc')->get();

        return view('aluno.dashboard', compact('aluno', 'treinoAtual', 'historico'));
    }

    public function meusTreinos()
    {
        $aluno = auth()->user();
        $treinos = $aluno->treinos()->orderBy('created_at', 'desc')->get();

        return view('aluno.treinos.index', compact('treinos'));
    }
}
