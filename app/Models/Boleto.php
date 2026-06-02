<?php

namespace App\Models;

use App\Enums\EstadoBoleto;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Boleto extends Model
{
    use SoftDeletes;

    protected $table = 'boletos';

    protected $fillable = [
        'numero_boleto',
        'codigo_verificacion',
        'contribuyente_id',
        'anio_fiscal',
        'monto',
        'estado',
        'fecha_emision',
        'fecha_pago',
        'metodo_pago',
        'referencia_pago',
        'observaciones',
        'emitido_por',
    ];

    protected function casts(): array
    {
        return [
            'monto' => 'decimal:2',
            'estado' => EstadoBoleto::class,
            'fecha_emision' => 'datetime',
            'fecha_pago' => 'datetime',
            'anio_fiscal' => 'integer',
        ];
    }

    // ─── Boot ───────────────────────────────────────────────

    protected static function booted(): void
    {
        static::creating(function (Boleto $boleto) {
            if (empty($boleto->numero_boleto)) {
                $boleto->numero_boleto = self::generarNumeroBoleto();
            }
            if (empty($boleto->codigo_verificacion)) {
                $boleto->codigo_verificacion = (string) Str::uuid();
            }
            if (empty($boleto->fecha_emision)) {
                $boleto->fecha_emision = now();
            }
            if (empty($boleto->estado)) {
                $boleto->estado = EstadoBoleto::Pendiente;
            }
        });
    }

    // ─── Relaciones ─────────────────────────────────────────

    /**
     * Contribuyente dueño del boleto.
     */
    public function contribuyente(): BelongsTo
    {
        return $this->belongsTo(Contribuyente::class);
    }

    /**
     * Usuario admin que emitió el boleto (null si fue autoservicio).
     */
    public function emisor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'emitido_por');
    }

    // ─── Scopes ─────────────────────────────────────────────

    public function scopePagados($query)
    {
        return $query->where('estado', EstadoBoleto::Pagado);
    }

    public function scopePendientes($query)
    {
        return $query->where('estado', EstadoBoleto::Pendiente);
    }

    public function scopeAnulados($query)
    {
        return $query->where('estado', EstadoBoleto::Anulado);
    }

    public function scopeDelDia($query)
    {
        return $query->whereDate('fecha_emision', today());
    }

    public function scopeDelMes($query)
    {
        return $query->whereMonth('fecha_emision', now()->month)
                     ->whereYear('fecha_emision', now()->year);
    }

    public function scopeDelAnio($query, int $year)
    {
        return $query->where('anio_fiscal', $year);
    }

    // ─── Métodos de instancia ───────────────────────────────

    /**
     * Verificar si el boleto está pagado.
     */
    public function estaPagado(): bool
    {
        return $this->estado === EstadoBoleto::Pagado;
    }

    /**
     * Verificar si el boleto está pendiente.
     */
    public function estaPendiente(): bool
    {
        return $this->estado === EstadoBoleto::Pendiente;
    }

    /**
     * Verificar si el boleto fue anulado.
     */
    public function estaAnulado(): bool
    {
        return $this->estado === EstadoBoleto::Anulado;
    }

    // ─── Métodos estáticos ──────────────────────────────────

    /**
     * Generar número de boleto único con formato BO-YYYY-XXXXX.
     */
    public static function generarNumeroBoleto(): string
    {
        $year = now()->year;
        $ultimo = static::withTrashed()
            ->where('numero_boleto', 'like', "BO-{$year}-%")
            ->orderBy('id', 'desc')
            ->value('numero_boleto');

        if ($ultimo) {
            $secuencia = (int) Str::afterLast($ultimo, '-') + 1;
        } else {
            $secuencia = 1;
        }

        return sprintf('BO-%d-%05d', $year, $secuencia);
    }
}
