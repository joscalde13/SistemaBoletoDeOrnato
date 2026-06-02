@extends('layouts.app')

@section('content')
    <div class="mb-6 flex items-center gap-3">
        <a href="{{ route('admin.boletos.index') }}" class="text-gray-500 hover:text-gray-900 transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Generar Boleto Manual</h1>
            <p class="text-sm text-gray-500">Emisión administrativa presencial o telefónica.</p>
        </div>
    </div>

    <div class="card max-w-3xl">
        <div class="card-body">
            <form action="{{ route('admin.boletos.store') }}" method="POST">
                @csrf
                
                <div class="form-group">
                    <label for="contribuyente_id" class="form-label">Contribuyente <span class="text-red-500">*</span></label>
                    <select name="contribuyente_id" id="contribuyente_id" class="form-select w-full" required>
                        <option value="">Seleccione un contribuyente...</option>
                        @foreach($contribuyentes as $contribuyente)
                            <option value="{{ $contribuyente->id }}" {{ old('contribuyente_id') == $contribuyente->id ? 'selected' : '' }}>
                                {{ $contribuyente->nombre_completo }} (DPI: {{ $contribuyente->dpi }})
                            </option>
                        @endforeach
                    </select>
                    @error('contribuyente_id') <p class="form-error">{{ $message }}</p> @enderror
                    <p class="text-xs text-gray-500 mt-2 flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Si el contribuyente no aparece, debe registrarlo primero en la sección de Contribuyentes.
                    </p>
                </div>

                <div class="form-group">
                    <label for="ingresos_mensuales" class="form-label">Ingresos Mensuales Declarados (Q) <span class="text-red-500">*</span></label>
                    <div class="relative max-w-xs">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="text-gray-500 font-bold">Q</span>
                        </div>
                        <input type="number" step="0.01" min="0" name="ingresos_mensuales" id="ingresos_mensuales" class="form-input pl-8 font-bold text-gray-900" value="{{ old('ingresos_mensuales') }}" required>
                    </div>
                    @error('ingresos_mensuales') <p class="form-error">{{ $message }}</p> @enderror
                    <p class="text-xs text-gray-500 mt-1">El monto del boleto se calculará automáticamente según la tabla de arbitrios vigente.</p>
                </div>

                <div class="mt-8 border-t border-gray-100 pt-6 flex justify-end gap-3">
                    <a href="{{ route('admin.boletos.index') }}" class="btn-secondary">Cancelar</a>
                    <button type="submit" class="btn-primary">
                        <svg class="w-5 h-5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                        Generar Boleto
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
