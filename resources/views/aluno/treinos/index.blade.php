@extends('layouts.aluno')

@section('content')
<div class="fade">

    <h2 class="text-2xl font-semibold mb-6 text-indigo-700">Meus Treinos</h2>

    @if($treinos->isEmpty())
        <div class="bg-white rounded-2xl shadow-sm p-6 text-center text-gray-600">
            Nenhum treino disponível no momento.
        </div>
    @else
        <!--AbaTreino-->
        <div class="space-y-6">
            @foreach($treinos as $treino)
                <div x-data="{ open: false }" class="bg-white rounded-2xl shadow-md overflow-hidden">

                    {{-- Cabeçalho do treino --}}
                    <button @click="open = !open"
                            class="w-full flex justify-between items-center p-6 text-left">
                        <div>
                            <h3 class="text-xl font-bold text-indigo-700">{{ $treino->nome }}</h3>
                            <p class="text-sm text-gray-600">
                                <strong>Dia:</strong> {{ ucfirst($treino->pivot->dia_semana ?? '—') }}
                                @if($treino->categoria)
                                    — <strong>Categoria:</strong> {{ $treino->categoria }}
                                @endif
                            </p>
                        </div>
                        <span class="material-icons text-indigo-700">
                            <span x-show="!open">expand_more</span>
                            <span x-show="open">expand_less</span>
                        </span>
                    </button>

                    {{-- Exercícios retrátil --}}
                    <div x-show="open" x-transition class="px-6 pb-6 space-y-4">
                        @if($treino->descricao)
                            <p class="text-gray-700">{{ $treino->descricao }}</p>
                        @endif

                        @if($treino->exercicios->isEmpty())
                            <p class="text-gray-600">Nenhum exercício cadastrado para este treino.</p>
                        @else
                            @foreach($treino->exercicios as $ex)
                                <div class="p-4 bg-gray-100 rounded-xl flex gap-4">

                                    {{-- Imagem --}}
                                    <div class="w-28 h-28 rounded-lg overflow-hidden bg-white shadow">
                                        @if($ex->imagem)
                                            <img src="{{ asset('storage/' . $ex->imagem) }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-gray-400 text-sm">
                                                Sem imagem
                                            </div>
                                        @endif
                                    </div>

                                    {{-- Info --}}
                                    <div class="flex-1">
                                        <p class="font-semibold text-gray-800 text-lg">{{ $ex->nome }}</p>
                                        <p class="text-sm text-gray-700"><strong>Séries:</strong> {{ $ex->pivot->series }}</p>
                                        <p class="text-sm text-gray-700"><strong>Repetições:</strong> {{ $ex->pivot->repeticoes }}</p>
                                        <p class="text-sm text-gray-700"><strong>Descanso:</strong> {{ $ex->pivot->descanso }}s</p>
                                    </div>

                                    {{-- Botão concluir --}}
                                    <div class="flex items-center">
                                        <form action="{{ route('aluno.treinos.concluir', $ex->pivot->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button class="px-4 py-2 rounded-lg text-white 
                                                {{ $ex->pivot->concluido ? 'bg-green-600' : 'bg-indigo-600' }}
                                                hover:opacity-80 transition">
                                                {{ $ex->pivot->concluido ? 'Concluído' : 'Concluir' }}
                                            </button>
                                        </form>
                                    </div>

                                </div>
                            @endforeach
                        @endif
                    </div>

                </div>
            @endforeach
        </div>
    @endif

</div>
@endsection
