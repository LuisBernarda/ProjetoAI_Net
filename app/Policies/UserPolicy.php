<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

   
   //permite a um utilizador visualizar coisas mesmo sendo guest.... se tiver tudo bem!
    public function viewGuest(?User $user)
    {
        return optional($user)->id;
    }

   //possibilitar visualizaçao da parte de administracao a admins
    public function viewAdm(User $user)
    {
        return $user->adm;
    }

    //impedir que um admin possa alterar os seus proprios tipos (adm,bloqueado) ... se eu estiver a pensar bem
    public function viewAdmSelf(User $user1, User $user2)
    {
        return ($user1->adm) && ($user1->id != User2->id);
    }

    //assegura que so o proprio utilizador possa alterar os seus dados, mais segurança
    public function update(User $user1, User $user2)
    {
        return ($user1->id == $user2-> id);
    }

    //assegura que so o proprio utilizador possa apagar os seus dados, mais segurança
    public function delete(User $user1, User $user2)
    {
        return ($user1->id == $user2-> id);    
    }
}
