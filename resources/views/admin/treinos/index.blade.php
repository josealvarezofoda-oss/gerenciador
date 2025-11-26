@extends('layouts.admin')

@section('content')
<div class="fade">

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-3xl font-semibold text-indigo-700">Gerenciar Treinos</h2>

        <a href="{{ route('admin.treinos.criar') }}"
           class="bg-indigo-600 text-white px-4 py-2 rounded-xl hover:bg-indigo-700 transition shadow">
            + Novo Treino
        </a>
    </div>

    <!-- Tabela -->
    <div class="bg-white p-6 rounded-2xl shadow-md">
        <table class="w-full text-left">
            <thead>
                <tr class="border-b">
                    <th class="py-3">Nome</th>
                    <th class="py-3">Categoria</th>
                    <th class="py-3">Dia</th>
                    <th class="py-3">Alunos</th>
                    <th class="py-3 text-center">Ações</th>
                </tr>
            </thead>

            <tbody>
                @forelse($treinos as $treino)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-3">{{ $treino->nome }}</td>
                        <td>{{ $treino->categoria }}</td>
                        <td>{{ ucfirst($treino->alunos->first()->pivot->dia_semana ?? '—') }}</td>
                        <td>{{ $treino->alunos->count() }}</td>

                        <td class="py-3 text-center flex justify-center gap-2">
                            <a href="{{ route('admin.treinos.editar', $treino->id) }}"
                               class="bg-blue-500 text-white px-3 py-1 rounded-lg hover:bg-blue-600 transition">
                                Editar
                            </a>

                            <form action="{{ route('admin.treinos.delete', $treino->id) }}" method="POST"
                                  onsubmit="return confirm('Tem certeza que deseja excluir este treino?')">
                                @csrf
                                @method('DELETE')

                                <button class="bg-red-500 text-white px-3 py-1 rounded-lg hover:bg-red-600 transition">
                                    Excluir
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-4 text-center text-gray-500">Nenhum treino cadastrado.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
