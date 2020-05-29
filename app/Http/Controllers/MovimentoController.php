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
            ->withCategorias($listaCategorias);
    } 

    public function store(RequestsStoreMovimento $request,Conta $conta){
         $validated = $request->validated();
         
         $newMovimento=new Movimento;
         $newMovimento->conta_id=$conta->id;
         $newMovimento->data=$validated['data'];
         $newMovimento->valor=$validated['valor'];
         $newMovimento->saldo_inicial=$conta->saldo_abertura;
         if ($validated['tipo']==="D") {
             $newMovimento->saldo_final=$conta->saldo_atual-$newMovimento->valor;
         }
         $newMovimento->saldo_final



    }
}
