<?php

namespace App\Services;

use App\Enums\EstadoBoleto;
use App\Models\Boleto;
use App\Models\ConfiguracionMunicipal;
use App\Models\Contribuyente;
use App\Models\TablaArbitrio;
use Illuminate\Support\Facades\DB;

class BoletoService
{
    /**
     * Calcular el monto del arbitrio según ingresos mensuales.
     */
    public function calcularMonto(float $ingresos): float
    {
        return TablaArbitrio::calcularMonto($ingresos);
    }

    /**
     * Generar un nuevo boleto de ornato para un contribuyente.
     */
    public function generarBoleto(Contribuyente $contribuyente, float $ingresos, ?int $emitidoPor = null): Boleto
    {
        return DB::transaction(function () use ($contribuyente, $ingresos, $emitidoPor) {
            // Actualizar ingresos del contribuyente
            $contribuyente->update(['ingresos_mensuales' => $ingresos]);

            $monto = $this->calcularMonto($ingresos);
            $anioFiscal = ConfiguracionMunicipal::anioFiscal();

            return Boleto::create([
                'contribuyente_id' => $contribuyente->id,
                'anio_fiscal' => $anioFiscal,
                'monto' => $monto,
                'estado' => EstadoBoleto::Pendiente,
                'fecha_emision' => now(),
                'emitido_por' => $emitidoPor,
            ]);
        });
    }

    /**
     * Procesar el pago de un boleto.
     */
    public function procesarPago(Boleto $boleto, string $metodoPago, ?string $referencia = null): Boleto
    {
        $boleto->update([
            'estado' => EstadoBoleto::Pagado,
            'fecha_pago' => now(),
            'metodo_pago' => $metodoPago,
            'referencia_pago' => $referencia,
        ]);

        return $boleto->fresh();
    }

    /**
     * Anular un boleto existente.
     */
    public function anularBoleto(Boleto $boleto, ?string $observaciones = null): Boleto
    {
        $boleto->update([
            'estado' => EstadoBoleto::Anulado,
            'observaciones' => $observaciones ?? 'Anulado por administrador',
        ]);

        return $boleto->fresh();
    }

    /**
     * Verificar si un contribuyente ya tiene boleto del año fiscal actual.
     */
    public function tieneBoletoVigente(Contribuyente $contribuyente): bool
    {
        $anioFiscal = ConfiguracionMunicipal::anioFiscal();

        return Boleto::where('contribuyente_id', $contribuyente->id)
            ->where('anio_fiscal', $anioFiscal)
            ->whereIn('estado', [EstadoBoleto::Pendiente, EstadoBoleto::Pagado])
            ->exists();
    }

    /**
     * Obtener boleto vigente de un contribuyente.
     */
    public function obtenerBoletoVigente(Contribuyente $contribuyente): ?Boleto
    {
        $anioFiscal = ConfiguracionMunicipal::anioFiscal();

        return Boleto::where('contribuyente_id', $contribuyente->id)
            ->where('anio_fiscal', $anioFiscal)
            ->whereIn('estado', [EstadoBoleto::Pendiente, EstadoBoleto::Pagado])
            ->latest()
            ->first();
    }
}
