@extends('layouts.app')

@section('content')
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Tabla de Arbitrios</h1>
            <p class="text-sm text-gray-500 mt-1">Gestión de rangos de ingresos y montos según la Ley de Arbitrio de Ornato.</p>
        </div>
        <a href="{{ route('admin.tabla-arbitrios.create') }}" class="btn-primary">
            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
            Nuevo Rango
        </a>
    </div>

    <!-- Info Alert -->
    <div class="alert-info mb-6">
        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        <div>
            <span class="font-bold block mb-1">Base Legal: Decreto 121-96 del Congreso de la República</span>
            <span class="text-sm">El sistema utiliza estos rangos activos para calcular automáticamente el monto a pagar basándose en los ingresos mensuales declarados por el ciudadano.</span>
        </div>
    </div>

    <!-- Tabla -->
    <div class="card">
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>Descripción</th>
                        <th class="text-right">De (Q)</th>
                        <th class="text-right">Hasta (Q)</th>
                        <th class="text-right font-bold text-primary-700">Monto Arbitrio (Q)</th>
                        <th class="text-center">Estado</th>
                        <th class="text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($arbitrios as $arbitrio)
                        <tr class="{{ !$arbitrio->activo ? 'bg-gray-50 opacity-75' : '' }}">
                            <td class="font-medium text-gray-900">{{ $arbitrio->descripcion ?? 'Rango '.$loop->iteration }}</td>
                            <td class="text-right text-gray-600">{{ number_format($arbitrio->rango_inicio, 2) }}</td>
                            <td class="text-right text-gray-600">{{ number_format($arbitrio->rango_fin, 2) }}</td>
                            <td class="text-right font-bold text-gray-900 text-lg">{{ number_format($arbitrio->monto, 2) }}</td>
                            <td class="text-center">
                                @if($arbitrio->activo)
                                    <span class="badge bg-green-100 text-green-800 border border-green-200">Activo</span>
                                @else
                                    <span class="badge bg-red-100 text-red-800 border border-red-200">Inactivo</span>
                                @endif
                            </td>
                            <td class="text-right space-x-2">
                                <a href="{{ route('admin.tabla-arbitrios.edit', $arbitrio) }}" class="text-primary-600 hover:text-primary-900 font-medium text-sm">Editar</a>
                                <form action="{{ route('admin.tabla-arbitrios.destroy', $arbitrio) }}" method="POST" class="inline" onsubmit="return confirm('¿Está seguro de desactivar este rango? No se recomienda eliminar rangos históricos.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 font-medium text-sm {{ !$arbitrio->activo ? 'hidden' : '' }}">Desactivar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-10 text-center text-gray-500">
                                <p>No hay rangos configurados en la tabla de arbitrios.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
