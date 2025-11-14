@extends('layouts.admin')

@section('content')
<div class="fade">
    <h2 class="text-2xl font-semibold mb-6 text-indigo-700">Cadastrar Novo Aluno</h2>

    <form action="{{ route('admin.alunos.store') }}" method="POST" class="bg-white rounded-2xl shadow-md p-6">
        @csrf
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-gray-700 mb-2">Nome</label>
                <input type="text" name="name" class="w-full border rounded-lg p-2" required>
            </div>
            <div>
                <label class="block text-gray-700 mb-2">Email</label>
                <input type="email" name="email" class="w-full border rounded-lg p-2" required>
            </div>

            <div>
                <label class="block text-gray-700 mb-2">Idade</label>
                <input type="number" name="idade" class="w-full border rounded-lg p-2">
            </div>
            <div>
                <label class="block text-gray-700 mb-2">Sexo</label>
                <select name="sexo" class="w-full border rounded-lg p-2">
                    <option value="">Selecione</option>
                    <option value="M">Masculino</option>
                    <option value="F">Feminino</option>
                </select>
            </div>

            <div>
                <label class="block text-gray-700 mb-2">Altura (m)</label>
                <input type="number" step="0.01" name="altura" id="altura" class="w-full border rounded-lg p-2">
            </div>
            <div>
                <label class="block text-gray-700 mb-2">Peso (kg)</label>
                <input type="number" step="0.1" name="peso" id="peso" class="w-full border rounded-lg p-2">
            </div>

            <div>
                <label class="block text-gray-700 mb-2">IMC (automático)</label>
                <input type="text" id="imc" class="w-full border rounded-lg p-2 bg-gray-100" readonly>
            </div>
            <div>
                <label class="block text-gray-700 mb-2">Data de Matrícula</label>
                <input type="text" name="data_matricula" class="w-full border rounded-lg p-2 bg-gray-100" value="{{ now()->format('d/m/Y') }}" readonly>
            </div>
        </div>

        <button class="mt-6 bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">Salvar</button>
    </form>
</div>

{{-- Script para calcular IMC automaticamente --}}
<script>
    const alturaInput = document.getElementById('altura');
    const pesoInput = document.getElementById('peso');
    const imcInput = document.getElementById('imc');

    function calcularIMC() {
        const altura = parseFloat(alturaInput.value);
        const peso = parseFloat(pesoInput.value);
        if (altura && peso && altura > 0) {
            const imc = (peso / (altura * altura)).toFixed(2);
            imcInput.value = imc;
        } else {
            imcInput.value = '';
        }
    }

    alturaInput.addEventListener('input', calcularIMC);
    pesoInput.addEventListener('input', calcularIMC);
</script>
@endsection
