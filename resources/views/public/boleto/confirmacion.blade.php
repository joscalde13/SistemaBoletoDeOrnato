<x-layouts.public>
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 mt-12 mb-20 animate-fade-in-up">
        
        <!-- Progress Steps -->
        <div class="mb-8 relative hidden sm:block">
            <div class="overflow-hidden h-2 mb-4 text-xs flex rounded-full bg-gray-200">
                <div style="width: 100%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-green-500"></div>
            </div>
            <div class="flex justify-between text-xs font-semibold text-gray-500">
                <span class="text-green-600">1. Identificación</span>
                <span class="text-green-600">2. Datos Personales</span>
                <span class="text-green-600">3. Resumen y Pago</span>
                <span class="text-green-600">4. Descarga</span>
            </div>
        </div>

        <div class="card shadow-xl border-green-500 overflow-hidden">
            <!-- Header de Éxito -->
            <div class="bg-green-500 text-white text-center py-10 px-6">
                <div class="w-20 h-20 bg-white rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg animate-pulse-soft">
                    <svg class="w-10 h-10 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                </div>
                <h2 class="text-3xl font-bold mb-2">¡Pago Exitoso!</h2>
                <p class="text-green-100 text-lg">Su Boleto de Ornato ha sido generado correctamente.</p>
            </div>
            
            <div class="card-body p-8 sm:p-10">
                <div class="bg-gray-50 border border-gray-100 rounded-xl p-6 mb-8">
                    <h3 class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-4 border-b pb-2">Detalles del Boleto</h3>
                    
                    <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-4 gap-y-6">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">No. Boleto</dt>
                            <dd class="mt-1 text-lg text-primary-700 font-bold">{{ $boleto->numero_boleto }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Estado</dt>
                            <dd class="mt-1">
                                <span class="badge bg-green-100 text-green-800 px-3 py-1 text-sm border border-green-200">
                                    <svg class="w-4 h-4 mr-1 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    PAGADO
                                </span>
                            </dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Contribuyente</dt>
                            <dd class="mt-1 text-base text-gray-900 font-medium">{{ $boleto->contribuyente->nombre_completo }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">DPI</dt>
                            <dd class="mt-1 text-base text-gray-900 font-medium">{{ $boleto->contribuyente->dpi }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Monto Pagado</dt>
                            <dd class="mt-1 text-xl text-gray-900 font-bold">Q {{ number_format($boleto->monto, 2) }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Fecha de Pago</dt>
                            <dd class="mt-1 text-base text-gray-900 font-medium">{{ $boleto->fecha_pago->format('d/m/Y H:i') }}</dd>
                        </div>
                    </dl>
                </div>

                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="{{ route('home') }}" class="btn-secondary py-3 px-8 text-center">
                        Volver al Inicio
                    </a>
                    <a href="{{ route('boleto.descargar', $boleto->codigo_verificacion) }}" class="btn-primary py-3 px-8 text-center shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                        Descargar PDF
                    </a>
                </div>
            </div>
            
            <div class="bg-gray-50 px-6 py-4 border-t border-gray-100 text-center">
                <p class="text-sm text-gray-500">El boleto PDF incluye un código QR único que certifica su validez oficial.</p>
            </div>
        </div>
    </div>
</x-layouts.public>
