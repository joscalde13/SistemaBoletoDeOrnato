<x-layouts.public>
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 mt-12 mb-20 animate-fade-in-up">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-gray-900">Verificación de Boleto</h2>
            <p class="text-gray-600 mt-2">Sistema de Validación Oficial</p>
        </div>

        <div class="card shadow-xl overflow-hidden">
            @if($encontrado)
                <!-- Boleto Válido -->
                <div class="bg-green-50 border-b border-green-100 p-6 flex items-center justify-center gap-4">
                    <div class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center flex-shrink-0 text-white shadow-md">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-green-800">Boleto Válido</h3>
                        <p class="text-green-600 font-medium">Este documento está registrado oficialmente en el sistema.</p>
                    </div>
                </div>

                <div class="card-body p-8">
                    <!-- Marca de Agua Visual -->
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center justify-center opacity-5 pointer-events-none">
                            <svg class="w-64 h-64" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 relative z-10">
                            <!-- Datos del Boleto -->
                            <div>
                                <h4 class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-4 border-b pb-2">Datos del Boleto</h4>
                                <dl class="space-y-4">
                                    <div>
                                        <dt class="text-xs font-medium text-gray-500 uppercase">Número de Boleto</dt>
                                        <dd class="mt-1 text-xl font-bold text-gray-900">{{ $boleto->numero_boleto }}</dd>
                                    </div>
                                    <div>
                                        <dt class="text-xs font-medium text-gray-500 uppercase">Año Fiscal</dt>
                                        <dd class="mt-1 font-semibold text-gray-900">{{ $boleto->anio_fiscal }}</dd>
                                    </div>
                                    <div>
                                        <dt class="text-xs font-medium text-gray-500 uppercase">Monto Cancelado</dt>
                                        <dd class="mt-1 font-bold text-gray-900">Q {{ number_format($boleto->monto, 2) }}</dd>
                                    </div>
                                    <div>
                                        <dt class="text-xs font-medium text-gray-500 uppercase">Estado Actual</dt>
                                        <dd class="mt-1">
                                            <span class="badge {{ $boleto->estado->claseCss() }} px-3 py-1">
                                                {{ mb_strtoupper($boleto->estado->etiqueta()) }}
                                            </span>
                                        </dd>
                                    </div>
                                </dl>
                            </div>

                            <!-- Datos del Ciudadano -->
                            <div>
                                <h4 class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-4 border-b pb-2">Datos del Ciudadano</h4>
                                <dl class="space-y-4">
                                    <div>
                                        <dt class="text-xs font-medium text-gray-500 uppercase">DPI</dt>
                                        <dd class="mt-1 font-bold text-gray-900">{{ $boleto->contribuyente->dpi }}</dd>
                                    </div>
                                    <div>
                                        <dt class="text-xs font-medium text-gray-500 uppercase">Nombre Completo</dt>
                                        <dd class="mt-1 font-semibold text-gray-900">{{ $boleto->contribuyente->nombre_completo }}</dd>
                                    </div>
                                    <div>
                                        <dt class="text-xs font-medium text-gray-500 uppercase">Fecha Emisión</dt>
                                        <dd class="mt-1 text-gray-900">{{ $boleto->fecha_emision->format('d/m/Y H:i:s') }}</dd>
                                    </div>
                                    @if($boleto->fecha_pago)
                                        <div>
                                            <dt class="text-xs font-medium text-gray-500 uppercase">Fecha Pago</dt>
                                            <dd class="mt-1 text-gray-900">{{ $boleto->fecha_pago->format('d/m/Y H:i:s') }}</dd>
                                        </div>
                                    @endif
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <!-- Boleto Inválido -->
                <div class="bg-red-50 border-b border-red-100 p-8 text-center">
                    <div class="w-20 h-20 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4 border-4 border-white shadow-sm">
                        <svg class="w-10 h-10 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-red-800 mb-2">Boleto Inválido o No Encontrado</h3>
                    <p class="text-red-600">El código proporcionado no existe en nuestros registros oficiales o el documento pudo haber sido alterado.</p>
                </div>
            @endif
            
            <div class="bg-gray-50 p-6 border-t border-gray-100 text-center">
                <a href="{{ route('home') }}" class="btn-primary">
                    Ir a la Página Principal
                </a>
            </div>
        </div>
    </div>
</x-layouts.public>
