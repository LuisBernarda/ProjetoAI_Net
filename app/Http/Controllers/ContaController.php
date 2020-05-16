<?php

namespace App\Http\Controllers;

use App\Conta;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\StoreConta;
use App\Http\Requests\StoreConta as RequestsStoreConta;
use Illuminate\Http\Request;

class ContaController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $contas = $user->contas;

        //dd($contas);
        return view('conta.index')
            ->withContas($contas);
    }

    public function consultar(){

    }


    public function create(){

        return view('conta.create');
    }

    public function store(RequestsStoreConta $request){

        $validated = $request->validated();


    }
}
