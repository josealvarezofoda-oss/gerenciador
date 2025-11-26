@extends('layouts.admin')

@section('content')
<div class="fade">
    <h2 class="text-2xl font-semibold mb-6 text-indigo-700">Editar Exercício</h2>

    <form action="{{ route('admin.exercicios.update', $exercicio->id) }}"
          method="POST"
          enctype="multipart/form-data"
          class="bg-white rounded-2xl shadow-md p-6">

        @csrf
        @method('PUT')

        <div class="grid grid-cols-2 gap-4">

            <div>
                <label class="block text-gray-700 mb-2">Nome</label>
                <input type="text" name="nome" value="{{ $exercicio->nome }}" required
                       class="w-full border rounded-lg p-2">
            </div>

            <div>
                <label class="block text-gray-700 mb-2">Tipo</label>
                <input type="text" name="tipo" value="{{ $exercicio->tipo }}"
                       class="w-full border rounded-lg p-2">
            </div>

            <div>
                <label class="block text-gray-700 mb-2">Máquina</label>
                <input type="text" name="maquina" value="{{ $exercicio->maquina }}"
                       class="w-full border rounded-lg p-2">
            </div>

            <div>
                <label class="block text-gray-700 mb-2">Imagem</label>
                <input type="file" name="imagem" class="w-full border rounded-lg p-2">

                @if($exercicio->imagem)
                    <img src="{{ asset('storage/' . $exercicio->imagem) }}" 
                         class="w-32 h-32 object-cover mt-2 rounded-lg">
                @endif
            </div>

            <div class="col-span-2">
                <label class="block text-gray-700 mb-2">Descrição</label>
                <textarea name="descricao" rows="4"
                          class="w-full border rounded-lg p-2">{{ $exercicio->descricao }}</textarea>
            </div>

        </div>

        <div class="flex justify-between mt-6">
            <a href="{{ route('admin.exercicios.index') }}"
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
