{{-- resources/views/admin/treinos/criar.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Criar Treino para {{ $aluno->name }}</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.treino.salvar', $aluno->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nome" class="form-label">Nome do Treino</label>
            <input type="text" name="nome" id="nome" class="form-control" value="{{ old('nome') }}" required>
        </div>

        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <textarea name="descricao" id="descricao" class="form-control">{{ old('descricao') }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Salvar</button>
        <a href="{{ route('admin.treinos.index', $aluno->id) }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
