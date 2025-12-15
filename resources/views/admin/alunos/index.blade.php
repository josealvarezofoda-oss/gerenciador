@extends('layouts.admin')

@section('content')
<div class="fade">
    <h2 class="text-2xl font-semibold mb-6 text-indigo-700">Gerenciar Alunos</h2>

    <a href="{{ route('admin.alunos.create') }}"
       class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">
        Novo Aluno
    </a>

    <div class="mt-6 bg-white rounded-2xl shadow-md p-6 overflow-x-auto">

        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left">Nome</th>
                    <th class="px-6 py-3 text-left">Plano</th>
                    <th class="px-6 py-3 text-left">Data de Matrícula</th>
                    <th class="px-6 py-3 text-left">Status Financeiro</th>
                    <th class="px-6 py-3 text-left">Ações</th>
                </tr>
            </thead>

            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($alunos as $aluno)

                    @php
                        // mensalidade do mês atual (forma correta)
                        $mensalidade = $aluno->mensalidades
                            ->where('mes_referencia', '>=', now()->startOfMonth())
                            ->where('mes_referencia', '<=', now()->endOfMonth())
                            ->first();
                    @endphp

                    <tr>
                        {{-- Nome --}}
                        <td class="px-6 py-4 text-gray-800">
                            {{ $aluno->user->name }}
                        </td>

                        {{-- Plano --}}
                        <td class="px-6 py-4 text-gray-800">
                            @if ($aluno->plano)
                                {{ $aluno->plano->dias_semana }} dias —
                                R$ {{ number_format($aluno->plano->valor, 2, ',', '.') }}
                            @else
                                —
                            @endif
                        </td>

                        {{-- Data de Matrícula --}}
                        <td class="px-6 py-4 text-gray-800">
                            {{ $aluno->data_matricula
                                ? $aluno->data_matricula->format('d/m/Y')
                                : '—' }}
                        </td>

                        {{-- Status Financeiro --}}
                        <td class="px-6 py-4">
                            @if($mensalidade)
                                @if($mensalidade->status === 'pago')
                                    <span class="px-3 py-1 rounded-lg bg-green-100 text-green-700 font-semibold">
                                        Pago
                                    </span>
                                @elseif($mensalidade->status === 'pendente')
                                    <span class="px-3 py-1 rounded-lg bg-yellow-100 text-yellow-700 font-semibold">
                                        Pendente
                                    </span>
                                @else
                                    <span class="px-3 py-1 rounded-lg bg-red-100 text-red-700 font-semibold">
                                        Atrasado
                                    </span>
                                @endif
                            @else
                                <span class="text-gray-500">
                                    Sem mensalidade
                                </span>
                            @endif
                        </td>

                        {{-- Ações --}}
                        <td class="px-6 py-4 flex flex-wrap gap-2">

                            <a href="{{ route('admin.alunos.editar', $aluno->id) }}"
                               class="bg-yellow-500 text-white px-3 py-1 rounded-lg hover:bg-yellow-600">
                                Editar
                            </a>

                            <a href="{{ route('admin.alunos.mensalidades', $aluno->id) }}"
                               class="bg-green-600 text-white px-3 py-1 rounded-lg hover:bg-green-700">
                                Mensalidades
                            </a>

                            {{-- Botão pagar direto --}}
                            @if($mensalidade && $mensalidade->status === 'pendente')
                                <form action="{{ route('admin.mensalidades.pagar', $mensalidade->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Confirmar pagamento desta mensalidade?')">
                                    @csrf
                                    @method('PUT')

                                    <button type="submit"
                                        class="bg-blue-600 text-white px-3 py-1 rounded-lg hover:bg-blue-700">
                                        Pagar
                                    </button>
                                </form>
                            @endif


                            <a href="{{ route('admin.treinos.index') }}?aluno={{ $aluno->id }}"
                               class="bg-indigo-600 text-white px-3 py-1 rounded-lg hover:bg-indigo-700">
                                Treinos
                            </a>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>
@endsection
