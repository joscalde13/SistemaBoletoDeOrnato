<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('partials.head')
</head>
<body class="min-h-screen flex flex-col bg-gray-50 text-gray-900 font-sans antialiased">
    
    <!-- Navbar -->
    <header class="bg-white shadow-sm border-b border-gray-100 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <div class="flex items-center gap-4">
                    <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                        @if(isset($config) && $config->logo_path)
                            <img src="{{ Storage::url($config->logo_path) }}" alt="Logo Municipal" class="h-12 w-auto object-contain transition-transform group-hover:scale-105">
                        @else
                            <div class="h-12 w-12 bg-primary-600 rounded-lg flex items-center justify-center text-white font-bold text-xl shadow-inner">
                                GT
                            </div>
                        @endif
                        <div class="hidden sm:block">
                            <h1 class="text-xl font-bold text-gray-900 leading-tight group-hover:text-primary-700 transition-colors">
                                {{ $config->nombre_municipalidad ?? 'Municipalidad' }}
                            </h1>
                            <p class="text-xs text-gray-500 font-medium">Boleto de Ornato Electrónico</p>
                        </div>
                    </a>
                </div>

                <div class="flex items-center gap-2 sm:gap-4">
                    <a href="{{ route('home') }}" class="text-sm font-medium text-gray-600 hover:text-primary-600 px-3 py-2 rounded-md transition-colors hidden md:block">
                        Inicio
                    </a>
                    <a href="{{ route('boleto.buscar') }}" class="btn-primary btn-sm sm:btn">
                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        Generar Boleto
                    </a>
                    
                    <div class="h-6 w-px bg-gray-200 mx-1 hidden sm:block"></div>
                    
                    <a href="{{ route('admin.dashboard') }}" class="text-sm font-medium text-gray-500 hover:text-gray-900 px-3 py-2 rounded-md transition-colors flex items-center gap-1.5" title="Administración">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        <span class="hidden sm:inline">Admin</span>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow">
        @if(session('success'))
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
                <div class="alert-success animate-fade-in-up">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
                <div class="alert-danger animate-fade-in-up">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span>{{ session('error') }}</span>
                </div>
            </div>
        @endif

        @if(session('info'))
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
                <div class="alert-info animate-fade-in-up">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span>{{ session('info') }}</span>
                </div>
            </div>
        @endif

        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-400 py-12 border-t border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-white text-lg font-bold mb-4">{{ $config->nombre_municipalidad ?? 'Municipalidad' }}</h3>
                    <p class="mb-2 flex items-start gap-2">
                        <svg class="w-5 h-5 mt-0.5 text-gray-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        <span>{{ $config->direccion ?? 'Dirección no configurada' }}, {{ $config->municipio ?? '' }}, {{ $config->departamento ?? '' }}</span>
                    </p>
                    <p class="mb-2 flex items-center gap-2">
                        <svg class="w-5 h-5 text-gray-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                        <span>{{ $config->telefono ?? 'Teléfono no configurado' }}</span>
                    </p>
                    @if(isset($config) && $config->email)
                        <p class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-gray-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            <span>{{ $config->email }}</span>
                        </p>
                    @endif
                </div>
                
                <div>
                    <h3 class="text-white text-lg font-bold mb-4">Enlaces Rápidos</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('home') }}" class="hover:text-white transition-colors">Inicio</a></li>
                        <li><a href="{{ route('boleto.buscar') }}" class="hover:text-white transition-colors">Generar Boleto</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-white text-lg font-bold mb-4">Acerca del Sistema</h3>
                    <p class="text-sm">Sistema electrónico de emisión y pago de Boleto de Ornato, diseñado para facilitar a los ciudadanos el cumplimiento de sus obligaciones tributarias municipales de forma rápida y segura.</p>
                </div>
            </div>
            
            <div class="mt-12 pt-8 border-t border-gray-800 text-sm text-center">
                <p>&copy; {{ date('Y') }} {{ $config->nombre_municipalidad ?? 'Municipalidad' }}. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>
</body>
</html>
