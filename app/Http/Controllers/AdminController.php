<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Aluno;
use App\Models\Treino;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // controller do gerenciamento de alunos
    public function index()
    {
        $totalAlunos = Aluno::count();
        $totalTreinos = Treino::count();
        return view('admin.dashboard', compact('totalAlunos', 'totalTreinos'));
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
    
    public function editAluno($id)
    {
        $aluno = User::with('aluno')->findOrFail($id);
        return view('admin.alunos.editar', compact('aluno'));
    }

    public function updateAluno(Request $request, $id)
    {

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'idade' => 'nullable|integer',
            'sexo' => 'nullable|string',
            'altura' => 'nullable|numeric',
            'peso' => 'nullable|numeric',
        ]);

        $user = User::findOrFail($id);

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        if (!$user->aluno) {
            $user->aluno()->create([
                'data_matricula' => now(),
            ]);
        }

        $user->aluno->update([
            'idade' => $validated['idade'] ?? null,
            'sexo' => $validated['sexo'] ?? null,
            'altura' => $validated['altura'] ?? null,
            'peso' => $validated['peso'] ?? null,
        ]);

        return redirect()->route('admin.alunos.index')->with('success', 'Aluno atualizado com sucesso!');
    }

    // controller do gerenciamento de treinos
    public function indexTreinos()
    {
        $treinos = Treino::with('alunos')->get();
        $treinos = Treino::withCount('alunos')->get();
        return view('admin.treinos.index', compact('treinos'));
    }

    public function criarTreinoForm()
    {
        $alunos = User::where('tipo_usuario', 'aluno')->get();
        return view('admin.treinos.criar', compact('alunos'));
    }

    public function salvarTreino(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'dia_semana' => 'required|string|in:segunda,terca,quarta,quinta,sexta,sabado,domingo',
            'alunos' => 'required|array|min:1',
            'alunos.*' => 'exists:users,id',
        ]);

        $treino = Treino::create([
            'nome' => $validated['nome'],
            'descricao' => $validated['descricao'] ?? null,
            'dia_semana' => $validated['dia_semana'],
        ]);

        // Associa todos os alunos selecionados via tabela pivot
        $treino->alunos()->sync($validated['alunos']);

        return redirect()
            ->route('admin.treinos.index')
            ->with('success', 'Treino criado e associado aos alunos com sucesso!');
    }



    public function editarTreinoForm($id)
    {
        $treino = Treino::with('alunos')->findOrFail($id);
        $alunos = User::where('tipo_usuario', 'aluno')->get();

        return view('admin.treinos.editar', compact('treino', 'alunos'));
    }

    public function atualizarTreino(Request $request, $id)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'dia_semana' => 'required|string|in:segunda,terca,quarta,quinta,sexta,sabado,domingo',
            'alunos' => 'required|array|min:1',
            'alunos.*' => 'exists:users,id',
        ]);

        $treino = Treino::findOrFail($id);

        $treino->update([
            'nome' => $validated['nome'],
            'descricao' => $validated['descricao'] ?? null,
            'dia_semana' => $validated['dia_semana'],
        ]);

        $treino->alunos()->sync($validated['alunos']);

        return redirect()->route('admin.treinos.index')->with('success', 'Treino atualizado com sucesso!');
    }


    public function deletarTreino($id)
    {
        $treino = Treino::findOrFail($id);

        // remover associação
        $treino->alunos()->detach();

        $treino->delete();

        return back()->with('success', 'Treino deletado com sucesso!');
    }

}
