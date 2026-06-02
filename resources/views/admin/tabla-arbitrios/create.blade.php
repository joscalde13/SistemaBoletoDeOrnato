@extends('layouts.app')

@section('content')
    <div class="mb-6 flex items-center gap-3">
        <a href="{{ route('admin.tabla-arbitrios.index') }}" class="text-gray-500 hover:text-gray-900 transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Nuevo Rango de Arbitrio</h1>
        </div>
    </div>

    <div class="card max-w-3xl">
        <div class="card-body">
            <form action="{{ route('admin.tabla-arbitrios.store') }}" method="POST">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div class="form-group mb-0 md:col-span-2">
                        <label for="descripcion" class="form-label">Descripción del Rango</label>
                        <input type="text" name="descripcion" id="descripcion" class="form-input" value="{{ old('descripcion') }}" placeholder="Ej. Ingresos de Q3,000.01 a Q5,000.00">
                        @error('descripcion') <p class="form-error">{{ $message }}</p> @enderror
                    </div>

                    <div class="form-group mb-0">
                        <label for="rango_inicio" class="form-label">Ingreso Desde (Q) <span class="text-red-500">*</span></label>
                        <input type="number" step="0.01" min="0" name="rango_inicio" id="rango_inicio" class="form-input font-mono" value="{{ old('rango_inicio') }}" required>
                        @error('rango_inicio') <p class="form-error">{{ $message }}</p> @enderror
                    </div>

                    <div class="form-group mb-0">
                        <label for="rango_fin" class="form-label">Ingreso Hasta (Q) <span class="text-red-500">*</span></label>
                        <input type="number" step="0.01" min="0" name="rango_fin" id="rango_fin" class="form-input font-mono" value="{{ old('rango_fin') }}" required>
                        @error('rango_fin') <p class="form-error">{{ $message }}</p> @enderror
                        <p class="text-xs text-gray-500 mt-1">Use 999999.99 para el límite superior infinito.</p>
                    </div>

                    <div class="form-group mb-0 md:col-span-2">
                        <label for="monto" class="form-label text-lg">Monto a Pagar (Q) <span class="text-red-500">*</span></label>
                        <input type="number" step="0.01" min="0" name="monto" id="monto" class="form-input text-xl font-bold text-primary-700 py-3" value="{{ old('monto') }}" required>
                        @error('monto') <p class="form-error">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="form-group flex items-center mt-6">
                    <input type="checkbox" name="activo" id="activo" value="1" class="w-5 h-5 text-primary-600 rounded border-gray-300 focus:ring-primary-500" {{ old('activo', true) ? 'checked' : '' }}>
                    <label for="activo" class="ml-3 text-sm font-medium text-gray-900">Rango Activo (Se usará para cálculos)</label>
                </div>

                <div class="mt-8 border-t border-gray-100 pt-6 flex justify-end gap-3">
                    <a href="{{ route('admin.tabla-arbitrios.index') }}" class="btn-secondary">Cancelar</a>
                    <button type="submit" class="btn-primary">
                        Crear Rango
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
