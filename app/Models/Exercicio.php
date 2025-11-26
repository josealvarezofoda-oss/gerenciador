<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exercicio extends Model
{
    protected $fillable = [
        'nome',
        'tipo',
        'maquina',
        'imagem',
        'descricao',
    ];

    public function treinos()
    {
        return $this->belongsToMany(Treino::class, 'treino_exercicios')
                    ->withPivot('series', 'repeticoes', 'descanso', 'ordem')
                    ->withTimestamps();
    }
}
