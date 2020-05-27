<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{
    public function admin(){

    $qry = User::query();
    $users = $qry->paginate(15);
    return view('users.admin')->withUsers($users);
    }

    public function alterarTipo(){
        //todo
        //return view(users.alterarTipo);
    }

    public function alterarBloqueio(){
        //todo
        //return view(users.alterarBloqueio);
    }
}
