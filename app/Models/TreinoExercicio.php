<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TreinoExercicio extends Model
{
    protected $table = 'treino_exercicios';

    protected $fillable = [
        'treino_id',
        'exercicio_id',
        'series',
        'repeticoes',
        'descanso',
        'ordem',
        'concluido'
    ];

    public function treino()
    {
        return $this->belongsTo(Treino::class);
    }

    public function exercicio()
    {
        return $this->belongsTo(Exercicio::class);
    }
}
