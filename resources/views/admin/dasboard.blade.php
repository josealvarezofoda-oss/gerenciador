<h1>Dashboard Admin</h1>

<h2>Alunos</h2>
<ul>
@foreach($alunos as $aluno)
    <li>
        {{ $aluno->name }}
        <a href="{{ route('admin.treino.criar', $aluno->id) }}">Criar Treino</a>
    </li>
@endforeach
</ul>
