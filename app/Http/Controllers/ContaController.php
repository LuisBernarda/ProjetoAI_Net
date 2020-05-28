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

    public function edit(Conta $conta)
    {
        return view('conta.edit')
            ->withConta($conta);


    }

    public function consultar(){

    }


    public function create(){
        $newConta = new Conta;


        return view('conta.create')
            ->withConta($newConta);
    }

    public function store(RequestsStoreConta $request){

        $validated = $request->validated();

        $newConta= new Conta;
        $newConta->user_id=Auth::user()->id;
        $newConta->nome=$validated['nome'];
        $newConta->descricao = $validated['descricao'];
        $newConta->saldo_abertura = $validated['saldo_abertura'];
        $newConta->saldo_atual = $validated['saldo_abertura'];
        //dd($validated);
        $newConta->save();

         return redirect()->route('conta.index');


    }

    public function update(RequestsStoreConta $request, Conta $conta)
    {
        $validated_data = $request->validated();

        $conta->user_id = Auth::user()->id;
        $conta->nome = $validated_data['nome'];
        $conta->descricao = $validated_data['descricao'];
        //$conta->saldo_abertura = $validated_data['saldo_abertura'];
        $conta->saldo_atual = $validated_data['saldo_atual'];
        //dd($validated);
        $conta->save();

        return redirect()->route('conta.index')
            ->with('alert-msg', 'Conta "' . $conta->nome . '" foi alterado com sucesso!')
            ->with('alert-type', 'success');;

    }


}
