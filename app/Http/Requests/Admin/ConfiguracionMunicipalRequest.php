<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ConfiguracionMunicipalRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre_municipalidad' => ['required', 'string', 'max:255'],
            'municipio' => ['required', 'string', 'max:100'],
            'departamento' => ['required', 'string', 'max:100'],
            'direccion' => ['required', 'string', 'max:500'],
            'telefono' => ['required', 'string', 'max:20'],
            'email' => ['nullable', 'email', 'max:150'],
            'sitio_web' => ['nullable', 'url', 'max:255'],
            'alcalde' => ['required', 'string', 'max:200'],
            'logo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,svg', 'max:2048'],
            'anio_fiscal_actual' => ['required', 'integer', 'min:2020', 'max:2050'],
        ];
    }

    public function messages(): array
    {
        return [
            'nombre_municipalidad.required' => 'El nombre de la municipalidad es obligatorio.',
            'municipio.required' => 'El municipio es obligatorio.',
            'departamento.required' => 'El departamento es obligatorio.',
            'direccion.required' => 'La dirección es obligatoria.',
            'telefono.required' => 'El teléfono es obligatorio.',
            'alcalde.required' => 'El nombre del alcalde es obligatorio.',
            'logo.image' => 'El logo debe ser una imagen.',
            'logo.max' => 'El logo no debe superar los 2MB.',
            'anio_fiscal_actual.required' => 'El año fiscal es obligatorio.',
        ];
    }
}
