<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AlunoTreino extends Model
{
    protected $table = 'aluno_treino';

    protected $fillable = [
        'aluno_id',
        'treino_id',
    ];

    public $timestamps = false;

    public function aluno()
    {
        return $this->belongsTo(Aluno::class);
    }

    public function treino()
    {
        return $this->belongsTo(Treino::class);
    }
}
