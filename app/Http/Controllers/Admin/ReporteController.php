<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\PDFService;
use App\Services\ReporteService;
use Illuminate\Http\Request;

class ReporteController extends Controller
{
    public function __construct(
        protected ReporteService $reporteService,
        protected PDFService $pdfService,
    ) {}

    /**
     * Vista principal de reportes con filtros.
     */
    public function index(Request $request)
    {
        $filtros = $request->only(['fecha_inicio', 'fecha_fin', 'estado', 'anio_fiscal']);
        $datos = null;

        // Solo generar datos si se aplicaron filtros
        if ($request->filled('fecha_inicio') || $request->filled('estado') || $request->filled('anio_fiscal')) {
            $datos = $this->reporteService->generarDatosReporte($filtros);
        }

        return view('admin.reportes.index', compact('filtros', 'datos'));
    }

    /**
     * Exportar reporte en PDF.
     */
    public function generarPdf(Request $request)
    {
        $filtros = $request->only(['fecha_inicio', 'fecha_fin', 'estado', 'anio_fiscal']);
        $datos = $this->reporteService->generarDatosReporte($filtros);

        $pdf = $this->pdfService->generarReportePDF($datos, $filtros);

        return $pdf->download('reporte-boletos-ornato-' . now()->format('Y-m-d') . '.pdf');
    }

    /**
     * Exportar reporte en Excel (CSV).
     */
    public function generarExcel(Request $request)
    {
        $filtros = $request->only(['fecha_inicio', 'fecha_fin', 'estado', 'anio_fiscal']);
        $datos = $this->reporteService->generarDatosReporte($filtros);

        $filename = 'reporte-boletos-ornato-' . now()->format('Y-m-d') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function () use ($datos) {
            $file = fopen('php://output', 'w');

            // BOM para UTF-8 en Excel
            fprintf($file, chr(0xEF) . chr(0xBB) . chr(0xBF));

            // Encabezados
            fputcsv($file, [
                'No. Boleto',
                'DPI',
                'Nombre Completo',
                'Año Fiscal',
                'Monto (Q)',
                'Estado',
                'Fecha Emisión',
                'Fecha Pago',
                'Método Pago',
            ]);

            // Datos
            foreach ($datos['boletos'] as $boleto) {
                fputcsv($file, [
                    $boleto->numero_boleto,
                    $boleto->contribuyente->dpi,
                    $boleto->contribuyente->nombre_completo,
                    $boleto->anio_fiscal,
                    $boleto->monto,
                    $boleto->estado->etiqueta(),
                    $boleto->fecha_emision->format('d/m/Y H:i'),
                    $boleto->fecha_pago ? $boleto->fecha_pago->format('d/m/Y H:i') : 'N/A',
                    $boleto->metodo_pago ?? 'N/A',
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
