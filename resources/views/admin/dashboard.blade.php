@extends('layouts.admin')

@section('title', 'Dashboard - FitWay')

@section('content')

<div class="p-8">
    <h1 class="text-3xl font-bold text-indigo-700 mb-8">Painel do Administrador</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Card de Alunos -->
        <div class="bg-white rounded-2xl shadow-md p-6 hover:shadow-xl transition-shadow duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-semibold text-gray-700">Alunos</h2>
                    <p class="text-4xl font-bold text-indigo-600 mt-2">{{ $totalAlunos ?? 0 }}</p>
                </div>
                <div class="bg-indigo-100 p-4 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5V10H2v10h5m10 0v-4H7v4m10 0H7" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Card de Treinos Cadastrados -->
        <div class="bg-white rounded-2xl shadow-md p-6 hover:shadow-xl transition-shadow duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-semibold text-gray-700">Treinos Cadastrados</h2>
                    <p class="text-4xl font-bold text-purple-600 mt-2">{{ $totalTreinos ?? 0 }}</p>
                </div>
                <div class="bg-purple-100 p-4 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m2 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
