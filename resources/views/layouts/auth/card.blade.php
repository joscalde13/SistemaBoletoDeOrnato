<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-neutral-100 antialiased dark:bg-linear-to-b dark:from-neutral-950 dark:to-neutral-900">
        <div class="bg-muted flex min-h-svh flex-col items-center justify-center gap-6 p-6 md:p-10">
            <div class="flex w-full max-w-md flex-col gap-6">
                <a href="{{ route('home') }}" class="flex flex-col items-center gap-2 font-medium" wire:navigate>
                    @if(isset($config) && $config->logo_path)
                        <img src="{{ Storage::url($config->logo_path) }}" alt="{{ $config->nombre_municipalidad ?? 'Municipalidad' }}" class="h-9 w-auto object-contain">
                    @else
                        <div class="flex h-9 w-9 items-center justify-center rounded-md bg-primary-600 text-white">
                            BO
                        </div>
                    @endif

                    <span class="sr-only">{{ $config->nombre_municipalidad ?? config('app.name', 'Municipalidad') }}</span>
                </a>

                <div class="flex flex-col gap-6">
                    <div class="rounded-xl border bg-white dark:bg-stone-950 dark:border-stone-800 text-stone-800 shadow-xs">
                        <div class="px-10 py-8">{{ $slot }}</div>
                    </div>
                </div>
            </div>
        </div>

        @persist('toast')
            <flux:toast.group>
                <flux:toast />
            </flux:toast.group>
        @endpersist

        @fluxScripts
    </body>
</html>
