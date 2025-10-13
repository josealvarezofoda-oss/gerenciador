<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Aluno;
use App\Models\Treino;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function indexAlunos()
    {
        $alunos = User::where('tipo_usuario', 'aluno')->get();
        return view('admin.alunos.index', compact('alunos'));
    }

    public function createAluno()
    {
        return view('admin.alunos.create');
    }

    public function storeAluno(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'idade' => 'nullable|integer',
            'sexo' => 'nullable|string',
            'altura' => 'nullable|numeric',
            'peso' => 'nullable|numeric',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make('12345678'),
            'tipo_usuario' => 'aluno',
        ]);

        $user->aluno()->create([
            'idade' => $validated['idade'] ?? null,
            'sexo' => $validated['sexo'] ?? null,
            'altura' => $validated['altura'] ?? null,
            'peso' => $validated['peso'] ?? null,
            'data_matricula' => now(),
        ]);

        return redirect()->route('admin.alunos.index')->with('success', 'Aluno cadastrado com sucesso!');
    }

    public function indexTreinos()
    {
        $treinos = Treino::with('alunos')->get();
        return view('admin.treinos.index', compact('treinos'));
    }

    public function criarTreinoForm()
    {
        $alunos = User::where('tipo_usuario', 'aluno')->get();
        return view('admin.treinos.criar', compact('alunos'));
    }

    public function salvarTreino(Request $request, $alunoId)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'alunos' => 'required|array',
            'alunos.*' => 'exists:users,id',
        ]);

        $treino = Treino::create([
            'user_id' => $alunoId,
            'nome' => $validated['nome'],
            'descricao' => $validated['descricao'] ?? null,
        ]);

        $treino->alunos()->sync($validated['alunos']);

        return redirect("/admin/treinos/{$alunoId}")
            ->with('success', 'Treino criado e associado aos alunos!');
    }


    public function editarTreinoForm(Treino $treino)
    {
        $alunos = User::where('tipo_usuario', 'aluno')->get();
        return view('admin.treinos.editar', compact('treino', 'alunos'));
    }

    public function atualizarTreino(Request $request, Treino $treino)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'alunos' => 'required|array',
            'alunos.*' => 'exists:users,id',
        ]);

        $treino->update([
            'nome' => $validated['nome'],
            'descricao' => $validated['descricao'] ?? null,
        ]);

    $treino->alunos()->sync($validated['alunos']);

    return redirect()->route('admin.treinos.index')->with('success', 'Treino atualizado!');
    }

    public function deletarTreino(Treino $treino)
    {
        $treino->delete();
        return back()->with('success', 'Treino deletado!');
    }
}
