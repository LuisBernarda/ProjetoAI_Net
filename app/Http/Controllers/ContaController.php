<?php

namespace App\Http\Controllers;

use App\Conta;
use App\User;
use Illuminate\Support\Facades\Auth;


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

        return view('conta.index')
            ->withContas($contas);
    }

    public function edit(Conta $conta)
    {
        return view('conta.edit')
            ->withConta($conta);
    }

    public function partilhas(Conta $conta){

        $qry = User::query();

        //$users = $qry->where('id', $conta->pivot->user_id);
        $users = User::findOrFail($conta->pivot->user_id);

        return view('contas.partilhas')
            ->withUsers($users);
    }

    public function consultar(Conta $conta, Request $request){

        $movimentos = $conta->movimentos();
        //dd($movimentos);
        if ($request['categoria'] != null && strcmp($request['categoria'],"null" )!=0) {
            $movimentos = $movimentos->where('categoria_id', $request['categoria']);
        }

        if ($request['tipo'] != null) {
            //$movimentos = $conta->movimentos()->where()->orderBy('data', 'DESC',)->paginate(10);
            $movimentos = $movimentos->where('tipo', $request['tipo']);
        }

        $movimentos = $movimentos->orderBy('data', 'DESC')->paginate(10);

        $listaCategorias = Categoria::all();
        return view('conta.consultar')
            ->withMovimentos($movimentos)
            ->withConta($conta)
            ->withCategorias($listaCategorias);
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

        $newConta->save();

         return redirect()->route('conta.index');


    }

    public function update(RequestsStoreConta $request, Conta $conta)
    {
        $validated_data = $request->validated();

        $conta->user_id = Auth::user()->id;
        $conta->nome = $validated_data['nome'];
        $conta->descricao = $validated_data['descricao'];
        $conta->saldo_atual = $validated_data['saldo_atual'];
        $conta->saldo_abertura = $validated_data['saldo_abertura'];
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

        return view('conta.movimento_detalhes')
            ->withMovimento($movimento)
            ->withConta($conta);
    }

    public function counter()
    {
        $total_contas = Conta::count();
        return $total_contas;
    }
}
