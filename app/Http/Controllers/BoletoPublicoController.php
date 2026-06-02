<?php

namespace App\Http\Controllers;

use App\Http\Requests\BuscarContribuyenteRequest;
use App\Http\Requests\ProcesarPagoRequest;
use App\Http\Requests\RegistrarContribuyenteRequest;
use App\Models\Boleto;
use App\Models\ConfiguracionMunicipal;
use App\Services\BoletoService;
use App\Services\ContribuyenteService;
use App\Services\PDFService;

class BoletoPublicoController extends Controller
{
    public function __construct(
        protected BoletoService $boletoService,
        protected ContribuyenteService $contribuyenteService,
        protected PDFService $pdfService,
    ) {}

    /**
     * Paso 1: Formulario de búsqueda por DPI.
     */
    public function buscarDpi()
    {
        return view('public.boleto.buscar-dpi');
    }

    /**
     * Paso 2: Verificar si el DPI ya existe o es nuevo.
     */
    public function verificarDpi(BuscarContribuyenteRequest $request)
    {
        $dpi = $request->validated()['dpi'];
        $contribuyente = $this->contribuyenteService->buscarPorDpi($dpi);

        // Si ya existe, verificar si tiene boleto vigente
        if ($contribuyente) {
            $boletoVigente = $this->boletoService->obtenerBoletoVigente($contribuyente);

            if ($boletoVigente) {
                return redirect()->route('boleto.resumen', $boletoVigente->codigo_verificacion)
                    ->with('info', 'Ya tiene un boleto generado para el año fiscal actual.');
            }
        }

        return redirect()->route('boleto.registrar', ['dpi' => $dpi]);
    }

    /**
     * Paso 3: Formulario de registro de datos personales (o prellenado si ya existe).
     */
    public function registrar(string $dpi)
    {
        $contribuyente = $this->contribuyenteService->buscarPorDpi($dpi);

        return view('public.boleto.registrar', [
            'dpi' => $dpi,
            'contribuyente' => $contribuyente,
        ]);
    }

    /**
     * Paso 4: Guardar datos del contribuyente y generar boleto.
     */
    public function guardarContribuyente(RegistrarContribuyenteRequest $request)
    {
        $datos = $request->validated();
        $contribuyente = $this->contribuyenteService->crearOActualizar($datos);

        // Generar boleto
        $boleto = $this->boletoService->generarBoleto(
            $contribuyente,
            (float) $datos['ingresos_mensuales']
        );

        return redirect()->route('boleto.resumen', $boleto->codigo_verificacion);
    }

    /**
     * Paso 5: Mostrar resumen del boleto (pre-pago o post-pago).
     */
    public function resumen(string $codigo)
    {
        $boleto = Boleto::where('codigo_verificacion', $codigo)
            ->with('contribuyente')
            ->firstOrFail();

        $config = ConfiguracionMunicipal::obtener();

        return view('public.boleto.resumen', compact('boleto', 'config'));
    }

    /**
     * Paso 6: Procesar el pago del boleto.
     */
    public function procesarPago(ProcesarPagoRequest $request, string $codigo)
    {
        $boleto = Boleto::where('codigo_verificacion', $codigo)
            ->pendientes()
            ->firstOrFail();

        $datos = $request->validated();

        $this->boletoService->procesarPago(
            $boleto,
            $datos['metodo_pago'],
            $datos['referencia_pago'] ?? null
        );

        return redirect()->route('boleto.confirmacion', $boleto->codigo_verificacion)
            ->with('success', '¡Pago procesado exitosamente!');
    }

    /**
     * Paso 7: Confirmación de pago con opción de descarga.
     */
    public function confirmacion(string $codigo)
    {
        $boleto = Boleto::where('codigo_verificacion', $codigo)
            ->with('contribuyente')
            ->firstOrFail();

        $config = ConfiguracionMunicipal::obtener();

        return view('public.boleto.confirmacion', compact('boleto', 'config'));
    }

    /**
     * Descargar PDF del boleto.
     */
    public function descargar(string $codigo)
    {
        $boleto = Boleto::where('codigo_verificacion', $codigo)
            ->with('contribuyente')
            ->firstOrFail();

        $pdf = $this->pdfService->generarBoletoPDF($boleto);

        return $pdf->download("boleto-ornato-{$boleto->numero_boleto}.pdf");
    }

    /**
     * Verificar boleto mediante código QR / código de verificación.
     * Ruta pública: /verificar/{codigo}
     */
    public function verificar(string $codigo)
    {
        $boleto = Boleto::where('codigo_verificacion', $codigo)
            ->with('contribuyente')
            ->first();

        $config = ConfiguracionMunicipal::obtener();

        return view('public.boleto.verificar', [
            'boleto' => $boleto,
            'config' => $config,
            'encontrado' => $boleto !== null,
        ]);
    }
}
