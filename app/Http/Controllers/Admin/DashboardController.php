<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ReporteService;

class DashboardController extends Controller
{
    public function __construct(
        protected ReporteService $reporteService,
    ) {}

    /**
     * Dashboard administrativo con métricas principales.
     */
    public function index()
    {
        $estadisticas = $this->reporteService->obtenerEstadisticas();

        return view('admin.dashboard', compact('estadisticas'));
    }
}
