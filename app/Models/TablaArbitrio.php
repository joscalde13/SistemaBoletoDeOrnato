<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TablaArbitrio extends Model
{
    protected $table = 'tabla_arbitrios';

    protected $fillable = [
        'rango_inicio',
        'rango_fin',
        'monto',
        'descripcion',
        'activo',
    ];

    protected function casts(): array
    {
        return [
            'rango_inicio' => 'decimal:2',
            'rango_fin' => 'decimal:2',
            'monto' => 'decimal:2',
            'activo' => 'boolean',
        ];
    }

    // ─── Scopes ─────────────────────────────────────────────

    /**
     * Solo rangos activos.
     */
    public function scopeActivos($query)
    {
        return $query->where('activo', true);
    }

    /**
     * Ordenar por rango de inicio.
     */
    public function scopeOrdenados($query)
    {
        return $query->orderBy('rango_inicio', 'asc');
    }

    // ─── Métodos estáticos ──────────────────────────────────

    /**
     * Calcular el monto del arbitrio según los ingresos mensuales.
     * Busca el rango activo que contiene el ingreso dado.
     */
    public static function calcularMonto(float $ingresosMensuales): float
    {
        $arbitrio = static::activos()
            ->where('rango_inicio', '<=', $ingresosMensuales)
            ->where('rango_fin', '>=', $ingresosMensuales)
            ->first();

        // Si no se encuentra rango, usar el rango más alto disponible
        if (!$arbitrio) {
            $arbitrio = static::activos()
                ->orderBy('rango_fin', 'desc')
                ->first();
        }

        return $arbitrio ? (float) $arbitrio->monto : 0;
    }
}
