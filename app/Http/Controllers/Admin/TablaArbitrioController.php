<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TablaArbitrioRequest;
use App\Models\TablaArbitrio;

class TablaArbitrioController extends Controller
{
    /**
     * Listado de rangos de arbitrios.
     */
    public function index()
    {
        $arbitrios = TablaArbitrio::ordenados()->get();

        return view('admin.tabla-arbitrios.index', compact('arbitrios'));
    }

    /**
     * Formulario para crear nuevo rango.
     */
    public function create()
    {
        return view('admin.tabla-arbitrios.create');
    }

    /**
     * Guardar nuevo rango.
     */
    public function store(TablaArbitrioRequest $request)
    {
        TablaArbitrio::create($request->validated());

        return redirect()->route('admin.tabla-arbitrios.index')
            ->with('success', 'Rango de arbitrio creado exitosamente.');
    }

    /**
     * Formulario de edición.
     */
    public function edit(TablaArbitrio $tablaArbitrio)
    {
        return view('admin.tabla-arbitrios.edit', ['arbitrio' => $tablaArbitrio]);
    }

    /**
     * Actualizar rango.
     */
    public function update(TablaArbitrioRequest $request, TablaArbitrio $tablaArbitrio)
    {
        $tablaArbitrio->update($request->validated());

        return redirect()->route('admin.tabla-arbitrios.index')
            ->with('success', 'Rango de arbitrio actualizado exitosamente.');
    }

    /**
     * Eliminar rango.
     */
    public function destroy(TablaArbitrio $tablaArbitrio)
    {
        $tablaArbitrio->delete();

        return redirect()->route('admin.tabla-arbitrios.index')
            ->with('success', 'Rango de arbitrio eliminado exitosamente.');
    }
}
