<x-layouts.public>
    <div class="max-w-md mx-auto px-4 sm:px-6 lg:px-8 mt-20 mb-32">
        <div class="card shadow-xl overflow-hidden animate-fade-in-up">
            <div class="card-header bg-gray-50 text-center py-6 border-b border-gray-200">
                <h2 class="text-xl font-bold text-gray-900">Recuperar Contraseña</h2>
                <p class="text-gray-500 mt-2 text-sm px-4">
                    ¿Olvidó su contraseña? Ingrese su dirección de correo electrónico y le enviaremos un enlace para restablecerla.
                </p>
            </div>
            
            <div class="card-body p-8">
                @if (session('status'))
                    <div class="alert-success mb-6 text-sm">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="form-group mb-6">
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path></svg>
                            </div>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" class="form-input pl-10 py-3 bg-gray-50 focus:bg-white" placeholder="admin@municipalidad.gob.gt">
                        </div>
                        @error('email') <p class="form-error mt-2">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex items-center justify-between mt-8 pt-6 border-t border-gray-100">
                        <a href="{{ route('login') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900 flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                            Volver al login
                        </a>
                        <button type="submit" class="btn-primary py-2.5">
                            Enviar Enlace
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.public>
