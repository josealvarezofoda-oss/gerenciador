<?php

namespace App\Http\Controllers;

use App\Models\Treino;
use App\Models\Aluno;
use Illuminate\Http\Request;

class AlunoController extends Controller
{
    /**
     * Exibe a lista de alunos.
     */
    public function index()
    {
        $alunos = Aluno::all();
        return view('alunos.index', compact('alunos'));
    }

    /**
     * Mostra o formulário de criação de aluno.
     */
    public function create()
    {
        return view('alunos.create');
    }

    /**
     * Armazena um novo aluno no banco.
     */
    public function store(Request $request)
    {
        Aluno::create($request->all());
        return redirect()->route('alunos.index');
    }

    /**
     * Mostra o formulário de edição de um aluno.
     */
    public function edit(Aluno $aluno)
    {
        return view('alunos.edit', compact('aluno'));
    }

    /**
     * Atualiza os dados de um aluno.
     */
    public function update(Request $request, Aluno $aluno)
    {
        $aluno->update($request->all());
        return redirect()->route('alunos.index');
    }

    /**
     * Remove um aluno do banco.
     */
    public function destroy(Aluno $aluno)
    {
        $aluno->delete();
        return redirect()->route('alunos.index');
    }
    public function meusTreinos()
    {
        $treinos = auth()->user()->treinos;
        return view('aluno.treinos.index', compact('treinos'));
    }
}
