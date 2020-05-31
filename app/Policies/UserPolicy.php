<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

   //possibilitar visualizaçao da parte de administracao a admins -- working
    public function viewAdm(User $user)
    {
        return $user->adm == "Admin";
    }

    //impedir que um admin possa alterar os seus proprios tipos (adm,bloqueado) -- not working
    public function view($listId,User $currentUser)
    {
        //dd($listId);
        return $currentUser->adm != 0 && !($currentUser->id == $listId);
        //return true;
    }

    //assegura que so o proprio utilizador possa alterar os seus dados, mais segurança -- n testado
    public function update(User $user, $id)
    {
        return ($user->id == $id);
    }

    //assegura que so o proprio utilizador possa apagar os seus dados, mais segurança -- n testado ainda
    public function delete(User $user1, $id)
    {
        return ($user->id == $id);    
    }
}
