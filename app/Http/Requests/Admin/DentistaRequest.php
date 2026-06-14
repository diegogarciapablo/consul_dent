<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DentistaRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(): array
    {
        $dentistaId = $this->dentista ? $this->dentista->id : null;

        return [
            'user_id' => [
                'required',
                'integer',
                'exists:users,id',
                Rule::unique('dentistas', 'user_id')->ignore($dentistaId),
            ],
            'especialidad' => ['required', 'string', 'max:100'],
            'nro_licencia' => [
                'required',
                'string',
                'max:50',
                Rule::unique('dentistas', 'nro_licencia')->ignore($dentistaId),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.required' => 'Debe seleccionar un usuario.',
            'user_id.exists' => 'El usuario seleccionado no existe.',
            'user_id.unique' => 'Este usuario ya tiene un perfil de dentista.',
            'especialidad.required' => 'La especialidad es obligatoria.',
            'nro_licencia.required' => 'El número de licencia es obligatorio.',
            'nro_licencia.unique' => 'Este número de licencia ya está registrado.',
        ];
    }
}
