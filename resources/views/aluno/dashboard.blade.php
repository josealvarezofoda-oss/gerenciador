<h1>Dashboard Aluno</h1>

<h2>Seus Treinos</h2>
<ul>
@foreach($treinos as $treino)
    <li>{{ $treino->nome }} - {{ $treino->descricao }}</li>
@endforeach
</ul>
