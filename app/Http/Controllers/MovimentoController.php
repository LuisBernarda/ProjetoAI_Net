<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\StoreMovimento;

use App\Http\Requests\StoreMovimento as RequestsStoreMovimento;
use App\Movimento;
use App\Categoria;
use App\Conta;


use Illuminate\Support\Facades\Storage;



class MovimentoController extends Controller
{
    //
     public function consultar(Conta $conta, Movimento $movimento){

        // if ($movimento->imagem_doc->file()) {
        //     $documento=$movimento->imagem_doc;
        // }else{
        //     $documento="";
        // }


        return view('conta.movimentos.movimento_detalhes')
            ->withMovimento($movimento)
            ->withConta($conta);

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

        if (strcmp($validated['tipo'],Categoria::where('id', $validated['categoria'])->get()->first()->tipo)!=0) {

            return redirect()->back()
                ->with('alert-msg', 'Não foi possível inserir o tipo de despesa, invalido!')
                ->with('alert-type', 'danger');
        }
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

         if ($newMovimento->save()) {

            $file = $request->file('fileToUpload');
            Storage::disk('local')->put('movimentos/'.$newMovimento->id.'.'.$file->extension(), $file->get());
            $newMovimento->imagem_doc= $newMovimento->id . '.' . $file->extension();
            $newMovimento->save();

         }


         $conta->save();


        return redirect()->route('conta.consultar', [$conta]);


    }

    public function edit(Conta $conta,Movimento $movimento)
    {
        $listaCategorias = Categoria::all();
        return view('conta.movimentos.edit')
             ->withMovimento($movimento)
             ->withConta($conta)
             ->withCategorias($listaCategorias);
    }


    public function update(RequestsStoreMovimento $request, Conta $conta, Movimento $movimento)
    {

        $validated = $request->validated();

        if (strcmp($validated['tipo'], Categoria::where('id', $validated['categoria'])->get()->first()->tipo) != 0) {

            return redirect()->back()
            ->with('alert-msg', 'Não foi possível inserir o tipo de despesa, invalido!')
            ->with('alert-type', 'danger');
        }

        if($validated['tipo']===$movimento->tipo){

            if ($validated['tipo'] === "R") {

                if ($movimento->valor > $validated['valor']) {
                    $movimento->valor = $movimento->valor - $validated['valor'];

                } elseif ($movimento->valor < $validated['valor']) {
                    $movimento->valor = $validated['valor'] - $movimento->valor;

                } else {
                    $movimento->saldo_final = $conta->saldo_atual + $movimento->valor;
                }
            } elseif ($validated['tipo'] === "D") {

                if ($movimento->valor < $validated['valor']) {
                    $movimento->valor = $validated['valor'] - $movimento->valor;

                } elseif ($movimento->valor > $validated['valor']) {
                    $movimento->valor = $movimento->valor - $validated['valor'];

                } else {
                    $movimento->saldo_final = $conta->saldo_atual - $movimento->valor;
                }

        }else {

            if ($validated['tipo'] === "R") {

                if ($movimento->valor > $validated['valor']) {
                    $movimento->valor = $movimento->valor - $validated['valor'];

                }elseif ($movimento->valor < $validated['valor']) {
                    $movimento->valor = $validated['valor'] - $movimento->valor;

                }else {
                    $movimento->saldo_final = $conta->saldo_atual + $movimento->valor;
                }

            } elseif ($validated['tipo'] === "D") {

                if ($movimento->valor < $validated['valor']) {
                    $movimento->valor = $validated['valor'] - $movimento->valor;

                }elseif($movimento->valor > $validated['valor']) {
                    $movimento->valor = $movimento->valor - $validated['valor'];

                }else {
                    $movimento->saldo_final = $conta->saldo_atual - $movimento->valor;
                }
            }
        }
    }

        $conta->saldo_atual = $movimento->saldo_final;

        $movimento->data = $validated['data'];
        $movimento->tipo = $validated['tipo'];
        $movimento->categoria_id = $validated['categoria'];
        $movimento->descricao = $validated['descricao'];

        if ($movimento->save()) {

            $file = $request->file('fileToUpload');
            Storage::disk('local')->put('movimentos/' . $movimento->id . '.' . $file->extension(), $file->get());
            $movimento->imagem_doc = $movimento->id . '.' . $file->extension();
            $movimento->save();
        }
        $conta->save();

        //return redirect()->route('conta.movimentos.movimento_detalhes');
        return redirect()->route('conta.consultar', [$conta]);


    }

    public function destroy(Conta $conta, Movimento $movimento)
    {
        $oldMovimento = $movimento->id;
        //dd($movimento);

        try {
            $movimento->delete();
            return redirect()->route('conta.consultar', [$conta])
            ->with('alert-msg', 'Movimento da categoria "' . $movimento->categoria->nome . '" com o valor "'. $movimento->valor .'" foi apagado com sucesso!')
            ->with('alert-type', 'success');
        } catch (\Throwable $th) {
            // $th é a exceção lançada pelo sistema - por norma, erro ocorre no servidor BD MySQL
            // Descomentar a próxima linha para verificar qual a informação que a exceção tem
            //dd($th, $th->errorInfo);

            if ($th->errorInfo[1] == 1451) {   // 1451 - MySQL Error number for "Cannot delete or update a parent row: a foreign key constraint fails (%s)"
                return redirect()->route('conta.consultar', [$conta])
                ->with('alert-msg', 'Não foi possível apagar este Movimento "' . $oldMovimento . '", porque este movimento está em uso!')
                ->with('alert-type', 'danger');
            } else {
                return redirect()->route('conta.consultar', [$conta])
                    ->with('alert-msg', 'Não foi possível apagar este Movimento "' . $oldMovimento . '". Erro: ' . $th->errorInfo[2])
                    ->with('alert-type', 'danger');
            }
        }

    }

    public function upload($conta, Movimento $movimento)
    {
        //dd("estou aqui");
        $path = storage_path('app/movimentos/'. $movimento->imagem_doc);
        //dd();
        //
        // $path= Storage::exists('movimentos/' . $movimento->imagem_doc);
        // $file=Storage::get('movimentos/' . $movimento->imagem_doc);
        return response()->file($path);

        // $file = File::get($path);
        // $type = File::mimeType($path);

        // $response = Response::make($file, 200);
        // $response->header("Content-Type", $type);

        // return $response;
    }



    public function counter()
    {
        $total_movimentos = Movimento::count();
        return $total_movimentos;
    }
}
