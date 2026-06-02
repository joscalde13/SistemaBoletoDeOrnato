<x-layouts.public :config="$config ?? null">
    <!-- Hero Section -->
    <div class="relative bg-gradient-hero text-white overflow-hidden">
        <!-- Decorative background elements -->
        <div class="absolute inset-0 opacity-10">
            <svg class="absolute left-full transform -translate-x-1/2 -translate-y-1/4" width="404" height="784" fill="none" viewBox="0 0 404 784"><defs><pattern id="b1e6e422-73f8-40a5-b5f9-2fac7f0e5080" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse"><rect x="0" y="0" width="4" height="4" fill="currentColor"></rect></pattern></defs><rect width="404" height="784" fill="url(#b1e6e422-73f8-40a5-b5f9-2fac7f0e5080)"></rect></svg>
        </div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="pt-20 pb-24 lg:pt-28 lg:pb-32 flex flex-col items-center text-center">
                <span class="badge bg-white/20 text-white backdrop-blur-sm border border-white/30 mb-6 animate-fade-in-up">
                    Año Fiscal {{ $config->anio_fiscal_actual ?? now()->year }}
                </span>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold tracking-tight mb-6 animate-fade-in-up" style="animation-delay: 0.1s">
                    Boleto de Ornato <span class="text-primary-300">Electrónico</span>
                </h1>
                <p class="max-w-2xl text-lg md:text-xl text-blue-100 mb-10 animate-fade-in-up" style="animation-delay: 0.2s">
                    Genere y pague su Boleto de Ornato desde la comodidad de su hogar. Rápido, seguro y con validez legal inmediata mediante código QR.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 animate-fade-in-up" style="animation-delay: 0.3s">
                    <a href="{{ route('boleto.buscar') }}" class="btn bg-white text-primary-900 hover:bg-gray-50 text-lg px-8 py-4 shadow-xl shadow-black/10">
                        Generar Boleto Ahora
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16 stagger-children">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">¿Cómo funciona?</h2>
                <p class="text-gray-600 text-lg">Un proceso simplificado en 4 pasos para obtener su Boleto de Ornato sin hacer filas.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 stagger-children">
                <!-- Paso 1 -->
                <div class="card card-body text-center relative z-10 hover:-translate-y-1 transition-transform duration-300">
                    <div class="w-16 h-16 bg-primary-100 text-primary-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-inner transform rotate-3">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">1. Ingrese su DPI</h3>
                    <p class="text-gray-600 text-sm">El sistema verificará si ya cuenta con registros previos para agilizar el proceso.</p>
                </div>

                <!-- Paso 2 -->
                <div class="card card-body text-center relative z-10 hover:-translate-y-1 transition-transform duration-300">
                    <div class="w-16 h-16 bg-secondary-100 text-secondary-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-inner -rotate-3">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">2. Actualice Datos</h3>
                    <p class="text-gray-600 text-sm">Confirme su información personal e ingrese sus ingresos mensuales para el cálculo.</p>
                </div>

                <!-- Paso 3 -->
                <div class="card card-body text-center relative z-10 hover:-translate-y-1 transition-transform duration-300">
                    <div class="w-16 h-16 bg-accent-100 text-accent-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-inner rotate-3">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">3. Realice el Pago</h3>
                    <p class="text-gray-600 text-sm">Pague en línea utilizando tarjeta de crédito/débito o seleccione pago en efectivo.</p>
                </div>

                <!-- Paso 4 -->
                <div class="card card-body text-center relative z-10 hover:-translate-y-1 transition-transform duration-300">
                    <div class="w-16 h-16 bg-blue-100 text-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-inner -rotate-3">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">4. Descargue PDF</h3>
                    <p class="text-gray-600 text-sm">Obtenga inmediatamente su boleto en formato PDF con código QR de verificación.</p>
                </div>
            </div>
        </div>
    </div>
</x-layouts.public>
