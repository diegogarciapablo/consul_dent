<?php

namespace App\Http\Requests\Paciente;

use Illuminate\Foundation\Http\FormRequest;

class CitaRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'dentista_id' => ['required', 'integer', 'exists:dentistas,id'],
            'tratamiento_id' => ['required', 'integer', 'exists:tratamientos,id'],
            'fecha' => ['required', 'date', 'after_or_equal:today'],
            'hora_inicio' => ['required', 'date_format:H:i'],
        ];
    }

    public function messages(): array
    {
        return [
            'dentista_id.required' => 'Debe seleccionar un dentista.',
            'dentista_id.exists' => 'El dentista seleccionado no existe.',
            'tratamiento_id.required' => 'Debe seleccionar un tratamiento.',
            'fecha.required' => 'La fecha es obligatoria.',
            'fecha.after_or_equal' => 'La fecha debe ser hoy o posterior.',
            'hora_inicio.required' => 'Debe seleccionar un horario.',
            'hora_inicio.date_format' => 'El formato de hora no es válido.',
        ];
    }
}
