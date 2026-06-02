<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConfiguracionMunicipal extends Model
{
    protected $table = 'configuracion_municipal';

    protected $fillable = [
        'nombre_municipalidad',
        'municipio',
        'departamento',
        'direccion',
        'telefono',
        'email',
        'sitio_web',
        'alcalde',
        'logo_path',
        'anio_fiscal_actual',
    ];

    protected function casts(): array
    {
        return [
            'anio_fiscal_actual' => 'integer',
        ];
    }

    // ─── Singleton ──────────────────────────────────────────

    /**
     * Obtener la configuración municipal actual (primer y único registro).
     */
    public static function obtener(): ?self
    {
        return static::first();
    }

    /**
     * Obtener el año fiscal actual configurado.
     */
    public static function anioFiscal(): int
    {
        $config = static::obtener();
        return $config ? $config->anio_fiscal_actual : now()->year;
    }
}
