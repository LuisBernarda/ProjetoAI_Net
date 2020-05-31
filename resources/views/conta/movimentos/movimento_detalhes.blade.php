@extends('layout_admin')
@section('title', 'Detalhes Movimento' )
@section('content')
    <h3>Conta: {{$conta->nome}}</h3>
    <p>Valor do Movimento. {{$movimento->valor}}<br>
    Saldo Inicial: {{$movimento->saldo_inicial}}<br>
    Saldo Final: {{$movimento->saldo_final}}<br>
    Tipo: {{$movimento->categoria->tipo}}<br>
    Categoria: {{$movimento->categoria->nome}}<br>
    Data do Movimento: {{$movimento->data}}<br>
    Descrição: {{$movimento->descricao}}</p>



    <div class="form-group text-left">
        <a href="{{route('conta.movimentos.upload',['conta'=>$conta,'movimento'=>$movimento])}}" class="btn btn-primary btn-sm">Mostrar Documento</a>
    </div>

    <div class="form-group text-left">
        <a href="" class="btn btn-danger btn-sm">Apagar Ficheiro</a>
    </div>

    <div class="form-group text-left">

         <a href="{{route('conta.consultar', ['conta' => $conta])}}" class="btn btn-secondary">Voltar</a>

    </div
@endsection
