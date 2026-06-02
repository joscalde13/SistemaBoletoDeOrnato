<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class TablaArbitrioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // La autorización se maneja via middleware auth
    }

    public function rules(): array
    {
        return [
            'rango_inicio' => ['required', 'numeric', 'min:0'],
            'rango_fin' => ['required', 'numeric', 'gt:rango_inicio'],
            'monto' => ['required', 'numeric', 'min:0.01'],
            'descripcion' => ['nullable', 'string', 'max:255'],
            'activo' => ['sometimes', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'rango_inicio.required' => 'El rango inicial es obligatorio.',
            'rango_fin.required' => 'El rango final es obligatorio.',
            'rango_fin.gt' => 'El rango final debe ser mayor al rango inicial.',
            'monto.required' => 'El monto del arbitrio es obligatorio.',
            'monto.min' => 'El monto debe ser mayor a Q0.00.',
        ];
    }
}
