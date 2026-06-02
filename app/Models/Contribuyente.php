<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Contribuyente extends Model
{
    use SoftDeletes;

    protected $table = 'contribuyentes';

    protected $fillable = [
        'dpi',
        'primer_nombre',
        'segundo_nombre',
        'primer_apellido',
        'segundo_apellido',
        'fecha_nacimiento',
        'genero',
        'direccion',
        'municipio',
        'departamento',
        'telefono',
        'email',
        'nit',
        'ingresos_mensuales',
    ];

    protected function casts(): array
    {
        return [
            'fecha_nacimiento' => 'date',
            'ingresos_mensuales' => 'decimal:2',
        ];
    }

    // ─── Relaciones ─────────────────────────────────────────

    /**
     * Boletos emitidos para este contribuyente.
     */
    public function boletos(): HasMany
    {
        return $this->hasMany(Boleto::class);
    }

    // ─── Accessors ──────────────────────────────────────────

    /**
     * Nombre completo del contribuyente.
     */
    public function getNombreCompletoAttribute(): string
    {
        return collect([
            $this->primer_nombre,
            $this->segundo_nombre,
            $this->primer_apellido,
            $this->segundo_apellido,
        ])->filter()->implode(' ');
    }

    // ─── Scopes ─────────────────────────────────────────────

    /**
     * Buscar contribuyente por DPI.
     */
    public function scopeBuscarPorDpi($query, string $dpi)
    {
        return $query->where('dpi', $dpi);
    }

    /**
     * Buscar por nombre o DPI.
     */
    public function scopeBuscar($query, string $termino)
    {
        return $query->where(function ($q) use ($termino) {
            $q->where('dpi', 'like', "%{$termino}%")
              ->orWhere('primer_nombre', 'like', "%{$termino}%")
              ->orWhere('primer_apellido', 'like', "%{$termino}%")
              ->orWhere('segundo_apellido', 'like', "%{$termino}%");
        });
    }
}
