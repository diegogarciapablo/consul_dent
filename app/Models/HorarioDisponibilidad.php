<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HorarioDisponibilidad extends Model
{
    use HasFactory;

    protected $table = 'horarios_disponibilidad';

    protected $fillable = [
        'dentista_id',
        'dia_semana',
        'hora_inicio',
        'hora_fin',
    ];

    public function dentista(): BelongsTo
    {
        return $this->belongsTo(Dentista::class);
    }
}
