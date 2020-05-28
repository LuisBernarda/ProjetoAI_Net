<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{

    public function index(){
        //todo
    }
    
    public function admin(Request $request){

    $qry = User::query();
    $users = $qry->paginate(15);
    dd($users);
    return view('users.admin')->withUsers($users);
    }

    public function alterarTipo(User $user){
        //todo
        return view(users.alterarTipo)
            ->withUsers($user);
    }

    public function alterarBloqueio(User $user){
        //todo
        return view(users.alterarBloqueio)
            ->withUsers($user);
    }

    public function storeTipo(UserPost $request, User $user){

        //tenho que testar
        $validated_data = $request->validated();
        $user->adm = $validated_data['adm'];
    }

    public function storeBloqueio(UserPost $request, User $user){

        //tenho que testar isto
         $validated_data = $request->validated();
        $user->adm = $validated_data['bloqueado'];
    }

    public function create(){
        //todo
    }

    public function edit(){
        //todo
    }

    public function delete(){
        //todo
    }


}
