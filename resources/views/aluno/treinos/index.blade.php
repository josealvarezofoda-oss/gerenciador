{{-- resources/views/aluno/treinos/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Meus Treinos</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($treinos->count())
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Criado em</th>
                </tr>
            </thead>
            <tbody>
                @foreach($treinos as $treino)
                    <tr>
                        <td>{{ $treino->nome }}</td>
                        <td>{{ $treino->descricao }}</td>
                        <td>{{ $treino->created_at->format('d/m/Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Você ainda não possui nenhum treino.</p>
    @endif
</div>
@endsection
