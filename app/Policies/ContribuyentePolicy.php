<?php

namespace App\Policies;

use App\Models\Contribuyente;
use App\Models\User;

class ContribuyentePolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Contribuyente $contribuyente): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Contribuyente $contribuyente): bool
    {
        return true;
    }

    public function delete(User $user, Contribuyente $contribuyente): bool
    {
        return true;
    }
}
