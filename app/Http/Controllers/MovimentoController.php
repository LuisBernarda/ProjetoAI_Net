<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\StoreMovimento;
use App\Http\Requests\StoreMovimento as RequestsStoreMovimento;
use App\Movimento;
use App\Categoria;
use App\Conta;
use Illuminate\Http\UploadedFile;

class MovimentoController extends Controller
{
    //
     public function consultar(Movimento $movimento,Conta $conta){
        
        // if ($movimento->imagem_doc->file()) {
        //     $documento=$movimento->imagem_doc;
        // }else{
        //     $documento="";
        // }
       
            
        return view('conta.movimentos.movimento_detalhes')
            ->withMovimento($movimento);
            
            // ->withDocumento($documento);
    }

    public function create(Conta $conta){
        
        $newMovimento=new Movimento;
        $listaCategorias= Categoria::all();
        //dd($listaCategorias);
        return view('conta.movimentos.create')
            ->withMovimento($newMovimento)
            ->withCategorias($listaCategorias)
            ->withConta($conta);
    } 

    public function store(RequestsStoreMovimento $request,Conta $conta){
         $validated = $request->validated();
         //dd($validated['categoria']);
         $newMovimento=new Movimento;
         $newMovimento->conta_id=$conta->id;
         $newMovimento->data=$validated['data'];
         $newMovimento->valor=$validated['valor'];
         $newMovimento->saldo_inicial=$conta->saldo_abertura;
         if ($validated['tipo']==="D") {
             $newMovimento->saldo_final=$conta->saldo_atual-$newMovimento->valor;
         }else {
             $newMovimento->saldo_final=$conta->saldo_atual+$newMovimento->valor;
         }
         $conta->saldo_atual=$newMovimento->saldo_final;
         $newMovimento->tipo=$validated['tipo'];
         $newMovimento->categoria_id=$validated['categoria'];
         $newMovimento->descricao=$validated['descricao'];
         
         $newMovimento->save();
         $conta->save();

          //return redirect()->route('conta.movimentos.movimento_detalhes');
        return redirect()->route('conta.consultar', [$conta]);


    }

    public function edit(Conta $conta,Movimento $movimento)
    {
        return view('conta.movimentos.edit')
             ->withConta($movimento);
    }

    public function counter()
    {
        $total_movimentos = Movimento::count();
        return $total_movimentos;
    }
}
