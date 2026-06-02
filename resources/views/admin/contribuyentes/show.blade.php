@extends('layouts.app')

@section('content')
    <div class="mb-6 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.contribuyentes.index') }}" class="text-gray-500 hover:text-gray-900 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Perfil del Contribuyente</h1>
            </div>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('admin.contribuyentes.edit', $contribuyente) }}" class="btn-secondary">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                Editar Perfil
            </a>
            <a href="{{ route('admin.boletos.create', ['contribuyente_id' => $contribuyente->id]) }}" class="btn-primary">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                Generar Boleto
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Detalles Principales -->
        <div class="lg:col-span-1 space-y-6">
            <div class="card">
                <div class="card-body text-center pt-8">
                    <div class="w-24 h-24 bg-primary-100 text-primary-700 rounded-full flex items-center justify-center font-bold text-3xl mx-auto mb-4">
                        {{ substr($contribuyente->primer_nombre, 0, 1) }}{{ substr($contribuyente->primer_apellido, 0, 1) }}
                    </div>
                    <h2 class="text-xl font-bold text-gray-900">{{ $contribuyente->nombre_completo }}</h2>
                    <p class="text-gray-500 mb-4">DPI: <span class="font-bold text-gray-700">{{ $contribuyente->dpi }}</span></p>
                    
                    <div class="inline-flex items-center gap-1.5 px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-sm font-medium mb-6">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        Registrado el {{ $contribuyente->created_at->format('d/m/Y') }}
                    </div>

                    <div class="border-t border-gray-100 pt-6 mt-2">
                        <dl class="space-y-4 text-left">
                            <div>
                                <dt class="text-xs text-gray-500 uppercase font-semibold flex items-center gap-1.5">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    Ingresos Mensuales
                                </dt>
                                <dd class="text-lg font-bold text-gray-900 mt-1">Q {{ number_format($contribuyente->ingresos_mensuales, 2) }}</dd>
                            </div>
                            <div>
                                <dt class="text-xs text-gray-500 uppercase font-semibold">NIT</dt>
                                <dd class="text-sm font-medium text-gray-900 mt-1">{{ $contribuyente->nit ?? 'No registrado' }}</dd>
                            </div>
                            <div>
                                <dt class="text-xs text-gray-500 uppercase font-semibold">Fecha de Nacimiento</dt>
                                <dd class="text-sm text-gray-900 mt-1">
                                    {{ $contribuyente->fecha_nacimiento ? $contribuyente->fecha_nacimiento->format('d/m/Y') . ' (' . $contribuyente->fecha_nacimiento->age . ' años)' : 'No registrada' }}
                                </dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="font-bold text-gray-800">Contacto y Ubicación</h3>
                </div>
                <div class="card-body">
                    <dl class="space-y-4">
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-gray-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            <div>
                                <dt class="sr-only">Dirección</dt>
                                <dd class="text-sm text-gray-900">{{ $contribuyente->direccion }}</dd>
                                <dd class="text-sm text-gray-600">{{ $contribuyente->municipio }}, {{ $contribuyente->departamento }}</dd>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            <dt class="sr-only">Teléfono</dt>
                            <dd class="text-sm text-gray-900">{{ $contribuyente->telefono ?? 'No registrado' }}</dd>
                        </div>
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            <dt class="sr-only">Email</dt>
                            <dd class="text-sm text-gray-900 break-all">{{ $contribuyente->email ?? 'No registrado' }}</dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>

        <!-- Historial de Boletos -->
        <div class="lg:col-span-2">
            <div class="card h-full">
                <div class="card-header flex justify-between items-center">
                    <h3 class="font-bold text-gray-800">Historial de Boletos de Ornato</h3>
                    <span class="badge bg-blue-100 text-blue-800">{{ $contribuyente->boletos->count() }} Emitidos</span>
                </div>
                
                @if($contribuyente->boletos->count() > 0)
                    <div class="table-container border-0 rounded-none rounded-b-xl">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Año</th>
                                    <th>No. Boleto</th>
                                    <th>Monto</th>
                                    <th>Estado</th>
                                    <th class="text-right">Acción</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach($contribuyente->boletos->sortByDesc('anio_fiscal') as $boleto)
                                    <tr>
                                        <td class="font-bold text-gray-900">{{ $boleto->anio_fiscal }}</td>
                                        <td class="text-gray-600 font-mono text-sm">{{ $boleto->numero_boleto }}</td>
                                        <td class="font-medium text-gray-900">Q {{ number_format($boleto->monto, 2) }}</td>
                                        <td>
                                            <span class="badge {{ $boleto->estado->claseCss() }} text-xs">
                                                {{ mb_strtoupper($boleto->estado->etiqueta()) }}
                                            </span>
                                        </td>
                                        <td class="text-right">
                                            <a href="{{ route('admin.boletos.show', $boleto) }}" class="btn-secondary btn-sm">Ver Detalle</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="card-body text-center py-12">
                        <div class="w-16 h-16 bg-gray-50 text-gray-400 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900">Sin Historial</h3>
                        <p class="text-gray-500 mt-1">Este contribuyente aún no tiene boletos registrados.</p>
                        <div class="mt-6">
                            <a href="{{ route('admin.boletos.create', ['contribuyente_id' => $contribuyente->id]) }}" class="btn-primary">
                                Generar Primer Boleto
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
