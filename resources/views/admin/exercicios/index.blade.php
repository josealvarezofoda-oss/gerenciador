@extends('layouts.admin')

@section('content')
<div class="fade">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold text-indigo-700">Exercícios</h2>

        <a href="{{ route('admin.exercicios.create') }}"
           class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition">
            + Novo Exercício
        </a>
    </div>

    @if($exercicios->count() == 0)
        <p class="text-gray-500">Nenhum exercício cadastrado ainda.</p>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($exercicios as $ex)
                <div class="bg-white shadow-lg rounded-xl p-4">
                    @if($ex->imagem)
                        <img src="{{ asset('storage/' . $ex->imagem) }}" 
                             class="w-full h-40 object-cover rounded-lg mb-3">
                    @else
                        <div class="w-full h-40 bg-gray-200 rounded-lg mb-3 flex items-center justify-center text-gray-500">
                            Sem imagem
                        </div>
                    @endif

                    <h3 class="font-semibold text-lg">{{ $ex->nome }}</h3>
                    <p class="text-sm text-gray-600">{{ $ex->tipo ?? 'Sem tipo' }}</p>

                    <div class="mt-4 flex justify-between">
                        <a href="{{ route('admin.exercicios.editar', $ex->id) }}"
                           class="text-indigo-600 font-medium hover:underline">Editar</a>

                        <form action="{{ route('admin.exercicios.deletar', $ex->id) }}" 
                              method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-600 hover:underline" 
                                    onclick="return confirm('Tem certeza que deseja excluir este exercício?')">
                                Excluir
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
