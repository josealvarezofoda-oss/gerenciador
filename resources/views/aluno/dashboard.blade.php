@extends('layouts.aluno')

@section('content')
<div class="max-w-5xl mx-auto p-6 bg-white shadow-md rounded-2xl">
    <h1 class="text-3xl font-bold text-indigo-700 mb-6">Bem-vindo, {{ $user->name }}</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Informações pessoais -->
        <div class="bg-gray-50 p-6 rounded-2xl shadow-sm hover:shadow-md transition">
            <h2 class="text-xl font-semibold text-gray-800 border-b pb-2 mb-4">Informações Pessoais</h2>
            <p><span class="font-medium text-gray-600">Nome:</span> {{ $user->name }}</p>
            <p><span class="font-medium text-gray-600">Email:</span> {{ $user->email }}</p>
            <p><span class="font-medium text-gray-600">Idade:</span> {{ $aluno->idade ?? '—' }}</p>
            <p><span class="font-medium text-gray-600">Sexo:</span> {{ ucfirst($aluno->sexo ?? '—') }}</p>
            <p><span class="font-medium text-gray-600">Data de Matrícula:</span> 
                {{ $aluno->data_matricula ? $aluno->data_matricula->format('d/m/Y') : '—' }}
            </p>
            <p><span class="font-medium text-gray-600">Status:</span> 
                <span class="inline-block px-3 py-1 text-sm rounded-full bg-green-500 text-white">Ativo</span>
            </p>
        </div>

        <!-- Informações físicas -->
        <div class="bg-gray-50 p-6 rounded-2xl shadow-sm hover:shadow-md transition">
            <h2 class="text-xl font-semibold text-gray-800 border-b pb-2 mb-4">Informações Físicas</h2>
            <p><span class="font-medium text-gray-600">Altura:</span> {{ $aluno->altura ? $aluno->altura . ' cm' : '—' }}</p>
            <p><span class="font-medium text-gray-600">Peso:</span> {{ $aluno->peso ? $aluno->peso . ' kg' : '—' }}</p>
            <p><span class="font-medium text-gray-600">IMC:</span> {{ $imc ?? '—' }}</p>
            
            @if($imc)
                <div class="mt-3">
                    @if($imc < 18.5)
                        <span class="text-blue-600 font-medium">Abaixo do peso</span>
                    @elseif($imc < 25)
                        <span class="text-green-600 font-medium">Peso ideal</span>
                    @elseif($imc < 30)
                        <span class="text-yellow-600 font-medium">Sobrepeso</span>
                    @else
                        <span class="text-red-600 font-medium">Obesidade</span>
                    @endif
                </div>
            @endif
        </div>
    </div>

    <!-- Botão para acessar treinos -->
    <div class="mt-8 text-center">
        <a href="{{ route('aluno.treinos.index') }}" 
           class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-xl font-semibold transition">
            Ver Meus Treinos
        </a>
    </div>
</div>
@endsection
