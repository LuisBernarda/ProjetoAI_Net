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

    public function alterarTipo(){
        //todo
        return view(users.alterarTipo);
    }

    public function alterarBloqueio(){
        //todo
        //return view(users.alterarBloqueio);
    }

    public function storeTipo(){
        //todo
    }

    public function storeBloqueio(){
        //todo
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
