<?php

namespace Database\Seeders;

use App\Models\ConfiguracionMunicipal;
use Illuminate\Database\Seeder;

/**
 * Seeder para configuración municipal inicial.
 */
class ConfiguracionMunicipalSeeder extends Seeder
{
    public function run(): void
    {
        ConfiguracionMunicipal::create([
            'nombre_municipalidad' => 'Municipalidad de Guatemala',
            'municipio' => 'Guatemala',
            'departamento' => 'Guatemala',
            'direccion' => '21 calle 6-77, zona 1, Centro Cívico, Ciudad de Guatemala',
            'telefono' => '2285-8000',
            'email' => 'info@muniguate.com',
            'sitio_web' => 'https://www.muniguate.com',
            'alcalde' => 'Alcalde Municipal',
            'anio_fiscal_actual' => now()->year,
        ]);
    }
}
