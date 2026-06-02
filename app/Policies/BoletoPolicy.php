<?php

namespace App\Policies;

use App\Models\Boleto;
use App\Models\User;

class BoletoPolicy
{
    /**
     * Solo usuarios autenticados (admins) pueden gestionar boletos.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Boleto $boleto): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Boleto $boleto): bool
    {
        return !$boleto->estaAnulado();
    }

    public function delete(User $user, Boleto $boleto): bool
    {
        return true;
    }

    /**
     * Solo se pueden anular boletos que no estén ya anulados.
     */
    public function anular(User $user, Boleto $boleto): bool
    {
        return !$boleto->estaAnulado();
    }
}
