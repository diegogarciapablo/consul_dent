<?php

namespace App\Models;

use App\Models\HorarioDisponibilidad;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Dentista extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'especialidad',
        'nro_licencia',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function horariosDisponibilidad(): HasMany
    {
        return $this->hasMany(HorarioDisponibilidad::class);
    }

    public function horarios(): HasMany
    {
        return $this->hasMany(HorarioDisponibilidad::class, 'dentista_id');
    }

    public function citas(): HasMany
    {
        return $this->hasMany(Cita::class);
    }
}
