<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Treino extends Model
{
    protected $fillable = [
        'nome',
        'descricao',
        'dia_semana',
        'categoria',
    ];

    public function exercicios()
    {
        return $this->belongsToMany(Exercicio::class, 'treino_exercicios', 'treino_id', 'exercicio_id')
                    ->withPivot('id', 'series', 'repeticoes', 'descanso', 'ordem', 'concluido')
                    ->withTimestamps();
    }

    public function alunos()
    {
        return $this->belongsToMany(Aluno::class, 'aluno_treino', 'treino_id', 'aluno_id')
                    ->withPivot('dia_semana')
                    ->withTimestamps();
    }
}
