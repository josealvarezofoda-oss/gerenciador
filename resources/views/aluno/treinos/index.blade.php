@extends('layouts.aluno')

@section('content')
<div class="fade">
    <h2 class="text-2xl font-semibold mb-6 text-indigo-700">Meus Treinos</h2>

    @if($treinos->isEmpty())
        <div class="bg-white rounded-2xl shadow-sm p-6 text-center text-gray-600">
            Nenhum treino disponível no momento.
        </div>
    @else
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($treinos as $treino)
                <div class="bg-white rounded-2xl shadow-md hover:shadow-lg transition p-5 flex flex-col justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-indigo-700 mb-2">
                            {{ $treino->nome }}
                        </h3>

                        <p class="text-sm text-gray-600 mb-1">
                            <span class="font-medium">Dia:</span> 
                            {{ ucfirst($treino->dia_semana ?? '—') }}
                        </p>

                        @if($treino->categoria)
                            <p class="text-sm text-gray-600 mb-1">
                                <span class="font-medium">Categoria:</span> {{ $treino->categoria }}
                            </p>
                        @endif

                        @if($treino->descricao)
                            <p class="text-sm text-gray-700 mt-2 leading-relaxed">
                                {{ $treino->descricao }}
                            </p>
                        @endif
                    </div>

                    <div class="mt-4 text-right">
                        <span class="inline-block text-xs bg-indigo-100 text-indigo-700 px-3 py-1 rounded-full">
                            Treino ativo
                        </span>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
