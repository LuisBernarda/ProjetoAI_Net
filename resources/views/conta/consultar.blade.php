@extends('layout_admin')
@section('title', 'Consulta de Conta' )
@section('content')

    <h3>Conta: {{$conta->nome}}</h3>
    <h4>Saldo Inicial: <b>{{$conta->saldo_abertura}}</b> | Saldo Atual: <b>{{$conta->saldo_atual}}</b></h4>
    <p>{{$conta->descricao}}</p>
    <div class="form-group text-left">
            
            <a href="{{route('conta.movimentos.create',['conta'=>$conta])}}" class="btn btn-secondary">Novo Movimento</a>
    </div>
     <table class="table">
        <thead>
            <tr>

                <th>Valor</th>
                <th>Saldo Final</th>
                <th>Tipo</th>
                <th>Categoria</th>
                <th>Data</th>
                <th>Acções</th>
                

            </tr>
        </thead>
        <tbody>
            @foreach ($movimentos as $movimento)
                <tr>

                    <td>{{$movimento->valor}}</td>
                    <td>{{$movimento->saldo_final}}</td>
                    <td>{{$movimento->categoria->tipo}}</td>
                   
                    <td>{{$movimento->categoria->nome}}</td>
                    <td>{{$movimento->data}}</td>
                    <td><a href="{{route('conta.movimentos.consultar', ['movimento' => $movimento])}}" class="btn btn-primary btn-sm" role="button" aria-pressed="true">Detalhes</a>
                        <a href="{{route('conta.movimentos.edit', ['conta'=>$conta,'movimento' => $movimento])}}" class="btn btn-primary btn-sm" role="button" aria-pressed="true">Alterar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $movimentos->withQueryString()->links() }}
     <div class="form-group text-left">
            <a href="{{route('conta.index')}}" class="btn btn-secondary">Voltar</a>
    </div>
@endsection
