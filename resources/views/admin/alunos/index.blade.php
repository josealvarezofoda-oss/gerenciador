@extends('layouts.admin')

@section('content')
<div class="fade">
    <h2 class="text-2xl font-semibold mb-6 text-indigo-700">Gerenciar Alunos</h2>

    <a href="{{ route('admin.alunos.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">
        Novo Aluno
    </a>

    <div class="mt-6 bg-white rounded-2xl shadow-md p-6 overflow-x-auto">

        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3">Nome</th>
                    <th class="px-6 py-3">Plano</th>
                    <th class="px-6 py-3">Data de Matrícula</th>
                    <th class="px-6 py-3">Status</th>
                    <th class="px-6 py-3">Ações</th>
                </tr>
            </thead>

            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($alunos as $aluno)
                <tr>
                    {{-- Nome --}}
                    <td class="px-6 py-4 text-gray-800">
                        {{ $aluno->user->name }}
                    </td>

                    {{-- Plano --}}
                    <td class="px-6 py-4 text-gray-800">
                        @if ($aluno->plano)
                            {{ $aluno->plano->dias_semana }} dias — R$
                            {{ number_format($aluno->plano->valor, 2, ',', '.') }}
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

                    {{-- Status --}}
                    <td class="px-6 py-4">
                        <form action="{{ route('admin.alunos.status', $aluno->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <button type="submit"
                                class="px-3 py-1 rounded-lg text-white font-semibold
                                    {{ $aluno->status === 'ativo'
                                        ? 'bg-green-600 hover:bg-green-700'
                                        : 'bg-red-600 hover:bg-red-700' }}">
                                {{ $aluno->status === 'ativo' ? 'Ativo' : 'Pendente' }}
                            </button>
                        </form>
                    </td>

                    {{-- Ações --}}
                    <td class="px-6 py-4 flex space-x-2">

                        <a href="{{ route('admin.alunos.editar', $aluno->id) }}" 
                           class="bg-yellow-500 text-white px-3 py-1 rounded-lg hover:bg-yellow-600">
                           Editar
                        </a>

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
