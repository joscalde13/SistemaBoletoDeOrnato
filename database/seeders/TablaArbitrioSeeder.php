<?php

namespace Database\Seeders;

use App\Models\TablaArbitrio;
use Illuminate\Database\Seeder;

/**
 * Seeder para la tabla de arbitrios según Decreto 121-96
 * Ley del Arbitrio de Ornato Municipal de Guatemala.
 */
class TablaArbitrioSeeder extends Seeder
{
    public function run(): void
    {
        $rangos = [
            ['rango_inicio' => 0,        'rango_fin' => 300,      'monto' => 4,    'descripcion' => 'Rango 1 - Ingresos hasta Q300.00'],
            ['rango_inicio' => 300.01,   'rango_fin' => 500,      'monto' => 10,   'descripcion' => 'Rango 2 - Ingresos de Q300.01 a Q500.00'],
            ['rango_inicio' => 500.01,   'rango_fin' => 1000,     'monto' => 15,   'descripcion' => 'Rango 3 - Ingresos de Q500.01 a Q1,000.00'],
            ['rango_inicio' => 1000.01,  'rango_fin' => 3000,     'monto' => 25,   'descripcion' => 'Rango 4 - Ingresos de Q1,000.01 a Q3,000.00'],
            ['rango_inicio' => 3000.01,  'rango_fin' => 5000,     'monto' => 50,   'descripcion' => 'Rango 5 - Ingresos de Q3,000.01 a Q5,000.00'],
            ['rango_inicio' => 5000.01,  'rango_fin' => 10000,    'monto' => 75,   'descripcion' => 'Rango 6 - Ingresos de Q5,000.01 a Q10,000.00'],
            ['rango_inicio' => 10000.01, 'rango_fin' => 15000,    'monto' => 100,  'descripcion' => 'Rango 7 - Ingresos de Q10,000.01 a Q15,000.00'],
            ['rango_inicio' => 15000.01, 'rango_fin' => 20000,    'monto' => 150,  'descripcion' => 'Rango 8 - Ingresos de Q15,000.01 a Q20,000.00'],
            ['rango_inicio' => 20000.01, 'rango_fin' => 999999.99,'monto' => 200,  'descripcion' => 'Rango 9 - Ingresos mayores a Q20,000.00'],
        ];

        foreach ($rangos as $rango) {
            TablaArbitrio::create(array_merge($rango, ['activo' => true]));
        }
    }
}
