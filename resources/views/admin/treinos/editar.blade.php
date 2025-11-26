@extends('layouts.admin')

@section('content')
<div class="fade">

    <h2 class="text-3xl font-semibold mb-6 text-indigo-700">Editar Treino</h2>

    <form action="{{ route('admin.treinos.atualizar', $treino->id) }}" method="POST"
          class="bg-white rounded-2xl shadow-md p-8">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-2 gap-6">
            
            <div>
                <label class="text-gray-700 font-medium">Nome do Treino</label>
                <input type="text" name="nome" class="w-full border rounded-lg p-3 mt-1"
                       value="{{ old('nome', $treino->nome) }}" required>
            </div>

            <div>
                <label class="text-gray-700 font-medium">Categoria</label>
                <input type="text" name="categoria" class="w-full border rounded-lg p-3 mt-1"
                       value="{{ old('categoria', $treino->categoria) }}">
            </div>

            <div>
                <label class="text-gray-700 font-medium">Dia da Semana</label>
                <select name="dia_semana" class="w-full border rounded-lg p-3 mt-1" required>
                    <option value="segunda" {{ $treino->dia_semana=='segunda' ? 'selected' : '' }}>Segunda-feira</option>
                    <option value="terca" {{ $treino->dia_semana=='terca' ? 'selected' : '' }}>Terça-feira</option>
                    <option value="quarta" {{ $treino->dia_semana=='quarta' ? 'selected' : '' }}>Quarta-feira</option>
                    <option value="quinta" {{ $treino->dia_semana=='quinta' ? 'selected' : '' }}>Quinta-feira</option>
                    <option value="sexta" {{ $treino->dia_semana=='sexta' ? 'selected' : '' }}>Sexta-feira</option>
                </select>
            </div>

            <div class="col-span-2">
                <label class="text-gray-700 font-medium">Descrição</label>
                <textarea name="descricao" rows="3"
                          class="w-full border rounded-lg p-3 mt-1">{{ $treino->descricao }}</textarea>
            </div>

            <div class="col-span-2">
                <label class="text-gray-700 font-medium">Selecionar Alunos</label>
                <select name="alunos[]" multiple class="w-full border rounded-lg p-3 h-44 mt-1">
                    @foreach($alunos as $aluno)
                        <option value="{{ $aluno->id }}"
                            {{ in_array($aluno->id, $treino->alunos->pluck('id')->toArray()) ? 'selected' : '' }}>
                            {{ $aluno->name }}
                        </option>
                    @endforeach
                </select>
            </div>

        </div>

        <div class="flex justify-between mt-8">
            <a href="{{ route('admin.treinos.index') }}"
               class="bg-gray-300 text-gray-900 px-6 py-3 rounded-xl hover:bg-gray-400 transition">
                Voltar
            </a>

            <button class="bg-indigo-600 text-white px-6 py-3 rounded-xl hover:bg-indigo-700 transition">
                Salvar Alterações
            </button>
        </div>

    </form>

</div>
@endsection
