<x-layouts.public>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 mt-12 animate-fade-in-up">
        
        <!-- Progress Steps -->
        <div class="mb-8 relative">
            <div class="overflow-hidden h-2 mb-4 text-xs flex rounded-full bg-gray-200">
                <div style="width: 75%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-primary-600"></div>
            </div>
            <div class="flex justify-between text-xs font-semibold text-gray-500">
                <span class="text-primary-600">1. Identificación</span>
                <span class="text-primary-600">2. Datos Personales</span>
                <span class="text-primary-600">3. Resumen y Pago</span>
                <span>4. Descarga</span>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 space-y-6">
                <!-- Resumen del Contribuyente -->
                <div class="card shadow-sm">
                    <div class="card-header bg-gray-50">
                        <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            Datos del Contribuyente
                        </h3>
                    </div>
                    <div class="card-body">
                        <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-4 gap-y-6">
                            <div>
                                <dt class="text-sm font-medium text-gray-500">DPI</dt>
                                <dd class="mt-1 text-base text-gray-900 font-semibold">{{ $boleto->contribuyente->dpi }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Nombre Completo</dt>
                                <dd class="mt-1 text-base text-gray-900 font-semibold">{{ $boleto->contribuyente->nombre_completo }}</dd>
                            </div>
                            <div class="sm:col-span-2">
                                <dt class="text-sm font-medium text-gray-500">Dirección</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $boleto->contribuyente->direccion }}, {{ $boleto->contribuyente->municipio }}, {{ $boleto->contribuyente->departamento }}</dd>
                            </div>
                        </dl>
                    </div>
                </div>

                <!-- Opciones de Pago -->
                <div class="card shadow-sm">
                    <div class="card-header bg-gray-50">
                        <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                            Método de Pago
                        </h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('boleto.pagar', $boleto->codigo_verificacion) }}" method="POST" id="form-pago">
                            @csrf
                            
                            <div class="grid grid-cols-1 gap-4 mb-6">
                                <!-- Opción Tarjeta -->
                                <label class="relative flex cursor-pointer rounded-lg border bg-white p-4 shadow-sm focus:outline-none hover:bg-gray-50 has-[:checked]:ring-2 has-[:checked]:ring-primary-600 has-[:checked]:border-primary-600">
                                    <input type="radio" name="metodo_pago" value="tarjeta" class="sr-only" required checked>
                                    <span class="flex flex-1">
                                        <span class="flex flex-col">
                                            <span class="block text-sm font-medium text-gray-900">Tarjeta de Crédito / Débito</span>
                                            <span class="mt-1 flex items-center text-sm text-gray-500">Pago en línea inmediato</span>
                                        </span>
                                    </span>
                                    <svg class="w-8 h-8 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                                </label>

                                <!-- Opción Transferencia -->
                                <label class="relative flex cursor-pointer rounded-lg border bg-white p-4 shadow-sm focus:outline-none hover:bg-gray-50 has-[:checked]:ring-2 has-[:checked]:ring-primary-600 has-[:checked]:border-primary-600">
                                    <input type="radio" name="metodo_pago" value="transferencia" class="sr-only" required>
                                    <span class="flex flex-1">
                                        <span class="flex flex-col">
                                            <span class="block text-sm font-medium text-gray-900">Transferencia Bancaria</span>
                                            <span class="mt-1 flex items-center text-sm text-gray-500">Requiere número de boleta</span>
                                        </span>
                                    </span>
                                    <svg class="w-8 h-8 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"></path></svg>
                                </label>

                                <!-- Opción Efectivo -->
                                <label class="relative flex cursor-pointer rounded-lg border bg-white p-4 shadow-sm focus:outline-none hover:bg-gray-50 has-[:checked]:ring-2 has-[:checked]:ring-primary-600 has-[:checked]:border-primary-600">
                                    <input type="radio" name="metodo_pago" value="efectivo" class="sr-only" required>
                                    <span class="flex flex-1">
                                        <span class="flex flex-col">
                                            <span class="block text-sm font-medium text-gray-900">Efectivo en Ventanilla</span>
                                            <span class="mt-1 flex items-center text-sm text-gray-500">Presente este resumen en caja municipal</span>
                                        </span>
                                    </span>
                                    <svg class="w-8 h-8 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                </label>
                            </div>

                            <div class="bg-blue-50 text-blue-800 text-sm p-4 rounded-lg flex gap-3">
                                <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <p><strong>Nota importante:</strong> En este entorno de demostración, el pago es simulado y se aprobará automáticamente al continuar.</p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Resumen y Monto -->
            <div class="lg:col-span-1">
                <div class="card shadow-lg border-primary-100 sticky top-24">
                    <div class="card-header bg-gradient-primary text-white text-center py-6">
                        <p class="text-primary-100 text-sm font-medium uppercase tracking-wider mb-1">Total a Pagar</p>
                        <h2 class="text-4xl font-bold">Q {{ number_format($boleto->monto, 2) }}</h2>
                        <span class="inline-block mt-3 px-3 py-1 bg-white/20 rounded-full text-xs font-semibold backdrop-blur-sm">
                            Año Fiscal {{ $boleto->anio_fiscal }}
                        </span>
                    </div>
                    <div class="card-body">
                        <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wider mb-4 border-b pb-2">Detalle de Cálculo</h3>
                        
                        <div class="flex justify-between items-center mb-3">
                            <span class="text-gray-600 text-sm">Ingresos declarados:</span>
                            <span class="font-medium text-gray-900">Q {{ number_format($boleto->contribuyente->ingresos_mensuales, 2) }}</span>
                        </div>
                        
                        <div class="flex justify-between items-center mb-6">
                            <span class="text-gray-600 text-sm">Monto Arbitrio (Ley):</span>
                            <span class="font-medium text-gray-900">Q {{ number_format($boleto->monto, 2) }}</span>
                        </div>

                        <div class="border-t border-gray-200 pt-6">
                            <button type="submit" form="form-pago" class="btn-primary w-full py-3.5 text-lg shadow-lg">
                                Confirmar y Pagar
                                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </button>
                            <p class="text-center text-xs text-gray-500 mt-3 flex items-center justify-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                Transacción segura
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.public>
