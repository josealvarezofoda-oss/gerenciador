@extends('layouts.admin')

@section('content')
<div class="fade">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold text-indigo-700">Gerenciar Treinos</h2>
        <a href="{{ route('admin.treinos.criar') }}" 
           class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition">
            Criar Treino
        </a>
    </div>

    @if($treinos->isEmpty())
        <div class="bg-yellow-50 border border-yellow-200 text-yellow-700 p-4 rounded-lg">
            Nenhum treino cadastrado ainda.
        </div>
    @else
        <div class="overflow-x-auto bg-white shadow-md rounded-2xl">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-indigo-100 text-left text-gray-700">
                        <th class="p-3">#</th>
                        <th class="p-3">Nome</th>
                        <th class="p-3">Descrição</th>
                        <th class="p-3">Alunos Associados</th>
                        <th class="p-3 text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($treinos as $treino)
                        <tr class="border-t hover:bg-gray-50">
                            <td class="p-3">{{ $treino->id }}</td>
                            <td class="p-3">{{ $treino->nome }}</td>
                            <td class="p-3">{{ $treino->descricao ?? '-' }}</td>
                            <td class="p-3">{{ $treino->alunos_count }}</td>
                            <td class="p-3 text-center space-x-2">
                                <a href="{{ route('admin.treinos.editar', $treino->id) }}" 
                                   class="text-blue-600 hover:text-blue-800 font-medium">
                                    Editar
                                </a>
                                <a href="{{ route('admin.treinos.editar', $treino->id) }}" 
                                   class="text-green-600 hover:text-green-800 font-medium">
                                    Associar Alunos
                                </a>
                                <form action="{{ route('admin.treinos.deletar', $treino->id) }}" 
                                      method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="text-red-600 hover:text-red-800 font-medium"
                                            onclick="return confirm('Tem certeza que deseja deletar este treino?')">
                                        Excluir
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
