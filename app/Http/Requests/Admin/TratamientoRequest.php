<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TratamientoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $tratamientoId = $this->tratamiento ? $this->tratamiento->id : null;

        return [
            'nombre' => [
                'required',
                'string',
                'max:100',
                Rule::unique('tratamientos', 'nombre')->ignore($tratamientoId),
            ],
            'descripcion' => ['nullable', 'string', 'max:500'],
            'duracion_min' => ['required', 'integer', 'min:5', 'max:480'],
            'precio' => ['required', 'numeric', 'min:0', 'max:99999.99'],
            'activo' => ['required', 'boolean'],
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.unique' => 'Ya existe un tratamiento con ese nombre.',
            'duracion_min.required' => 'La duración es obligatoria.',
            'duracion_min.min' => 'La duración mínima es 5 minutos.',
            'duracion_min.max' => 'La duración máxima es 480 minutos (8 horas).',
            'precio.required' => 'El precio es obligatorio.',
            'precio.min' => 'El precio no puede ser negativo.',
        ];
    }
}
