@extends('layouts.app')

@section('content')
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Directorio de Contribuyentes</h1>
            <p class="text-sm text-gray-500 mt-1">Administre los ciudadanos registrados en el sistema.</p>
        </div>
    </div>

    <!-- Buscador -->
    <div class="card mb-6">
        <div class="card-body py-4">
            <form action="{{ route('admin.contribuyentes.index') }}" method="GET" class="flex flex-col sm:flex-row gap-4 items-end">
                <div class="flex-1 w-full relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <label for="buscar" class="sr-only">Buscar</label>
                    <input type="text" name="buscar" id="buscar" value="{{ request('buscar') }}" class="form-input pl-10 py-2.5" placeholder="Buscar por DPI, nombre o apellido...">
                </div>
                <div class="flex gap-2 w-full sm:w-auto">
                    <button type="submit" class="btn-primary py-2.5 px-6 w-full sm:w-auto">Buscar</button>
                    @if(request()->filled('buscar'))
                        <a href="{{ route('admin.contribuyentes.index') }}" class="btn-secondary py-2.5 px-4">Limpiar</a>
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
                        <th>DPI</th>
                        <th>Nombre Completo</th>
                        <th>Municipio / Depto</th>
                        <th>Contacto</th>
                        <th class="text-center">Boletos</th>
                        <th class="text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($contribuyentes as $contribuyente)
                        <tr>
                            <td class="font-bold text-gray-900">{{ $contribuyente->dpi }}</td>
                            <td class="font-medium">{{ $contribuyente->nombre_completo }}</td>
                            <td class="text-sm text-gray-600">
                                {{ $contribuyente->municipio }}<br>
                                <span class="text-xs text-gray-400">{{ $contribuyente->departamento }}</span>
                            </td>
                            <td class="text-sm text-gray-600">
                                <div>{{ $contribuyente->telefono ?? 'S/T' }}</div>
                                <div class="text-xs text-gray-400 truncate max-w-[150px]" title="{{ $contribuyente->email }}">{{ $contribuyente->email ?? 'S/E' }}</div>
                            </td>
                            <td class="text-center">
                                <span class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-blue-800 bg-blue-100 rounded-full">
                                    {{ $contribuyente->boletos_count }}
                                </span>
                            </td>
                            <td class="text-right space-x-2">
                                <a href="{{ route('admin.contribuyentes.show', $contribuyente) }}" class="text-primary-600 hover:text-primary-900 font-medium text-sm">Ver Detalle</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-10 text-center text-gray-500">
                                <div class="flex flex-col items-center">
                                    <svg class="w-10 h-10 text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                    <p>No se encontraron contribuyentes.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($contribuyentes->hasPages())
            <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
                {{ $contribuyentes->links() }}
            </div>
        @endif
    </div>
@endsection
