<x-layouts.public>
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 mt-12 animate-fade-in-up">
        
        <!-- Progress Steps -->
        <div class="mb-8 relative">
            <div class="overflow-hidden h-2 mb-4 text-xs flex rounded-full bg-gray-200">
                <div style="width: 25%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-primary-600"></div>
            </div>
            <div class="flex justify-between text-xs font-semibold text-gray-500">
                <span class="text-primary-600">1. Identificación</span>
                <span>2. Datos Personales</span>
                <span>3. Resumen y Pago</span>
                <span>4. Descarga</span>
            </div>
        </div>

        <div class="card shadow-lg">
            <div class="card-header bg-gradient-to-r from-primary-700 to-primary-900 text-white">
                <h2 class="text-xl font-bold flex items-center gap-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"></path></svg>
                    Paso 1: Identificación
                </h2>
                <p class="text-primary-100 text-sm mt-1">Ingrese su Documento Personal de Identificación para iniciar el proceso.</p>
            </div>
            
            <div class="card-body">
                <form action="{{ route('boleto.verificar-dpi') }}" method="POST">
                    @csrf
                    
                    <div class="form-group mb-6">
                        <label for="dpi" class="form-label text-base">Número de DPI (CUI)</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
                            </div>
                            <input type="text" name="dpi" id="dpi" class="form-input pl-10 py-3 text-lg font-medium tracking-widest text-center" 
                                placeholder="0000 00000 0000" value="{{ old('dpi') }}" 
                                maxlength="13" pattern="\d{13}" required autofocus>
                        </div>
                        @error('dpi')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                        <p class="text-xs text-gray-500 mt-2 flex items-center gap-1">
                            <svg class="w-4 h-4 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Ingrese los 13 dígitos sin espacios ni guiones.
                        </p>
                    </div>

                    <div class="flex justify-end gap-3 mt-8">
                        <a href="{{ route('home') }}" class="btn-secondary">Cancelar</a>
                        <button type="submit" class="btn-primary">
                            Siguiente
                            <svg class="w-5 h-5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.public>
