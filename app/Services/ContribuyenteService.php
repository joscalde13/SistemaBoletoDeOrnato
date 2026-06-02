<?php

namespace App\Services;

use App\Models\Contribuyente;

class ContribuyenteService
{
    /**
     * Buscar contribuyente por DPI.
     */
    public function buscarPorDpi(string $dpi): ?Contribuyente
    {
        return Contribuyente::buscarPorDpi($dpi)->first();
    }

    /**
     * Crear o actualizar un contribuyente con los datos proporcionados.
     */
    public function crearOActualizar(array $datos): Contribuyente
    {
        return Contribuyente::updateOrCreate(
            ['dpi' => $datos['dpi']],
            $datos
        );
    }

    /**
     * Actualizar datos de un contribuyente existente.
     */
    public function actualizar(Contribuyente $contribuyente, array $datos): Contribuyente
    {
        $contribuyente->update($datos);
        return $contribuyente->fresh();
    }
}
