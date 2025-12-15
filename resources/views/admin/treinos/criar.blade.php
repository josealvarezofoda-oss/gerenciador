@extends('layouts.admin')

@section('content')
<div class="fade">
    <h2 class="text-3xl font-semibold mb-6 text-indigo-700">Cadastrar Novo Treino</h2>

    <form action="{{ route('admin.treinos.store') }}" method="POST" class="bg-white rounded-2xl shadow-md p-8">
        @csrf

        <div class="grid grid-cols-2 gap-6">
            <div>
                <label>Nome do Treino</label>
                <input type="text" name="nome" class="w-full border rounded-lg p-3 mt-1" required>
            </div>

            <div>
                <label>Categoria</label>
                <input type="text" name="categoria" class="w-full border rounded-lg p-3 mt-1">
            </div>

            <div>
                <label>Dia da Semana</label>
                <select name="dia_semana" class="w-full border rounded-lg p-3 mt-1" required>
                    <option value="">Selecione...</option>
                    <option value="segunda">Segunda-feira</option>
                    <option value="terca">Terça-feira</option>
                    <option value="quarta">Quarta-feira</option>
                    <option value="quinta">Quinta-feira</option>
                    <option value="sexta">Sexta-feira</option>
                </select>
            </div>

            <div class="col-span-2">
                <label>Descrição</label>
                <textarea name="descricao" rows="3" class="w-full border rounded-lg p-3 mt-1"></textarea>
            </div>
            <!--Coluna Seleção alunos-->
            <div class="col-span-2">
                <label>Selecionar Alunos</label>
                <select name="alunos[]" multiple class="w-full border rounded-lg p-3 h-44 mt-1">
                    @foreach($alunos as $aluno)
                        <option value="{{ $aluno->id }}">
                            {{ $aluno->user->name }}
                            @if($aluno->plano)
                                — {{ $aluno->plano->dias_semana }} dias
                            @else
                                — Sem plano
                            @endif
                            — {{ ucfirst($aluno->status) }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <hr class="my-8">

        <h3 class="text-xl font-semibold mb-4">Adicionar Exercícios</h3>

        <div id="ex-container"></div>

        <button type="button" id="add-ex-btn"
            class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">
            + Adicionar Exercício
        </button>

        <button class="mt-6 bg-indigo-600 text-white px-6 py-3 rounded-xl hover:bg-indigo-700 transition w-full">
            Criar Treino
        </button>
    </form>
</div>

<script>
const exercicios = @json($exercicios);
let index = 0;

document.getElementById('add-ex-btn').addEventListener('click', () => {
    const container = document.getElementById('ex-container');

    const html = `
    <div class="bg-gray-100 p-4 rounded-xl mb-4 relative border">

        <button type="button"
            class="remove-ex absolute top-2 right-2 text-red-600 font-bold text-lg">X</button>

        <label>Exercício</label>
        <select name="exercicios[${index}][exercicio_id]" class="w-full border rounded-lg p-2 mt-1" required>
            <option value="">Selecione...</option>
            ${exercicios.map(ex => `<option value="${ex.id}">${ex.nome}</option>`).join('')}
        </select>

        <div class="grid grid-cols-3 gap-4 mt-4">
            <div>
                <label>Séries</label>
                <input type="number" name="exercicios[${index}][series]" class="w-full border rounded-lg p-2" required>
            </div>

            <div>
                <label>Repetições</label>
                <input type="number" name="exercicios[${index}][repeticoes]" class="w-full border rounded-lg p-2" required>
            </div>

            <div>
                <label>Descanso (s)</label>
                <input type="number" name="exercicios[${index}][descanso]" class="w-full border rounded-lg p-2">
            </div>
        </div>

        <div class="mt-4">
            <label>Ordem</label>
            <input type="number" name="exercicios[${index}][ordem]" class="w-full border rounded-lg p-2">
        </div>

    </div>
    `;

    container.insertAdjacentHTML('beforeend', html);

    index++;

    // Remover bloco de exercício
    document.querySelectorAll('.remove-ex').forEach(btn => {
        btn.onclick = function () {
            this.parentElement.remove();
        };
    });
});
</script>
@endsection
