<?php

namespace App\Http\Controllers;

use App\Conta;
use Illuminate\Support\Facades\Auth;

// use App\Http\Controllers\StoreConta;
use App\Http\Requests\StoreConta as RequestsStoreConta;
use App\Movimento;
use App\Categoria;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

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

    public function consultar(Conta $conta){


        //$movimentos = $conta->movimentos()->orderBy('data')->paginate(10);
        $movimentos = $conta->movimentos()->orderBy('data','DESC')->paginate(10);
        return view('conta.consultar')
            ->withMovimentos($movimentos)
            ->withConta($conta);
            // ->withCategoria($categoria);

        //dd($categoria);



    }


    public function create(){
        $newConta = new Conta;


        return view('conta.create')
            ->withConta($newConta);
    }

    public function store(RequestsStoreConta $request){
        //dd("STORE");
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
            ->with('alert-type', 'success');

    }

    public function destroy(Conta $conta)
    {
        $oldName = $conta->nome;

        try {
            $conta->delete();
            return redirect()->route('conta.index')
                ->with('alert-msg', 'Conta "' . $conta->nome . '" foi apagado com sucesso!')
                ->with('alert-type', 'success');
        } catch (\Throwable $th) {
            // $th é a exceção lançada pelo sistema - por norma, erro ocorre no servidor BD MySQL
            // Descomentar a próxima linha para verificar qual a informação que a exceção tem
            //dd($th, $th->errorInfo);

            if ($th->errorInfo[1] == 1451) {   // 1451 - MySQL Error number for "Cannot delete or update a parent row: a foreign key constraint fails (%s)"
                return redirect()->route('conta.index')
                    ->with('alert-msg', 'Não foi possível apagar a Conta "' . $oldName . '", porque esta conta já está em uso!')
                    ->with('alert-type', 'danger');
            } else {
                return redirect()->route('conta.index')
                    ->with('alert-msg', 'Não foi possível apagar a Conta "' . $oldName . '". Erro: ' . $th->errorInfo[2])
                    ->with('alert-type', 'danger');
            }
        }
    }

    public function detalhesMovimento(Movimento $movimento,Conta $conta){

        // if ($movimento->imagem_doc->file()) {
        //     $documento=$movimento->imagem_doc;
        // }else{
        //     $documento="";
        // }

            //dd($conta);
        return view('conta.movimento_detalhes')
            ->withMovimento($movimento);
    }

    public function counter()
    {
        $total_contas = Conta::count();
        return $total_contas;
    }
}
