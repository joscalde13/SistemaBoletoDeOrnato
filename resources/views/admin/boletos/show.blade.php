@extends('layouts.app')

@section('content')
    <div class="mb-6 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.boletos.index') }}" class="text-gray-500 hover:text-gray-900 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <h1 class="text-2xl font-bold text-gray-900">Detalle de Boleto <span class="text-primary-600">#{{ $boleto->numero_boleto }}</span></h1>
        </div>
        <a href="{{ route('admin.boletos.pdf', $boleto) }}" class="btn-success">
    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4">
        </path>
    </svg>
    Descargar PDF
</a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Detalles Principales -->
        <div class="lg:col-span-2 space-y-6">
            <div class="card">
                <div class="card-header flex justify-between items-center">
                    <h3 class="font-bold text-gray-800">Información del Documento</h3>
                    
                </div>
                <div class="card-body">
                    <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-4 gap-y-6">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Monto</dt>
                            <dd class="mt-1 text-2xl font-bold text-gray-900">Q {{ number_format($boleto->monto, 2) }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Año Fiscal</dt>
                            <dd class="mt-1 text-lg font-semibold text-gray-900">{{ $boleto->anio_fiscal }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Fecha de Emisión</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $boleto->fecha_emision->format('d/m/Y H:i:s') }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Emitido por</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $boleto->emisor ? $boleto->emisor->name : 'Autoservicio (Público)' }}</dd>
                        </div>
                        
                        @if($boleto->estaPagado() || $boleto->fecha_pago)
                            <div class="sm:col-span-2 border-t border-gray-100 pt-4 mt-2">
                                <h4 class="text-sm font-bold text-gray-900 mb-4">Detalles del Pago</h4>
                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                    <div>
                                        <dt class="text-xs text-gray-500">Fecha de Pago</dt>
                                        <dd class="mt-1 text-sm font-medium text-gray-900">{{ $boleto->fecha_pago->format('d/m/Y H:i:s') }}</dd>
                                    </div>
                                    <div>
                                        <dt class="text-xs text-gray-500">Método de Pago</dt>
                                        <dd class="mt-1 text-sm font-medium text-gray-900 capitalize">{{ $boleto->metodo_pago ?? 'N/D' }}</dd>
                                    </div>
                                    <div>
                                        <dt class="text-xs text-gray-500">Referencia</dt>
                                        <dd class="mt-1 text-sm font-medium text-gray-900">{{ $boleto->referencia_pago ?? 'N/D' }}</dd>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if($boleto->estaAnulado())
                            <div class="sm:col-span-2 border-t border-red-100 pt-4 mt-2 bg-red-50 p-4 rounded-lg">
                                <dt class="text-sm font-bold text-red-800">Motivo de Anulación</dt>
                                <dd class="mt-1 text-sm text-red-700">{{ $boleto->observaciones }}</dd>
                            </div>
                        @endif
                    </dl>
                </div>
            </div>
        </div>

        <!-- Perfil Contribuyente -->
        <div class="lg:col-span-1">
            <div class="card">
                <div class="card-header">
                    <h3 class="font-bold text-gray-800">Contribuyente</h3>
                </div>
                <div class="card-body">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-12 h-12 bg-primary-100 text-primary-700 rounded-full flex items-center justify-center font-bold text-xl">
                            {{ substr($boleto->contribuyente->primer_nombre, 0, 1) }}{{ substr($boleto->contribuyente->primer_apellido, 0, 1) }}
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900">{{ $boleto->contribuyente->nombre_completo }}</h4>
                            <p class="text-sm text-gray-500">DPI: {{ $boleto->contribuyente->dpi }}</p>
                        </div>
                    </div>
                    
                    <dl class="space-y-4">
                        <div>
                            <dt class="text-xs text-gray-500 uppercase font-semibold">Ingresos Declarados</dt>
                            <dd class="text-sm font-medium text-gray-900">Q {{ number_format($boleto->contribuyente->ingresos_mensuales, 2) }}</dd>
                        </div>
                        <div>
                            <dt class="text-xs text-gray-500 uppercase font-semibold">Dirección</dt>
                            <dd class="text-sm text-gray-900">{{ $boleto->contribuyente->direccion }}</dd>
                            <dd class="text-sm text-gray-600">{{ $boleto->contribuyente->municipio }}, {{ $boleto->contribuyente->departamento }}</dd>
                        </div>
                        <div>
                            <dt class="text-xs text-gray-500 uppercase font-semibold">Contacto</dt>
                            <dd class="text-sm text-gray-900">{{ $boleto->contribuyente->telefono ?? 'Sin teléfono' }}</dd>
                            <dd class="text-sm text-gray-900">{{ $boleto->contribuyente->email ?? 'Sin email' }}</dd>
                        </div>
                    </dl>

                    <div class="mt-6 pt-4 ">
                        <a href="{{ route('admin.contribuyentes.show', $boleto->contribuyente) }}" class="text-primary-600 hover:text-primary-800 text-sm font-medium flex items-center">
                            Ver perfil completo
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="card mt-6">
              
            </div>
        </div>
    </div>

    <!-- Modal Anulación -->
    <div x-data="{ open: false }" x-show="open" @open-modal.window="if ($event.detail === 'confirmar-anulacion') open = true" class="relative z-50" aria-labelledby="modal-title" role="dialog" aria-modal="true" style="display: none;">
        <div x-show="open" x-transition.opacity class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div x-show="open" 
                     x-transition:enter="ease-out duration-300" 
                     x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                     x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" 
                     x-transition:leave="ease-in duration-200" 
                     x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" 
                     x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                     @click.away="open = false"
                     class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                    
                    <form action="{{ route('admin.boletos.anular', $boleto) }}" method="POST">
                        @csrf
                        <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                            <div class="sm:flex sm:items-start">
                                <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                    <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                    </svg>
                                </div>
                                <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left w-full">
                                    <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">Anular Boleto</h3>
                                    <div class="mt-2 text-sm text-gray-500">
                                        <p>¿Está seguro de que desea anular el boleto <strong>{{ $boleto->numero_boleto }}</strong>? Esta acción no se puede deshacer.</p>
                                    </div>
                                    <div class="mt-4">
                                        <label for="observaciones" class="block text-sm font-medium leading-6 text-gray-900">Motivo de la anulación <span class="text-red-500">*</span></label>
                                        <div class="mt-2">
                                            <textarea id="observaciones" name="observaciones" rows="3" class="form-textarea w-full" required placeholder="Especifique por qué se anula el boleto..."></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                            <button type="submit" class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto">Confirmar Anulación</button>
                            <button type="button" @click="open = false" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
