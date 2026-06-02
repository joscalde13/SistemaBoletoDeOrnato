@extends('layouts.app')

@section('content')
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Reportes de Recaudación</h1>
            <p class="text-sm text-gray-500 mt-1">Generación de informes estadísticos y financieros.</p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Generador de Reportes -->
        <div class="card">
            <div class="card-header bg-gradient-primary text-white">
                <h3 class="font-bold flex items-center gap-2">
                    <svg class="w-5 h-5 text-primary-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    Parámetros del Reporte
                </h3>
            </div>
            <div class="card-body">
                <form id="form-reporte" method="POST" target="_blank">
                    @csrf
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
                        <div class="form-group mb-0">
                            <label for="fecha_inicio" class="form-label">Fecha de Inicio</label>
                            <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-input" value="{{ now()->startOfMonth()->format('Y-m-d') }}" required>
                        </div>
                        <div class="form-group mb-0">
                            <label for="fecha_fin" class="form-label">Fecha Final</label>
                            <input type="date" name="fecha_fin" id="fecha_fin" class="form-input" value="{{ now()->endOfMonth()->format('Y-m-d') }}" required>
                        </div>
                    </div>

                    <div class="form-group mb-6">
                        <label for="estado" class="form-label">Estado de los Boletos</label>
                        <select name="estado" id="estado" class="form-select w-full">
                            <option value="">Todos los estados</option>
                            <option value="pagado" selected>Solo Pagados (Recaudación Efectiva)</option>
                            <option value="pendiente">Solo Pendientes</option>
                            <option value="anulado">Solo Anulados</option>
                        </select>
                    </div>

                    <div class="pt-6 border-t border-gray-100 flex flex-col sm:flex-row gap-3">
                        <button type="submit" formaction="{{ route('admin.reportes.pdf') }}" class="btn-primary flex-1 justify-center">
                            <svg class="w-5 h-5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                            Generar PDF
                        </button>
                        <!-- Descomentar cuando exista la funcionalidad Excel
                        <button type="submit" formaction="{{ route('admin.reportes.excel') }}" class="btn-success flex-1 justify-center">
                            <svg class="w-5 h-5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            Exportar Excel
                        </button>
                        -->
                    </div>
                </form>
            </div>
        </div>

        <!-- Info Card -->
        <div class="card bg-gray-50 border-dashed">
            <div class="card-body flex flex-col items-center justify-center text-center h-full py-12">
                <div class="w-16 h-16 bg-white shadow-sm rounded-full flex items-center justify-center mb-4 text-primary-500">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h3 class="font-bold text-gray-900 mb-2">Información del Reporte</h3>
                <p class="text-sm text-gray-600 mb-4 px-4">El reporte generado incluirá un resumen de la recaudación total en el período seleccionado, así como el listado detallado de todos los boletos emitidos que coincidan con los criterios de búsqueda.</p>
                <div class="text-xs text-gray-500 bg-white px-3 py-1.5 rounded border border-gray-200">
                    Último año fiscal: <strong>{{ \App\Models\ConfiguracionMunicipal::anioFiscal() }}</strong>
                </div>
            </div>
        </div>
    </div>
@endsection
