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

    //impedir que um admin possa alterar os seus proprios tipos (adm,bloqueado) ... se eu estiver a pensar bem --not working
    public function viewOthers(User $user,User $user2)
    {
       $id1 = $user->id;
       $id2 = $user2->id;
       return ($user->adm == "Admin") && ($id1 != $id2);
    }

    //assegura que so o proprio utilizador possa alterar os seus dados, mais segurança
    public function update(User $user1, $id)
    {
        return ($user1->id == $id);
    }

    //assegura que so o proprio utilizador possa apagar os seus dados, mais segurança
    public function delete(User $user1, $id)
    {
        return ($user1->id == $id);
    }
}
