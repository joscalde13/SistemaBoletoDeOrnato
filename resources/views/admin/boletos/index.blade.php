@extends('layouts.app')

@section('content')
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Gestión de Boletos</h1>
            <p class="text-sm text-gray-500 mt-1">Administre los boletos de ornato emitidos.</p>
        </div>
        <a href="{{ route('admin.boletos.create') }}" class="btn-primary">
            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
            Nuevo Boleto Manual
        </a>
    </div>

    <!-- Filtros -->
    <div class="card mb-6">
        <div class="card-body py-4">
            <form action="{{ route('admin.boletos.index') }}" method="GET" class="flex flex-col md:flex-row gap-4 items-end">
                <div class="flex-1 w-full">
                    <label for="buscar" class="form-label text-xs">Buscar (DPI, Nombre o No. Boleto)</label>
                    <input type="text" name="buscar" id="buscar" value="{{ request('buscar') }}" class="form-input py-2" placeholder="Ej. 1234567890123">
                </div>
               
                <div class="flex gap-2 w-full md:w-auto">
                    <button type="submit" class="btn-primary py-2 w-full md:w-auto">Filtrar</button>
                    @if(request()->hasAny(['buscar', 'estado']))
                        <a href="{{ route('admin.boletos.index') }}" class="btn-secondary py-2">Limpiar</a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <!-- Tabla -->
    <div class="card">
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>No. Boleto</th>
                        <th>Contribuyente</th>
                        <th>DPI</th>
                        <th>Monto</th>
                        <th>Fecha Emisión</th>
                      
                        <th class="text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($boletos as $boleto)
                        <tr>
                            <td class="font-medium text-gray-900">{{ $boleto->numero_boleto }}</td>
                            <td>{{ $boleto->contribuyente->nombre_completo }}</td>
                            <td class="text-gray-500">{{ $boleto->contribuyente->dpi }}</td>
                            <td class="font-semibold text-gray-900">Q {{ number_format($boleto->monto, 2) }}</td>
                            <td class="text-gray-500 text-sm">{{ $boleto->fecha_emision->format('d/m/Y') }}</td>
                            
                            <td class="text-right space-x-2">
                                <a href="{{ route('admin.boletos.show', $boleto) }}" class="text-primary-600 hover:text-primary-900 font-medium text-sm">Ver</a>
                                @if($boleto)
                                    <span class="text-gray-300">|</span>
                                    <a href="{{ route('admin.boletos.pdf', $boleto) }}" class="text-green-600 hover:text-green-900 font-medium text-sm">PDF</a>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-10 text-center text-gray-500">
                                <div class="flex flex-col items-center">
                                    <svg class="w-10 h-10 text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                    <p>No se encontraron boletos que coincidan con los filtros.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($boletos->hasPages())
            <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
                {{ $boletos->links() }}
            </div>
        @endif
    </div>
@endsection
