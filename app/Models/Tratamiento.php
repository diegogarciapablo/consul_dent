<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tratamiento extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'duracion_min',
        'precio',
        'activo',
    ];

    protected $casts = [
        'precio' => 'decimal:2',
        'duracion_min' => 'integer',
        'activo' => 'boolean',
    ];

    public function citas(): HasMany
    {
        return $this->hasMany(Cita::class);
    }
}
