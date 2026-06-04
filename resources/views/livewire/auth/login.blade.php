<x-layouts::auth :title="__('Sistema de Boleto de Ornato')"> <div class="w-full max-w-md mx-auto">

    

    <!-- Card -->
    <div class="p-8 border shadow-2xl bg-zinc-900/80 backdrop-blur-xl rounded-2xl border-zinc-800">

        <h2 class="mb-2 text-2xl font-bold text-center text-white">
            Acceso Administrativo
        </h2>

        <p class="mb-6 text-sm text-center text-zinc-400">
            Ingrese sus credenciales para continuar
        </p>

        <form method="POST" action="{{ route('login.store') }}" class="space-y-5">
            @csrf

            <flux:input
                name="email"
                :label="__('Correo electrónico')"
                type="email"
                required
                autocomplete="email"
                placeholder="correo@municipalidad.gob.gt"
            />

            <flux:input
                name="password"
                :label="__('Contraseña')"
                type="password"
                required
                autocomplete="current-password"
                placeholder="Ingrese su contraseña"
                viewable
            />

            <flux:button
                variant="primary"
                type="submit"
                class="w-full py-3 text-base transition-all duration-300 hover:scale-105 hover:shadow-xl hover:-translate-y-1">
                Iniciar sesión
            </flux:button>
            
        </form>
    </div>


</div>


</x-layouts::auth>
