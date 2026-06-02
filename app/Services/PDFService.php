<?php

namespace App\Services;

use App\Models\Boleto;
use App\Models\ConfiguracionMunicipal;
use Barryvdh\DomPDF\Facade\Pdf;

class PDFService
{
    /**
     * Generar el PDF del boleto de ornato.
     * Retorna la respuesta HTTP con el PDF para descarga.
     */
    public function generarBoletoPDF(Boleto $boleto)
    {
        $boleto->load('contribuyente');
        $config = ConfiguracionMunicipal::obtener();

        // URL de verificación para el QR
        $urlVerificacion = route('boleto.verificar', $boleto->codigo_verificacion);
        
        // Generar QR en Base64 usando BaconQrCode (instalado por Fortify)
        $renderer = new \BaconQrCode\Renderer\ImageRenderer(
            new \BaconQrCode\Renderer\RendererStyle\RendererStyle(150),
            new \BaconQrCode\Renderer\Image\SvgImageBackEnd()
        );
        $writer = new \BaconQrCode\Writer($renderer);
        $qrCodeSvg = $writer->writeString($urlVerificacion);
        $qrCodeBase64 = base64_encode($qrCodeSvg);

        $pdf = Pdf::loadView('pdf.boleto-pdf', [
            'boleto' => $boleto,
            'contribuyente' => $boleto->contribuyente,
            'config' => $config,
            'urlVerificacion' => $urlVerificacion,
            'qrCodeBase64' => $qrCodeBase64,
        ]);

        $pdf->setPaper('letter', 'portrait');

        return $pdf;
    }

    /**
     * Generar PDF de reporte de boletos.
     */
    public function generarReportePDF(array $datos, array $filtros = [])
    {
        $config = ConfiguracionMunicipal::obtener();

        // Mapeo compatible para la vista: algunas plantillas esperan 'resumen'
        $resumen = [
            'total_boletos' => $datos['estadisticas']['total'] ?? ($datos['boletos']->count() ?? 0),
            'monto_total' => $datos['estadisticas']['total_recaudado'] ?? 0,
        ];

        $pdf = Pdf::loadView('pdf.reporte-boletos', [
            'boletos' => $datos['boletos'],
            'estadisticas' => $datos['estadisticas'],
            'resumen' => $resumen,
            'filtros' => $filtros,
            'config' => $config,
        ]);

        $pdf->setPaper('letter', 'landscape');

        return $pdf;
    }
}
