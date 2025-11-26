<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Aluno extends Model
{
    use HasFactory;

    protected $fillable = [
        'idade',
        'sexo',
        'altura',
        'peso',
        'data_matricula',
        'user_id',
        'status',
        'plano_id',
    ];

    protected $casts = [
        'data_matricula' => 'datetime',
        'status' => 'string',
    ];

    public function treinos()
    {
        return $this->belongsToMany(Treino::class, 'aluno_treino', 'aluno_id', 'treino_id')
                ->withPivot('dia_semana')
                ->withTimestamps();
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function plano()
    {
        return $this->belongsTo(Plano::class);
    }
}
