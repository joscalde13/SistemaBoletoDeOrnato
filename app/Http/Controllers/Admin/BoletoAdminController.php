<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Boleto;
use App\Models\Contribuyente;
use App\Services\BoletoService;
use App\Services\PDFService;
use Illuminate\Http\Request;

class BoletoAdminController extends Controller
{
    public function __construct(
        protected BoletoService $boletoService,
        protected PDFService $pdfService,
    ) {}

    /**
     * Listado de boletos con filtros y paginación.
     */
    public function index(Request $request)
    {
        $query = Boleto::with('contribuyente')->latest('fecha_emision');

        // Filtros
        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        if ($request->filled('buscar')) {
            $buscar = $request->buscar;
            $query->where(function ($q) use ($buscar) {
                $q->where('numero_boleto', 'like', "%{$buscar}%")
                  ->orWhereHas('contribuyente', function ($q2) use ($buscar) {
                      $q2->where('dpi', 'like', "%{$buscar}%")
                         ->orWhere('primer_nombre', 'like', "%{$buscar}%")
                         ->orWhere('primer_apellido', 'like', "%{$buscar}%");
                  });
            });
        }

        if ($request->filled('fecha_inicio')) {
            $query->whereDate('fecha_emision', '>=', $request->fecha_inicio);
        }

        if ($request->filled('fecha_fin')) {
            $query->whereDate('fecha_emision', '<=', $request->fecha_fin);
        }

        $boletos = $query->paginate(15)->withQueryString();

        return view('admin.boletos.index', compact('boletos'));
    }

    /**
     * Detalle de un boleto.
     */
    public function show(Boleto $boleto)
    {
        $boleto->load('contribuyente', 'emisor');

        return view('admin.boletos.show', compact('boleto'));
    }

    /**
     * Formulario para crear boleto manualmente.
     */
    public function create()
    {
        $contribuyentes = Contribuyente::orderBy('primer_apellido')->get();

        return view('admin.boletos.create', compact('contribuyentes'));
    }

    /**
     * Guardar nuevo boleto (creación manual desde admin).
     */
    public function store(Request $request)
    {
        $request->validate([
            'contribuyente_id' => 'required|exists:contribuyentes,id',
            'ingresos_mensuales' => 'required|numeric|min:0',
        ]);

        $contribuyente = Contribuyente::findOrFail($request->contribuyente_id);

        $boleto = $this->boletoService->generarBoleto(
            $contribuyente,
            (float) $request->ingresos_mensuales,
            auth()->id()
        );

        return redirect()->route('admin.boletos.show', $boleto)
            ->with('success', 'Boleto generado exitosamente: ' . $boleto->numero_boleto);
    }

    /**
     * Anular un boleto.
     */
    public function anular(Boleto $boleto, Request $request)
    {
        $this->authorize('anular', $boleto);

        $this->boletoService->anularBoleto($boleto, $request->observaciones);

        return redirect()->route('admin.boletos.index')
            ->with('success', 'Boleto anulado exitosamente.');
    }

    /**
     * Descargar PDF individual de un boleto.
     */
    public function descargarPdf(Boleto $boleto)
    {
        $pdf = $this->pdfService->generarBoletoPDF($boleto);

        return $pdf->download("boleto-{$boleto->numero_boleto}.pdf");
    }

    /**
     * Eliminar boleto (soft delete).
     */
    public function destroy(Boleto $boleto)
    {
        $boleto->delete();

        return redirect()->route('admin.boletos.index')
            ->with('success', 'Boleto eliminado exitosamente.');
    }
}
