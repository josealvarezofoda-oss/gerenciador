@extends('layouts.admin')

@section('content')
<div class="fade">
    <h2 class="text-2xl font-semibold mb-6 text-indigo-700">Editar Treino</h2>

    <form action="{{ route('admin.treinos.atualizar', $treino->id) }}" method="POST" class="bg-white rounded-2xl shadow-md p-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-2 gap-4">
            <!-- Nome -->
            <div>
                <label class="block text-gray-700 mb-2">Nome do Treino</label>
                <input type="text" name="nome" value="{{ old('nome', $treino->nome) }}" class="w-full border rounded-lg p-2" required>
            </div>

            <!-- Categoria -->
            <div>
                <label class="block text-gray-700 mb-2">Categoria</label>
                <input type="text" name="categoria" value="{{ old('categoria', $treino->categoria ?? '') }}" class="w-full border rounded-lg p-2">
            </div>

            <!-- Dia da Semana -->
            <div>
                <label class="block text-gray-700 mb-2">Dia da Semana</label>
                <select name="dia_semana" class="w-full border rounded-lg p-2" required>
                    <option value="">Selecione...</option>
                    <option value="segunda" {{ old('dia_semana', $treino->dia_semana) === 'segunda' ? 'selected' : '' }}>Segunda-feira</option>
                    <option value="terca" {{ old('dia_semana', $treino->dia_semana) === 'terca' ? 'selected' : '' }}>Terça-feira</option>
                    <option value="quarta" {{ old('dia_semana', $treino->dia_semana) === 'quarta' ? 'selected' : '' }}>Quarta-feira</option>
                    <option value="quinta" {{ old('dia_semana', $treino->dia_semana) === 'quinta' ? 'selected' : '' }}>Quinta-feira</option>
                    <option value="sexta" {{ old('dia_semana', $treino->dia_semana) === 'sexta' ? 'selected' : '' }}>Sexta-feira</option>
                    <option value="sabado" {{ old('dia_semana', $treino->dia_semana) === 'sabado' ? 'selected' : '' }}>Sábado</option>
                    <option value="domingo" {{ old('dia_semana', $treino->dia_semana) === 'domingo' ? 'selected' : '' }}>Domingo</option>
                </select>
            </div>

            <!-- Descrição -->
            <div class="col-span-2">
                <label class="block text-gray-700 mb-2">Descrição</label>
                <textarea name="descricao" class="w-full border rounded-lg p-2" rows="3" placeholder="Descreva o treino...">{{ old('descricao', $treino->descricao) }}</textarea>
            </div>

            <!-- Selecionar alunos -->
            <div class="col-span-2">
                <label class="block text-gray-700 mb-2">Selecionar Alunos</label>
                <select name="alunos[]" multiple class="w-full border rounded-lg p-2 h-40">
                    @foreach($alunos as $aluno)
                        <option value="{{ $aluno->id }}" 
                            {{ in_array($aluno->id, $treino->alunos->pluck('id')->toArray()) ? 'selected' : '' }}>
                            {{ $aluno->name }}
                        </option>
                    @endforeach
                </select>
                <p class="text-sm text-gray-500 mt-1">
                    Segure <strong>Ctrl</strong> (ou <strong>Cmd</strong> no Mac) para selecionar vários alunos.
                </p>
            </div>
        </div>

        <div class="flex justify-between mt-6">
            <a href="{{ route('admin.treinos.index') }}" 
               class="bg-gray-300 text-gray-800 px-4 py-2 rounded-lg hover:bg-gray-400 transition">
                Voltar
            </a>
            <button class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition">
                Salvar Alterações
            </button>
        </div>
    </form>
</div>
@endsection
