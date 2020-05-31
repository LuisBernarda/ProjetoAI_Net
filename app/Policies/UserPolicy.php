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
    public function viewOthers(User $user,User $user2)
    {
        //dd($listId);
        $id1 = $user->id;
        $id2 = $user2->id;
       return ($user->adm == "Admin") && ($id1 != $id2);

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
