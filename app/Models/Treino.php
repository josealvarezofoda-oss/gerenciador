<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Treino extends Model
{
    use HasFactory;

    // Colunas que podem ser preenchidas via CRUD
    protected $fillable = ['user_id', 'nome', 'descricao'];

    // Relacionamento com o aluno
    public function aluno()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
