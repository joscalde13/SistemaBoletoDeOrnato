<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ConfiguracionMunicipalRequest;
use App\Models\ConfiguracionMunicipal;
use Illuminate\Support\Facades\Storage;

class ConfiguracionMunicipalController extends Controller
{
    /**
     * Formulario de configuración municipal.
     */
    public function edit()
    {
        $config = ConfiguracionMunicipal::obtener();

        // Crear registro por defecto si no existe
        if (!$config) {
            $config = ConfiguracionMunicipal::create([
                'nombre_municipalidad' => 'Municipalidad de Guatemala',
                'municipio' => 'Guatemala',
                'departamento' => 'Guatemala',
                'direccion' => 'Palacio Municipal',
                'telefono' => '0000-0000',
                'alcalde' => 'Alcalde Municipal',
                'anio_fiscal_actual' => now()->year,
            ]);
        }

        return view('admin.configuracion.edit', compact('config'));
    }

    /**
     * Actualizar configuración municipal.
     */
    public function update(ConfiguracionMunicipalRequest $request)
    {
        $config = ConfiguracionMunicipal::obtener();
        $datos = $request->validated();

        // Manejo del logo
        if ($request->hasFile('logo')) {
            // Eliminar logo anterior si existe
            if ($config->logo_path && Storage::disk('public')->exists($config->logo_path)) {
                Storage::disk('public')->delete($config->logo_path);
            }

            $datos['logo_path'] = $request->file('logo')->store('logos', 'public');
        }

        unset($datos['logo']);
        $config->update($datos);

        return redirect()->route('admin.configuracion.edit')
            ->with('success', 'Configuración actualizada exitosamente.');
    }
}
