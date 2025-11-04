<select name="alunos[]" multiple required>
    @foreach($alunos as $aluno)
        <option value="{{ $aluno->id }}">{{ $aluno->name }}</option>
    @endforeach
</select>
