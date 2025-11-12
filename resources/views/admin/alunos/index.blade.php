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
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase">Nome</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase">Data de Matrícula</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase">Ações</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($alunos as $aluno)
                <tr>
                    <td class="px-6 py-4 text-gray-800">{{ $aluno->name }}</td>
                    <td class="px-6 py-4 text-gray-800">
                        {{ $aluno->aluno && $aluno->aluno->data_matricula ? \Carbon\Carbon::parse($aluno->aluno->data_matricula)->format('d/m/Y') : '-' }}
                    </td>
                    <td class="px-6 py-4 space-x-2">
                        <a href="{{ route('admin.alunos.editar', $aluno->id) }}" 
                           class="bg-yellow-500 text-white px-3 py-1 rounded-lg hover:bg-yellow-600">
                           Editar
                        </a>
                        <a href="{{ route('admin.treinos.index', $aluno->id) }}" 
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
