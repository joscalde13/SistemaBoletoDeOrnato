<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

/**
 * Seeder para crear el usuario administrador del sistema.
 */
class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@municipalidad.gob.gt',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);
    }
}
