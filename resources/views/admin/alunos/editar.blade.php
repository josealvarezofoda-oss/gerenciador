@extends('layouts.admin')

@section('content')
<div class="fade">
    <h2 class="text-2xl font-semibold mb-6 text-indigo-700">Editar Aluno</h2>

    <form id="formEditarAluno" 
          action="{{ route('admin.alunos.update', $aluno->id) }}" 
          method="POST" 
          class="bg-white rounded-2xl shadow-md p-6">

        @csrf
        @method('PUT')

        <div class="grid grid-cols-2 gap-4">

            {{-- Nome --}}
            <div>
                <label class="block text-gray-700 mb-2">Nome</label>
                <input name="name" 
                       value="{{ old('name', optional($aluno->user)->name) }}" 
                       class="w-full border rounded-lg p-2" required>
            </div>

            {{-- Email --}}
            <div>
                <label class="block text-gray-700 mb-2">Email</label>
                <input type="email" name="email" 
                       value="{{ old('email', optional($aluno->user)->email) }}"
                       class="w-full border rounded-lg p-2" required>
            </div>

            {{-- Plano --}}
            <div>
                <label class="block text-gray-700 mb-2">Plano</label>
                <select name="plano_id" class="w-full border rounded-lg p-2" required>
                    @foreach($planos as $plano)
                        <option value="{{ $plano->id }}"
                            {{ old('plano_id', $aluno->plano_id) == $plano->id ? 'selected' : '' }}>
                            {{ $plano->dias_semana }} dias — R${{ number_format($plano->valor, 2, ',', '.') }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Idade --}}
            <div>
                <label class="block text-gray-700 mb-2">Idade</label>
                <input name="idade" 
                       value="{{ old('idade', $aluno->idade) }}" 
                       class="w-full border rounded-lg p-2">
            </div>

            {{-- Sexo --}}
            <div>
                <label class="block text-gray-700 mb-2">Sexo</label>
                <select name="sexo" class="w-full border rounded-lg p-2">
                    <option value="">Selecione</option>
                    <option value="M" {{ old('sexo', $aluno->sexo) == 'M' ? 'selected' : '' }}>Masculino</option>
                    <option value="F" {{ old('sexo', $aluno->sexo) == 'F' ? 'selected' : '' }}>Feminino</option>
                </select>
            </div>

            {{-- Altura --}}
            <div>
                <label class="block text-gray-700 mb-2">Altura (cm)</label>
                <input name="altura" 
                       value="{{ old('altura', $aluno->altura) }}" 
                       class="w-full border rounded-lg p-2">
            </div>

            {{-- Peso --}}
            <div>
                <label class="block text-gray-700 mb-2">Peso (kg)</label>
                <input name="peso" 
                       value="{{ old('peso', $aluno->peso) }}" 
                       class="w-full border rounded-lg p-2">
            </div>

        </div>

        <button type="submit" class="mt-6 bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition">
            Atualizar
        </button>
    </form>
</div>

@endsection
