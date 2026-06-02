@extends('layouts.app')

@section('content')
    <div class="mb-6 flex items-center gap-3">
        <a href="{{ route('admin.contribuyentes.show', $contribuyente) }}" class="text-gray-500 hover:text-gray-900 transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Editar Contribuyente</h1>
            <p class="text-sm text-gray-500">DPI: {{ $contribuyente->dpi }}</p>
        </div>
    </div>

    <div class="card max-w-4xl">
        <div class="card-body">
            <form action="{{ route('admin.contribuyentes.update', $contribuyente) }}" method="POST">
                @csrf
                @method('PUT')
                
                <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Información Personal</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <!-- Nombres y Apellidos -->
                    <div class="form-group mb-0">
                        <label for="primer_nombre" class="form-label">Primer Nombre <span class="text-red-500">*</span></label>
                        <input type="text" name="primer_nombre" id="primer_nombre" class="form-input" value="{{ old('primer_nombre', $contribuyente->primer_nombre) }}" required>
                        @error('primer_nombre') <p class="form-error">{{ $message }}</p> @enderror
                    </div>

                    <div class="form-group mb-0">
                        <label for="segundo_nombre" class="form-label">Segundo Nombre</label>
                        <input type="text" name="segundo_nombre" id="segundo_nombre" class="form-input" value="{{ old('segundo_nombre', $contribuyente->segundo_nombre) }}">
                        @error('segundo_nombre') <p class="form-error">{{ $message }}</p> @enderror
                    </div>

                    <div class="form-group mb-0">
                        <label for="primer_apellido" class="form-label">Primer Apellido <span class="text-red-500">*</span></label>
                        <input type="text" name="primer_apellido" id="primer_apellido" class="form-input" value="{{ old('primer_apellido', $contribuyente->primer_apellido) }}" required>
                        @error('primer_apellido') <p class="form-error">{{ $message }}</p> @enderror
                    </div>

                    <div class="form-group mb-0">
                        <label for="segundo_apellido" class="form-label">Segundo Apellido</label>
                        <input type="text" name="segundo_apellido" id="segundo_apellido" class="form-input" value="{{ old('segundo_apellido', $contribuyente->segundo_apellido) }}">
                        @error('segundo_apellido') <p class="form-error">{{ $message }}</p> @enderror
                    </div>

                    <div class="form-group mb-0">
                        <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                        <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-input" value="{{ old('fecha_nacimiento', $contribuyente->fecha_nacimiento?->format('Y-m-d')) }}">
                        @error('fecha_nacimiento') <p class="form-error">{{ $message }}</p> @enderror
                    </div>

                    <div class="form-group mb-0">
                        <label for="genero" class="form-label">Género</label>
                        <select name="genero" id="genero" class="form-select">
                            <option value="">Seleccione...</option>
                            <option value="M" {{ old('genero', $contribuyente->genero) == 'M' ? 'selected' : '' }}>Masculino</option>
                            <option value="F" {{ old('genero', $contribuyente->genero) == 'F' ? 'selected' : '' }}>Femenino</option>
                        </select>
                        @error('genero') <p class="form-error">{{ $message }}</p> @enderror
                    </div>
                </div>

                <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Ubicación y Contacto</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div class="form-group mb-0 md:col-span-2">
                        <label for="direccion" class="form-label">Dirección <span class="text-red-500">*</span></label>
                        <input type="text" name="direccion" id="direccion" class="form-input" value="{{ old('direccion', $contribuyente->direccion) }}" required>
                        @error('direccion') <p class="form-error">{{ $message }}</p> @enderror
                    </div>

                    <div class="form-group mb-0">
                        <label for="departamento" class="form-label">Departamento <span class="text-red-500">*</span></label>
                        <input type="text" name="departamento" id="departamento" class="form-input" value="{{ old('departamento', $contribuyente->departamento) }}" required>
                        @error('departamento') <p class="form-error">{{ $message }}</p> @enderror
                    </div>

                    <div class="form-group mb-0">
                        <label for="municipio" class="form-label">Municipio <span class="text-red-500">*</span></label>
                        <input type="text" name="municipio" id="municipio" class="form-input" value="{{ old('municipio', $contribuyente->municipio) }}" required>
                        @error('municipio') <p class="form-error">{{ $message }}</p> @enderror
                    </div>

                    <div class="form-group mb-0">
                        <label for="telefono" class="form-label">Teléfono</label>
                        <input type="text" name="telefono" id="telefono" class="form-input" value="{{ old('telefono', $contribuyente->telefono) }}">
                        @error('telefono') <p class="form-error">{{ $message }}</p> @enderror
                    </div>

                    <div class="form-group mb-0">
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <input type="email" name="email" id="email" class="form-input" value="{{ old('email', $contribuyente->email) }}">
                        @error('email') <p class="form-error">{{ $message }}</p> @enderror
                    </div>
                </div>

                <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Información Fiscal</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div class="form-group mb-0">
                        <label for="nit" class="form-label">NIT</label>
                        <input type="text" name="nit" id="nit" class="form-input" value="{{ old('nit', $contribuyente->nit) }}">
                        @error('nit') <p class="form-error">{{ $message }}</p> @enderror
                    </div>

                    <div class="form-group mb-0">
                        <label for="ingresos_mensuales" class="form-label">Ingresos Mensuales <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 font-bold">Q</span>
                            </div>
                            <input type="number" step="0.01" min="0" name="ingresos_mensuales" id="ingresos_mensuales" class="form-input pl-8 font-bold" value="{{ old('ingresos_mensuales', $contribuyente->ingresos_mensuales) }}" required>
                        </div>
                        @error('ingresos_mensuales') <p class="form-error">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="mt-8 border-t border-gray-100 pt-6 flex justify-end gap-3">
                    <a href="{{ route('admin.contribuyentes.show', $contribuyente) }}" class="btn-secondary">Cancelar</a>
                    <button type="submit" class="btn-primary">
                        Guardar Cambios
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
