<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aluno;
use App\Models\Plano;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AlunoAdminController extends Controller
{
    public function indexAlunos()
    {
        $alunos = Aluno::with('user', 'plano')->get();
        return view('admin.alunos.index', compact('alunos'));
    }

    public function createAluno()
    {
        $planos = Plano::all();
        return view('admin.alunos.create', compact('planos'));
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
            'plano_id' => 'required|exists:planos,id',
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
            'plano_id' => $request->plano_id,
            'data_matricula' => now(),
        ]);

        return redirect()->route('admin.alunos.index')->with('success', 'Aluno cadastrado com sucesso!');
    }

    public function editAluno($id)
    {
        $aluno = Aluno::with('user')->findOrFail($id);
        $planos = Plano::all();

        return view('admin.alunos.editar', compact('aluno', 'planos'));
    }

    public function updateAluno(Request $request, $id)
    {
        $aluno = Aluno::with('user')->findOrFail($id);
        $user = $aluno->user;

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'idade' => 'nullable|integer',
            'sexo' => 'nullable|string',
            'altura' => 'nullable|numeric',
            'peso' => 'nullable|numeric',
            'plano_id' => 'required|exists:planos,id',
        ]);

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        $aluno->update([
            'idade' => $validated['idade'] ?? null,
            'sexo' => $validated['sexo'] ?? null,
            'altura' => $validated['altura'] ?? null,
            'peso' => $validated['peso'] ?? null,
            'plano_id' => $validated['plano_id'],
        ]);

        return redirect()->route('admin.alunos.index')->with('success', 'Aluno atualizado com sucesso!');
    }

    public function toggleAlunoStatus($id)
    {
        $aluno = Aluno::findOrFail($id);

        $aluno->status = $aluno->status === 'ativo' ? 'pendente' : 'ativo';
        $aluno->save();

        return back()->with('success', 'Status atualizado com sucesso!');
    }
}
