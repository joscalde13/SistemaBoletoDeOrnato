<x-layouts.public>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 mt-12 animate-fade-in-up">
        
        <!-- Progress Steps -->
        <div class="mb-8 relative">
            <div class="overflow-hidden h-2 mb-4 text-xs flex rounded-full bg-gray-200">
                <div style="width: 50%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-primary-600"></div>
            </div>
            <div class="flex justify-between text-xs font-semibold text-gray-500">
                <span class="text-primary-600">1. Identificación</span>
                <span class="text-primary-600">2. Datos Personales</span>
                <span>3. Resumen y Pago</span>
                <span>4. Descarga</span>
            </div>
        </div>

        <div class="card shadow-lg">
            <div class="card-header bg-gradient-to-r from-primary-700 to-primary-900 text-white">
                <h2 class="text-xl font-bold flex items-center gap-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    Paso 2: Datos Personales
                </h2>
                <p class="text-primary-100 text-sm mt-1">
                    @if($contribuyente)
                        Verifique o actualice su información y registre sus ingresos mensuales.
                    @else
                        Complete el formulario con sus datos personales e ingresos mensuales.
                    @endif
                </p>
            </div>
            
            <div class="card-body bg-gray-50/30">
                <form action="{{ route('boleto.guardar') }}" method="POST">
                    @csrf
                    
                    <div class="bg-blue-50 border border-blue-100 rounded-lg p-4 mb-8 flex items-center justify-between">
                        <div>
                            <p class="text-sm text-blue-600 font-semibold uppercase tracking-wider">Número de DPI</p>
                            <p class="text-xl font-bold text-blue-900 tracking-widest">{{ substr($dpi, 0, 4) }} {{ substr($dpi, 4, 5) }} {{ substr($dpi, 9, 4) }}</p>
                        </div>
                        <input type="hidden" name="dpi" value="{{ $dpi }}">
                        <a href="{{ route('boleto.buscar') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium underline">Cambiar DPI</a>
                    </div>

                    <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Información Personal</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <!-- Nombres y Apellidos -->
                        <div class="form-group mb-0">
                            <label for="primer_nombre" class="form-label">Primer Nombre <span class="text-red-500">*</span></label>
                            <input type="text" name="primer_nombre" id="primer_nombre" class="form-input" value="{{ old('primer_nombre', $contribuyente?->primer_nombre) }}" required>
                            @error('primer_nombre') <p class="form-error">{{ $message }}</p> @enderror
                        </div>

                        <div class="form-group mb-0">
                            <label for="segundo_nombre" class="form-label">Segundo Nombre</label>
                            <input type="text" name="segundo_nombre" id="segundo_nombre" class="form-input" value="{{ old('segundo_nombre', $contribuyente?->segundo_nombre) }}">
                            @error('segundo_nombre') <p class="form-error">{{ $message }}</p> @enderror
                        </div>

                        <div class="form-group mb-0">
                            <label for="primer_apellido" class="form-label">Primer Apellido <span class="text-red-500">*</span></label>
                            <input type="text" name="primer_apellido" id="primer_apellido" class="form-input" value="{{ old('primer_apellido', $contribuyente?->primer_apellido) }}" required>
                            @error('primer_apellido') <p class="form-error">{{ $message }}</p> @enderror
                        </div>

                        <div class="form-group mb-0">
                            <label for="segundo_apellido" class="form-label">Segundo Apellido</label>
                            <input type="text" name="segundo_apellido" id="segundo_apellido" class="form-input" value="{{ old('segundo_apellido', $contribuyente?->segundo_apellido) }}">
                            @error('segundo_apellido') <p class="form-error">{{ $message }}</p> @enderror
                        </div>

                        <!-- Fecha y Género -->
                        <div class="form-group mb-0">
                            <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento <span class="text-red-500">*</span></label>
                            <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-input" value="{{ old('fecha_nacimiento', $contribuyente?->fecha_nacimiento?->format('Y-m-d')) }}" required>
                            @error('fecha_nacimiento') <p class="form-error">{{ $message }}</p> @enderror
                        </div>

                        <div class="form-group mb-0">
                            <label for="genero" class="form-label">Género <span class="text-red-500">*</span></label>
                            <select name="genero" id="genero" class="form-select" required>
                                <option value="">Seleccione...</option>
                                <option value="M" {{ old('genero', $contribuyente?->genero) == 'M' ? 'selected' : '' }}>Masculino</option>
                                <option value="F" {{ old('genero', $contribuyente?->genero) == 'F' ? 'selected' : '' }}>Femenino</option>
                            </select>
                            @error('genero') <p class="form-error">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Datos de Ubicación y Contacto</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div class="form-group mb-0 md:col-span-2">
                            <label for="direccion" class="form-label">Dirección <span class="text-red-500">*</span></label>
                            <input type="text" name="direccion" id="direccion" class="form-input" value="{{ old('direccion', $contribuyente?->direccion) }}" required>
                            @error('direccion') <p class="form-error">{{ $message }}</p> @enderror
                        </div>

                        <div class="form-group mb-0">
                            <label for="departamento" class="form-label">Departamento <span class="text-red-500">*</span></label>
                            <input type="text" name="departamento" id="departamento" class="form-input" value="{{ old('departamento', $contribuyente?->departamento) }}" required>
                            @error('departamento') <p class="form-error">{{ $message }}</p> @enderror
                        </div>

                        <div class="form-group mb-0">
                            <label for="municipio" class="form-label">Municipio <span class="text-red-500">*</span></label>
                            <input type="text" name="municipio" id="municipio" class="form-input" value="{{ old('municipio', $contribuyente?->municipio) }}" required>
                            @error('municipio') <p class="form-error">{{ $message }}</p> @enderror
                        </div>

                        <div class="form-group mb-0">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <input type="text" name="telefono" id="telefono" class="form-input" value="{{ old('telefono', $contribuyente?->telefono) }}">
                            @error('telefono') <p class="form-error">{{ $message }}</p> @enderror
                        </div>

                        <div class="form-group mb-0">
                            <label for="email" class="form-label">Correo Electrónico (Opcional)</label>
                            <input type="email" name="email" id="email" class="form-input" value="{{ old('email', $contribuyente?->email) }}" placeholder="Para recibir copia del boleto">
                            @error('email') <p class="form-error">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Información Fiscal</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                        <div class="form-group mb-0">
                            <label for="nit" class="form-label">NIT</label>
                            <input type="text" name="nit" id="nit" class="form-input" value="{{ old('nit', $contribuyente?->nit) }}">
                            @error('nit') <p class="form-error">{{ $message }}</p> @enderror
                        </div>

                        <div class="form-group mb-0">
                            <label for="ingresos_mensuales" class="form-label">Ingresos Mensuales Promedio (Q) <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 font-bold">Q</span>
                                </div>
                                <input type="number" step="0.01" min="0" name="ingresos_mensuales" id="ingresos_mensuales" class="form-input pl-8 font-bold text-primary-700 bg-primary-50 focus:bg-white" value="{{ old('ingresos_mensuales', $contribuyente?->ingresos_mensuales) }}" required>
                            </div>
                            @error('ingresos_mensuales') <p class="form-error">{{ $message }}</p> @enderror
                            <p class="text-xs text-gray-500 mt-1">Este valor se utilizará para calcular automáticamente el monto a pagar según la ley.</p>
                        </div>
                    </div>

                    <div class="mt-8 pt-6 border-t border-gray-200 flex justify-end gap-3">
                        <a href="{{ route('boleto.buscar') }}" class="btn-secondary">Atrás</a>
                        <button type="submit" class="btn-primary">
                            Calcular y Continuar
                            <svg class="w-5 h-5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.public>
