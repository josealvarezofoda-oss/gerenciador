{{-- resources/views/admin/treinos/editar.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Treino: {{ $treino->nome }}</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.treino.atualizar', $treino->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nome" class="form-label">Nome do Treino</label>
            <input type="text" name="nome" id="nome" class="form-control" value="{{ old('nome', $treino->nome) }}" required>
        </div>

        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <textarea name="descricao" id="descricao" class="form-control">{{ old('descricao', $treino->descricao) }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Atualizar</button>
        <a href="{{ route('admin.treinos.index', $treino->aluno_id) }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
