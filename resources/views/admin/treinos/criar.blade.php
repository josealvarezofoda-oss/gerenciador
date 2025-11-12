@extends('layouts.admin')

@section('content')
<div class="fade">
    <h2 class="text-2xl font-semibold mb-6 text-indigo-700">Cadastrar Novo Treino</h2>

    <form action="{{ route('admin.treinos.salvar') }}" method="POST" class="bg-white rounded-2xl shadow-md p-6">
        @csrf

        <div class="grid grid-cols-2 gap-4">
            <!-- Nome -->
            <div>
                <label class="block text-gray-700 mb-2">Nome do Treino</label>
                <input type="text" name="nome" class="w-full border rounded-lg p-2" required>
            </div>

            <!-- Categoria -->
            <div>
                <label class="block text-gray-700 mb-2">Categoria</label>
                <input type="text" name="categoria" class="w-full border rounded-lg p-2">
            </div>

            <!-- Dia da Semana -->
            <div>
                <label class="block text-gray-700 mb-2">Dia da Semana</label>
                <select name="dia_semana" class="w-full border rounded-lg p-2" required>
                    <option value="">Selecione...</option>
                    <option value="segunda">Segunda-feira</option>
                    <option value="terca">Terça-feira</option>
                    <option value="quarta">Quarta-feira</option>
                    <option value="quinta">Quinta-feira</option>
                    <option value="sexta">Sexta-feira</option>
                    <option value="sabado">Sábado</option>
                    <option value="domingo">Domingo</option>
                </select>
            </div>

            <!-- Descrição -->
            <div class="col-span-2">
                <label class="block text-gray-700 mb-2">Descrição</label>
                <textarea name="descricao" class="w-full border rounded-lg p-2" rows="3" placeholder="Descreva o treino..."></textarea>
            </div>

            <!-- Selecionar alunos -->
            <div class="col-span-2">
                <label class="block text-gray-700 mb-2">Selecionar Alunos</label>
                <select name="alunos[]" multiple class="w-full border rounded-lg p-2 h-40">
                    @foreach($alunos as $aluno)
                        <option value="{{ $aluno->id }}">{{ $aluno->name }}</option>
                    @endforeach
                </select>
                <p class="text-sm text-gray-500 mt-1">
                    Segure <strong>Ctrl</strong> (ou <strong>Cmd</strong> no Mac) para selecionar vários alunos.
                </p>
            </div>
        </div>

        <button class="mt-6 bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition">
            Criar Treino
        </button>
    </form>
</div>
@endsection
