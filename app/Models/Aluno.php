<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use HasFactory;

class Aluno extends Model
{
    

    protected $fillable = [
        'idade',
        'sexo',
        'altura',
        'peso',
        'data_matricula',
        'user_id',
    ];

    protected $casts = [
        'data_matricula' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
