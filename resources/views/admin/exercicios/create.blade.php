@extends('layouts.admin')

@section('content')
<div class="fade">
    <h2 class="text-2xl font-semibold mb-6 text-indigo-700">Cadastrar Exercício</h2>

    <form action="{{ route('admin.exercicios.store') }}" 
          method="POST" 
          enctype="multipart/form-data"
          class="bg-white rounded-2xl shadow-md p-6">
          
        @csrf

        <div class="grid grid-cols-2 gap-4">

            <div>
                <label class="block text-gray-700 mb-2">Nome</label>
                <input type="text" name="nome" required
                       class="w-full border rounded-lg p-2">
            </div>

            <div>
                <label class="block text-gray-700 mb-2">Tipo</label>
                <input type="text" name="tipo"
                       class="w-full border rounded-lg p-2">
            </div>

            <div>
                <label class="block text-gray-700 mb-2">Máquina</label>
                <input type="text" name="maquina"
                       class="w-full border rounded-lg p-2">
            </div>

            <div>
                <label class="block text-gray-700 mb-2">Imagem</label>
                <input type="file" name="imagem" 
                       class="w-full border rounded-lg p-2">
            </div>

            <div class="col-span-2">
                <label class="block text-gray-700 mb-2">Descrição</label>
                <textarea name="descricao" rows="4"
                          class="w-full border rounded-lg p-2"></textarea>
            </div>

        </div>

        <button class="mt-6 bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition">
            Salvar Exercício
        </button>
    </form>
</div>
@endsection
