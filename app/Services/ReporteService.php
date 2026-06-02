<?php

namespace App\Services;

use App\Enums\EstadoBoleto;
use App\Models\Boleto;

class ReporteService
{
    /**
     * Obtener estadísticas para el dashboard administrativo.
     */
    public function obtenerEstadisticas(): array
    {
        return [
            'total_emitidos' => Boleto::count(),
            'total_recaudado' => Boleto::pagados()->sum('monto'),
            'boletos_dia' => Boleto::delDia()->count(),
            'boletos_mes' => Boleto::delMes()->count(),
            'pendientes' => Boleto::pendientes()->count(),
            'pagados' => Boleto::pagados()->count(),
            'anulados' => Boleto::anulados()->count(),
            'recaudado_mes' => Boleto::delMes()->pagados()->sum('monto'),
        ];
    }

    /**
     * Obtener boletos filtrados para reportes.
     */
    public function obtenerBoletosReporte(array $filtros = [])
    {
        $query = Boleto::with('contribuyente');

        if (!empty($filtros['fecha_inicio'])) {
            $query->whereDate('fecha_emision', '>=', $filtros['fecha_inicio']);
        }

        if (!empty($filtros['fecha_fin'])) {
            $query->whereDate('fecha_emision', '<=', $filtros['fecha_fin']);
        }

        if (!empty($filtros['estado'])) {
            $query->where('estado', $filtros['estado']);
        }

        if (!empty($filtros['anio_fiscal'])) {
            $query->where('anio_fiscal', $filtros['anio_fiscal']);
        }

        return $query->orderBy('fecha_emision', 'desc')->get();
    }

    /**
     * Obtener datos completos para un reporte.
     */
    public function generarDatosReporte(array $filtros = []): array
    {
        $boletos = $this->obtenerBoletosReporte($filtros);

        return [
            'boletos' => $boletos,
            'estadisticas' => [
                'total' => $boletos->count(),
                'total_recaudado' => $boletos->where('estado', EstadoBoleto::Pagado)->sum('monto'),
                'pagados' => $boletos->where('estado', EstadoBoleto::Pagado)->count(),
                'pendientes' => $boletos->where('estado', EstadoBoleto::Pendiente)->count(),
                'anulados' => $boletos->where('estado', EstadoBoleto::Anulado)->count(),
            ],
        ];
    }
}
