<?php

namespace App\Http\Controllers;

use App\Models\Treino;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Lista todos os treinos de um aluno
    public function indexTreinos(User $aluno)
    {
        $treinos = $aluno->treinos; // precisa do relacionamento
        return view('admin.treinos.index', compact('treinos', 'aluno'));
    }

// Formulário de criação
    public function criarTreinoForm(User $aluno)
    {
        return view('admin.treinos.criar', compact('aluno'));
    }

// Salvar treino
    public function salvarTreino(Request $request, User $aluno)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
    ]);

    Treino::create([
        'aluno_id' => $aluno->id,
        'nome' => $request->nome,
        'descricao' => $request->descricao,
    ]);

    return redirect()->route('admin.treinos.index', $aluno->id)->with('success', 'Treino criado!');
}

// Formulário de edição
    public function editarTreinoForm(Treino $treino)
    {
        return view('admin.treinos.editar', compact('treino'));
    }

// Atualizar treino
    public function atualizarTreino(Request $request, Treino $treino)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
    ]);

        $treino->update($request->only('nome', 'descricao'));

    return redirect()->route('admin.treinos.index', $treino->aluno_id)->with('success', 'Treino atualizado!');
}

// Deletar treino
    public function deletarTreino(Treino $treino)
    {
        $treino->delete();
        return back()->with('success', 'Treino deletado!');
    }
}

