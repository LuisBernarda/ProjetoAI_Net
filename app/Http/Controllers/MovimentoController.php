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

    public function consultar(Conta $conta, Movimento $movimento)
    {

        return view('conta.movimentos.movimento_detalhes')
            ->withConta($conta)
            ->withMovimento($movimento);
    }

    public function create(Conta $conta)
    {

        $newMovimento = new Movimento;
        $listaCategorias = Categoria::all();
        //dd($listaCategorias);
        return view('conta.movimentos.create')
            ->withMovimento($newMovimento)
            ->withCategorias($listaCategorias)
            ->withConta($conta);
    }

    public function store(RequestsStoreMovimento $request, Conta $conta)
    {

        $validated = $request->validated();

        if (strcmp($validated['tipo'], Categoria::where('id', $validated['categoria'])->get()->first()->tipo) != 0) {

            return redirect()->back()
                ->with('alert-msg', 'Não foi possível inserir o tipo de despesa, invalido!')
                ->with('alert-type', 'danger');
        }

        $newMovimento = new Movimento;

        $newMovimento->conta_id = $conta->id;
        $newMovimento->data = $validated['data'];
        $newMovimento->valor = $validated['valor'];
        //$newMovimento->saldo_inicial = $conta->saldo_atual;
        $newMovimento->tipo = $validated['tipo'];
        $newMovimento->categoria_id = $validated['categoria'];
        $newMovimento->descricao = $validated['descricao'];

        $newMovimento = $this->updateMovimento($validated, $conta, $newMovimento);


        // if ($validated['tipo'] === "D") {
        //     $newMovimento->saldo_final = $conta->saldo_atual - $newMovimento->valor;
        // } else {
        //     $newMovimento->saldo_final = $conta->saldo_atual + $newMovimento->valor;
        // }

        //$conta->saldo_atual = $newMovimento->saldo_final;

        if ($newMovimento->save()) {
            $this->saveFile($request, $newMovimento);
        }

        $conta->save();

        $this->updateMovimentos($conta, $newMovimento);

        return redirect()->route('conta.consultar', [$conta]);
    }

    public function saveFile(RequestsStoreMovimento $request, Movimento $movimento)
    {
        $file = $request->file('fileToUpload');
        if ($file != null) {
            Storage::disk('local')->put('movimentos/' . $movimento->id . '.' . $file->extension(), $file->get());
            $movimento->imagem_doc = $movimento->id . '.' . $file->extension();
            $movimento->save();
        }
    }

    public function edit(Conta $conta, Movimento $movimento)
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

        $movimento = $this->updateMovimento($validated, $conta, $movimento);


        //$conta->saldo_atual = $movimento->saldo_final;

        $movimento->data = $validated['data'];
        $movimento->tipo = $validated['tipo'];
        $movimento->categoria_id = $validated['categoria'];
        $movimento->descricao = $validated['descricao'];

        if ($movimento->save()) {

            $this->saveFile($request, $movimento);
        }

        $conta->save();

        $this->updateMovimentos($conta, $movimento);
        //dd("PASSOu");

        return redirect()->route('conta.consultar', [$conta]);
    }

    public function updateMovimentos(Conta $conta, Movimento $movimento)
    {

        $listaMovimentos = $conta->movimentos();
        $listaMovimentos = $listaMovimentos->whereDate('data', '>=', date($movimento->data))->get();
        //dd($listaMovimentos);
        for ($i = 1; $i < sizeof($listaMovimentos); $i++) {
            if ($listaMovimentos[$i]->tipo === "R") {
                $listaMovimentos[$i]->saldo_inicial = $listaMovimentos[$i - 1]->saldo_final;
                $listaMovimentos[$i]->saldo_final = $listaMovimentos[$i]->valor + $listaMovimentos[$i]->saldo_inicial;
                $listaMovimentos[$i]->save();
            } else {
                $listaMovimentos[$i]->saldo_inicial = $listaMovimentos[$i - 1]->saldo_final;
                $listaMovimentos[$i]->saldo_final = $listaMovimentos[$i]->saldo_inicial - $listaMovimentos[$i]->valor;
                $listaMovimentos[$i]->save();
            }
        }

        //dd(sizeof($listaMovimentos)-1);
        if (sizeof($listaMovimentos) > 0) {
            $conta->saldo_atual = $listaMovimentos[sizeof($listaMovimentos) - 1]->saldo_final;
            $conta->save();
        }
    }

    public function updateMovimento(array $validated, Conta $conta, Movimento $movimento)
    {

        $listaMovimentos = $conta->movimentos();
        if ($movimento->id == null) {
            $movimentosAnterior = $listaMovimentos->whereDate('data', '<=', date($movimento->data))
                ->orderBy('data', 'DESC')->get();
        } else {
            $movimentosAnterior = $listaMovimentos->whereDate('data', '<=', date($movimento->data))
                ->where('id', '<>', $movimento->id)
                ->orderBy('data', 'DESC')->get();
        }


        if (sizeof($movimentosAnterior) < 1) {
            $movimento->saldo_inicial = $conta->saldo_abertura;
        } else {
            $movimento->saldo_inicial = $movimentosAnterior[0]->saldo_final;
        }

        $movimento->valor = $validated['valor'];
        if ($validated['tipo'] === "R") {

            $movimento->saldo_final = $movimento->valor + $movimento->saldo_inicial;
            return $movimento;
        } elseif ($validated['tipo'] === "D") {

            $movimento->saldo_final = $movimento->saldo_inicial - $validated['valor'];
            return $movimento;
        }

        return $movimento;
    }

    public function destroy(Conta $conta, Movimento $movimento)
    {
        $oldMovimento = $movimento->id;

        if ($movimento->tipo === "R") {
            $movimento->saldo_final = $movimento->saldo_final - $movimento->valor;
        } else {
            $movimento->saldo_final = $movimento->saldo_final + $movimento->valor;
        }
        $movimento->save();
        $this->updateMovimentos($conta, $movimento);

        try {
            $movimento->delete();
            return redirect()->route('conta.consultar', [$conta])
                ->with('alert-msg', 'Movimento da categoria "' . $movimento->categoria->nome . '" com o valor "' . $movimento->valor . '" foi apagado com sucesso!')
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

        $path = storage_path('app/movimentos/' . $movimento->imagem_doc);

        if (Storage::exists('app/movimentos/' . $movimento->imagem_doc)) {
            return response()->file($path);
        }
        // $file=Storage::get('movimentos/' . $movimento->imagem_doc);

        return redirect()->back()
            ->withMovimento($movimento)
            ->withConta($conta)
            ->with('alert-msg', 'Este Movimento não contém um Documento associado')
            ->with('alert-type', 'danger');

        // $file = File::get($path);
        // $type = File::mimeType($path);

        // $response = Response::make($file, 200);
        // $response->header("Content-Type", $type);

        // return $response;
    }

    public function deleteFile()
    {

    }



    public function counter()
    {
        $total_movimentos = Movimento::count();
        return $total_movimentos;
    }
}
