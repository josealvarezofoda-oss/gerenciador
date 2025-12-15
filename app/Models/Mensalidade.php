<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Mensalidade extends Model
{
    protected $fillable = [
        'aluno_id',
        'plano_id',
        'valor',
        'status',
        'mes_referencia',
        'pago_em',
    ];

    protected $casts = [
        'mes_referencia' => 'date',
        'pago_em' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($mensalidade) {
            if (!$mensalidade->mes_referencia) {
                $mensalidade->mes_referencia = Carbon::now()->startOfMonth();
            }

            if (!$mensalidade->status) {
                $mensalidade->status = 'pago';
            }
        });
    }


    public function aluno()
    {
        return $this->belongsTo(Aluno::class);
    }

    public function plano()
    {
        return $this->belongsTo(Plano::class);
    }
}
