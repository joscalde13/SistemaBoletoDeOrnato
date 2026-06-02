<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BuscarContribuyenteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Ruta pública
    }

    public function rules(): array
    {
        return [
            'dpi' => ['required', 'string', 'size:13', 'regex:/^[0-9]{13}$/'],
        ];
    }

    public function messages(): array
    {
        return [
            'dpi.required' => 'El número de DPI es obligatorio.',
            'dpi.size' => 'El DPI debe tener exactamente 13 dígitos.',
            'dpi.regex' => 'El DPI debe contener solo números.',
        ];
    }
}
