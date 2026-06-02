@extends('layouts.app')

@section('content')
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-900">Dashboard General</h1>
        <p class="text-sm text-gray-500 mt-1">Resumen estadístico de emisión y recaudación.</p>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        
        <div class="stat-card">
            <div class="stat-icon bg-blue-100 text-blue-600">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            </div>
            <div>
                <p class="stat-label">Total Emitidos</p>
                <p class="stat-value">{{ number_format($estadisticas['total_emitidos']) }}</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon bg-green-100 text-green-600">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <div>
                <p class="stat-label">Total Recaudado</p>
                <p class="stat-value text-green-600">Q {{ number_format($estadisticas['total_recaudado'], 2) }}</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon bg-purple-100 text-purple-600">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            </div>
            <div>
                <p class="stat-label">Boletos del Mes</p>
                <p class="stat-value">{{ number_format($estadisticas['boletos_mes']) }}</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon bg-yellow-100 text-yellow-600">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <div>
                <p class="stat-label">Boletos del Día</p>
                <p class="stat-value">{{ number_format($estadisticas['boletos_dia']) }}</p>
            </div>
        </div>
    </div>

    <!-- Additional Info Cards -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Estado de Boletos -->
        <div class="card">
            <div class="card-header">
                <h3 class="font-bold text-gray-800">Estado de Boletos Emitidos</h3>
            </div>
            <div class="card-body">
                <div class="flex flex-col gap-4">
                    <div class="flex items-center justify-between p-3 bg-green-50 rounded-lg border border-green-100">
                        <div class="flex items-center gap-3">
                            <span class="w-3 h-3 rounded-full bg-green-500"></span>
                            <span class="font-medium text-gray-700">Pagados</span>
                        </div>
                        <span class="font-bold text-gray-900">{{ number_format($estadisticas['pagados']) }}</span>
                    </div>

                    <div class="flex items-center justify-between p-3 bg-yellow-50 rounded-lg border border-yellow-100">
                        <div class="flex items-center gap-3">
                            <span class="w-3 h-3 rounded-full bg-yellow-500"></span>
                            <span class="font-medium text-gray-700">Pendientes de Pago</span>
                        </div>
                        <span class="font-bold text-gray-900">{{ number_format($estadisticas['pendientes']) }}</span>
                    </div>

                    <div class="flex items-center justify-between p-3 bg-red-50 rounded-lg border border-red-100">
                        <div class="flex items-center gap-3">
                            <span class="w-3 h-3 rounded-full bg-red-500"></span>
                            <span class="font-medium text-gray-700">Anulados</span>
                        </div>
                        <span class="font-bold text-gray-900">{{ number_format($estadisticas['anulados']) }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Accesos Rápidos -->
        <div class="card">
            <div class="card-header">
                <h3 class="font-bold text-gray-800">Accesos Rápidos</h3>
            </div>
            <div class="card-body">
                <div class="grid grid-cols-2 gap-4">
                    <a href="{{ route('admin.boletos.create') }}" class="flex flex-col items-center justify-center p-6 border-2 border-dashed border-gray-300 rounded-lg hover:bg-gray-50 hover:border-primary-500 transition-colors group">
                        <div class="w-12 h-12 bg-primary-50 text-primary-600 rounded-full flex items-center justify-center mb-3 group-hover:bg-primary-100">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                        </div>
                        <span class="text-sm font-medium text-gray-700 group-hover:text-primary-700">Generar Boleto Manual</span>
                    </a>
                    
                    <a href="{{ route('admin.reportes.index') }}" class="flex flex-col items-center justify-center p-6 border-2 border-dashed border-gray-300 rounded-lg hover:bg-gray-50 hover:border-primary-500 transition-colors group">
                        <div class="w-12 h-12 bg-green-50 text-green-600 rounded-full flex items-center justify-center mb-3 group-hover:bg-green-100">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        </div>
                        <span class="text-sm font-medium text-gray-700 group-hover:text-primary-700">Generar Reporte</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
