<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Presenca extends Model
{
    protected $table = 'presencas';

    protected $fillable = [
        'aluno_id',
        'treino_id',
        'status',
        'data',
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
