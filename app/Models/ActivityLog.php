<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ActivityLog extends Model
{
    // Campos permitidos
    protected $fillable = [
        'user_id',
        'action',
        'meta'
    ];

    // Converte 'meta' automaticamente de/para array
    protected $casts = [
        'meta' => 'array',
    ];

    // Relacionamento com User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
