<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plano extends Model
{
    protected $fillable = [
        'nome',
        'dias_semana',
        'valor'
    ];


    public function alunos()
    {
        return $this->hasMany(Aluno::class);
    }
}

