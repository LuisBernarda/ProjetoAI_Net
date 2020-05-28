<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function view(User $user)
    {
        if(is_null($user)) {
            // se utilizador existe
            return false
        }

        return true;
    }

    public function viewGuest(?User $user)
    {
        return optional($user)->id;
    }

    public function viewBloqueado(User $user)
    {
        return $user->bloqueado;
    }

    public function alterarAdmBlq(User $user)
    {
        return $user->adm;
    }
}
