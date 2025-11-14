<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Treino extends Model
{

    use HasFactory;

    protected $fillable = [
        'user_id',
        'nome',
        'descricao',
        'categoria',
        'dia_semana'
    ];

    // Cada treino pertence a um aluno principal (dono do treino)
    public function aluno()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Um treino pode estar associado a vários alunos (via pivot)
    public function alunos()
    {
        return $this->belongsToMany(User::class, 'aluno_treino', 'treino_id', 'aluno_id');
    }

}
