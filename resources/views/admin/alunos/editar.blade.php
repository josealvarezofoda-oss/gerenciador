@extends('layouts.admin')

@section('content')
<div class="fade">
    <h2 class="text-2xl font-semibold mb-6 text-indigo-700">Editar Aluno</h2>

    <form id="formEditarAluno" action="{{ route('admin.alunos.update', $aluno->id) }}" method="POST" class="bg-white rounded-2xl shadow-md p-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-gray-700 mb-2">Nome</label>
                <input name="name" value="{{ old('name', $aluno->name) }}" class="w-full border rounded-lg p-2" required>
            </div>

            <div>
                <label class="block text-gray-700 mb-2">Email</label>
                <input type="email" name="email" value="{{ old('email', $aluno->email) }}" class="w-full border rounded-lg p-2" required>
            </div>

            <div>
                <label class="block text-gray-700 mb-2">Idade</label>
                <input name="idade" value="{{ old('idade', $aluno->aluno->idade ?? '') }}" class="w-full border rounded-lg p-2">
            </div>

            <div>
                <label class="block text-gray-700 mb-2">Sexo</label>
                <select name="sexo" class="w-full border rounded-lg p-2">
                    <option value="">Selecione</option>
                    <option value="M" {{ old('sexo', $aluno->aluno->sexo ?? '') == 'M' ? 'selected' : '' }}>Masculino</option>
                    <option value="F" {{ old('sexo', $aluno->aluno->sexo ?? '') == 'F' ? 'selected' : '' }}>Feminino</option>
                </select>
            </div>

            <div>
                <label class="block text-gray-700 mb-2">Altura (m)</label>
                <input name="altura" value="{{ old('altura', $aluno->aluno->altura ?? '') }}" class="w-full border rounded-lg p-2" step="0.01">
            </div>

            <div>
                <label class="block text-gray-700 mb-2">Peso (kg)</label>
                <input name="peso" value="{{ old('peso', $aluno->aluno->peso ?? '') }}" class="w-full border rounded-lg p-2" step="0.1">
            </div>
        </div>

        <button type="submit" class="mt-6 bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition">
            Atualizar
        </button>
    </form>
</div>

{{-- Importa o SweetAlert2 --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.getElementById('formEditarAluno').addEventListener('submit', function(e) {
    const nome = document.querySelector('[name="name"]').value.trim();
    const email = document.querySelector('[name="email"]').value.trim();
    const altura = document.querySelector('[name="altura"]').value.trim();
    const idade = document.querySelector('[name="idade"]').value.trim();

    if (!nome || !email || !altura || !idade) {
        e.preventDefault();
        Swal.fire({
            icon: 'warning',
            title: 'Campos obrigatórios',
            text: 'Por favor, preencha todos os campos!',
            confirmButtonColor: '#4F46E5',
            confirmButtonText: 'Ok, entendi'
        });
    }
});
</script>
@endsection
