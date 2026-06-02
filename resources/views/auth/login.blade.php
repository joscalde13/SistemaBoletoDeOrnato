<x-layouts.public>
    <div class="max-w-md mx-auto px-4 sm:px-6 lg:px-8 mt-20 mb-32">
        <div class="card shadow-xl overflow-hidden animate-fade-in-up">
            <div class="card-header bg-gradient-primary text-white text-center py-8">
            
                <h2 class="text-2xl font-bold">Acceso Administrativo</h2>
                <p class="text-primary-100 mt-1 text-sm">Ingrese sus credenciales para continuar</p>
            </div>
            
            <div class="card-body p-8">
                @if (session('status'))
                    <div class="alert-success mb-6 text-sm">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group mb-5">
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path></svg>
                            </div>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" class="form-input pl-10 py-3 bg-gray-50 focus:bg-white" placeholder="admin@municipalidad.gob.gt">
                        </div>
                        @error('email') <p class="form-error mt-2">{{ $message }}</p> @enderror
                    </div>

                    <div class="form-group mb-6">
                        <label for="password" class="form-label">Contraseña</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                            </div>
                            <input id="password" type="password" name="password" required autocomplete="current-password" class="form-input pl-10 py-3 bg-gray-50 focus:bg-white" placeholder="••••••••">
                        </div>
                        @error('password') <p class="form-error mt-2">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex items-center justify-between mb-8">
                        <label class="flex items-center">
                            <input type="checkbox" name="remember" class="w-4 h-4 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                            <span class="ml-2 text-sm text-gray-600">Mantener sesión</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a class="text-sm font-medium text-primary-600 hover:text-primary-800" href="{{ route('password.request') }}">
                                ¿Olvidó su contraseña?
                            </a>
                        @endif
                    </div>

                    <button type="submit" class="btn-primary w-full py-3.5 shadow-lg shadow-primary-500/30 group">
                        Iniciar Sesión
                        <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </button>
                </form>
            </div>
            <div class="bg-gray-50 border-t border-gray-100 p-4 text-center">
                <p class="text-xs text-gray-500 flex items-center justify-center gap-1">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Área restringida solo para personal autorizado.
                </p>
            </div>
        </div>
    </div>
</x-layouts.public>
