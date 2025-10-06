{{-- resources/views/admin/treinos/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Treinos de {{ $aluno->name }}</h1>

    <a href="{{ route('admin.treino.criar', $aluno->id) }}" class="btn btn-primary mb-3">Criar Treino</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($treinos->count())
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($treinos as $treino)
                    <tr>
                        <td>{{ $treino->nome }}</td>
                        <td>{{ $treino->descricao }}</td>
                        <td>
                            <a href="{{ route('admin.treino.editar', $treino->id) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('admin.treino.deletar', $treino->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Deseja realmente deletar?')">Deletar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Nenhum treino cadastrado.</p>
    @endif
</div>
@endsection
