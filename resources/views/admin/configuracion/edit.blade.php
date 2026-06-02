@extends('layouts.app')

@section('content')
    <div class="mb-6 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.configuracion.edit') }}" class="text-gray-500 hover:text-gray-900 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Configuración Municipal</h1>
                <p class="text-sm text-gray-500">Ajustes globales de la institución.</p>
            </div>
        </div>
    </div>

    <form action="{{ route('admin.configuracion.update') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        @csrf
        @method('PUT')
        
        <!-- Datos Principales -->
        <div class="lg:col-span-2 space-y-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="font-bold text-gray-800">Información Institucional</h3>
                </div>
                <div class="card-body">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="form-group md:col-span-2">
                            <label for="nombre_municipalidad" class="form-label">Nombre de la Institución <span class="text-red-500">*</span></label>
                            <input type="text" name="nombre_municipalidad" id="nombre_municipalidad" class="form-input font-bold" value="{{ old('nombre_municipalidad', $config->nombre_municipalidad) }}" required>
                            @error('nombre_municipalidad') <p class="form-error">{{ $message }}</p> @enderror
                        </div>

                        <div class="form-group">
                            <label for="municipio" class="form-label">Municipio <span class="text-red-500">*</span></label>
                            <input type="text" name="municipio" id="municipio" class="form-input" value="{{ old('municipio', $config->municipio) }}" required>
                            @error('municipio') <p class="form-error">{{ $message }}</p> @enderror
                        </div>

                        <div class="form-group">
                            <label for="departamento" class="form-label">Departamento <span class="text-red-500">*</span></label>
                            <input type="text" name="departamento" id="departamento" class="form-input" value="{{ old('departamento', $config->departamento) }}" required>
                            @error('departamento') <p class="form-error">{{ $message }}</p> @enderror
                        </div>

                        <div class="form-group md:col-span-2">
                            <label for="direccion" class="form-label">Dirección Completa <span class="text-red-500">*</span></label>
                            <input type="text" name="direccion" id="direccion" class="form-input" value="{{ old('direccion', $config->direccion) }}" required>
                            @error('direccion') <p class="form-error">{{ $message }}</p> @enderror
                        </div>

                        <div class="form-group">
                            <label for="alcalde" class="form-label">Nombre del Alcalde <span class="text-red-500">*</span></label>
                            <input type="text" name="alcalde" id="alcalde" class="form-input" value="{{ old('alcalde', $config->alcalde) }}" required>
                            @error('alcalde') <p class="form-error">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="font-bold text-gray-800">Contacto y Web</h3>
                </div>
                <div class="card-body">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="form-group">
                            <label for="telefono" class="form-label">Teléfono Oficial <span class="text-red-500">*</span></label>
                            <input type="text" name="telefono" id="telefono" class="form-input" value="{{ old('telefono', $config->telefono) }}" required>
                            @error('telefono') <p class="form-error">{{ $message }}</p> @enderror
                        </div>

                        <div class="form-group">
                            <label for="email" class="form-label">Correo Electrónico Oficial</label>
                            <input type="email" name="email" id="email" class="form-input" value="{{ old('email', $config->email) }}">
                            @error('email') <p class="form-error">{{ $message }}</p> @enderror
                        </div>

                        <div class="form-group md:col-span-2">
                            <label for="sitio_web" class="form-label">Sitio Web (URL)</label>
                            <input type="url" name="sitio_web" id="sitio_web" class="form-input" value="{{ old('sitio_web', $config->sitio_web) }}" placeholder="https://www.ejemplo.gob.gt">
                            @error('sitio_web') <p class="form-error">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar Config -->
        <div class="lg:col-span-1 space-y-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="font-bold text-gray-800">Logo e Identidad</h3>
                </div>
                <div class="card-body text-center">
                    <div class="mb-4">
                        @if($config->logo_path)
                            <div class="w-32 h-32 mx-auto bg-gray-50 border border-gray-200 rounded-lg p-2 flex items-center justify-center">
                                <img src="{{ Storage::url($config->logo_path) }}" alt="Logo" class="max-w-full max-h-full object-contain">
                            </div>
                        @else
                            <div class="w-32 h-32 mx-auto bg-gray-100 border border-dashed border-gray-300 rounded-lg flex items-center justify-center text-gray-400">
                                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                        @endif
                    </div>
                    
                    <div class="form-group text-left">
                        <label for="logo" class="form-label">Actualizar Logo</label>
                        <input type="file" name="logo" id="logo" class="form-input p-1" accept="image/*">
                        @error('logo') <p class="form-error">{{ $message }}</p> @enderror
                        <p class="text-xs text-gray-500 mt-1">Imágenes PNG, JPG, o SVG. Max 2MB.</p>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="font-bold text-gray-800">Sistema</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="anio_fiscal_actual" class="form-label">Año Fiscal Vigente <span class="text-red-500">*</span></label>
                        <select name="anio_fiscal_actual" id="anio_fiscal_actual" class="form-select font-bold" required>
                            @for($i = now()->year - 2; $i <= now()->year + 2; $i++)
                                <option value="{{ $i }}" {{ old('anio_fiscal_actual', $config->anio_fiscal_actual) == $i ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>
                        @error('anio_fiscal_actual') <p class="form-error">{{ $message }}</p> @enderror
                        <div class="mt-3 bg-blue-50 text-blue-800 text-xs p-3 rounded-lg flex items-start gap-2">
                            <svg class="w-4 h-4 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span>Cambiar este valor afectará el año en que se emiten los nuevos boletos.</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="pt-4 border-t border-gray-200">
                <button type="submit" class="btn-primary w-full shadow-md">
                    Guardar Configuración
                </button>
            </div>
        </div>
    </form>
@endsection
