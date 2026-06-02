<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contribuyente;
use App\Services\ContribuyenteService;
use Illuminate\Http\Request;

class ContribuyenteAdminController extends Controller
{
    public function __construct(
        protected ContribuyenteService $contribuyenteService,
    ) {}

    /**
     * Listado de contribuyentes con búsqueda.
     */
    public function index(Request $request)
    {
        $query = Contribuyente::withCount('boletos')->latest();

        if ($request->filled('buscar')) {
            $query->buscar($request->buscar);
        }

        $contribuyentes = $query->paginate(15)->withQueryString();

        return view('admin.contribuyentes.index', compact('contribuyentes'));
    }

    /**
     * Detalle de un contribuyente con sus boletos.
     */
    public function show(Contribuyente $contribuyente)
    {
        $contribuyente->load('boletos');

        return view('admin.contribuyentes.show', compact('contribuyente'));
    }

    /**
     * Formulario de edición.
     */
    public function edit(Contribuyente $contribuyente)
    {
        return view('admin.contribuyentes.edit', compact('contribuyente'));
    }

    /**
     * Actualizar datos del contribuyente.
     */
    public function update(Request $request, Contribuyente $contribuyente)
    {
        $datos = $request->validate([
            'primer_nombre' => 'required|string|max:100',
            'segundo_nombre' => 'nullable|string|max:100',
            'primer_apellido' => 'required|string|max:100',
            'segundo_apellido' => 'nullable|string|max:100',
            'fecha_nacimiento' => 'required|date|before:today',
            'genero' => 'required|in:M,F',
            'direccion' => 'required|string|max:500',
            'municipio' => 'required|string|max:100',
            'departamento' => 'required|string|max:100',
            'telefono' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:150',
            'nit' => 'nullable|string|max:20',
        ]);

        $this->contribuyenteService->actualizar($contribuyente, $datos);

        return redirect()->route('admin.contribuyentes.show', $contribuyente)
            ->with('success', 'Contribuyente actualizado exitosamente.');
    }

    /**
     * Eliminar contribuyente (soft delete).
     */
    public function destroy(Contribuyente $contribuyente)
    {
        $contribuyente->delete();

        return redirect()->route('admin.contribuyentes.index')
            ->with('success', 'Contribuyente eliminado exitosamente.');
    }
}
