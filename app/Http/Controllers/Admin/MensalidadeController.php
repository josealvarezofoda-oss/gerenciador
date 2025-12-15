<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mensalidade;
use App\Models\Aluno;
use Illuminate\Http\Request;

class MensalidadeController extends Controller
{
    // Lista todas as mensalidades (admin)
    public function index()
    {
        $mensalidades = Mensalidade::with(['aluno.user', 'plano'])
            ->orderBy('mes_referencia', 'desc')
            ->paginate(20);

        return view('admin.mensalidades.index', compact('mensalidades'));
    }

    // Lista mensalidades de um aluno específico
    public function alunoMensalidades($alunoId)
    {
        $aluno = Aluno::with(['user', 'mensalidades.plano'])
            ->findOrFail($alunoId);

        return view('admin.mensalidades.aluno', compact('aluno'));
    }

    public function pagar($id)
    {
        $mensalidade = Mensalidade::findOrFail($id);

        // proteção contra pagamento duplicado
        if ($mensalidade->status === 'pago') {
            return back()->with('error', 'Esta mensalidade já está paga.');
        }

        $mensalidade->update([
            'status' => 'pago',
            'pago_em' => now(),
        ]);

        activity_log('Mensalidade paga', [
            'mensalidade_id' => $mensalidade->id,
            'aluno_id' => $mensalidade->aluno_id,
            'mes_referencia' => $mensalidade->mes_referencia->format('Y-m'),
        ]);

        return back()->with('success', 'Mensalidade marcada como paga!');
    }

    // Criar mensalidade manualmente
    public function store(Request $request)
    {
        $validated = $request->validate([
            'aluno_id' => 'required|exists:alunos,id',
            'plano_id' => 'required|exists:planos,id',
            'valor' => 'required|numeric|min:0',
            'mes_referencia' => 'required|date',
        ]);

        Mensalidade::create([
            'aluno_id' => $validated['aluno_id'],
            'plano_id' => $validated['plano_id'],
            'valor' => $validated['valor'],
            'status' => 'pendente',
            'mes_referencia' => $validated['mes_referencia'],
        ]);

        activity_log('Mensalidade criada manualmente', [
            'aluno_id' => $validated['aluno_id'],
            'mes_referencia' => $validated['mes_referencia'],
        ]);

        return back()->with('success', 'Mensalidade criada com sucesso!');
    }

    // Detalhes da mensalidade
    public function show($id)
    {
        $mensalidade = Mensalidade::with(['aluno.user', 'plano'])
            ->findOrFail($id);

        return view('admin.mensalidades.show', compact('mensalidade'));
    }
}
