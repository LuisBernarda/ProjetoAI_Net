@extends('layout_admin')
@section('title', 'Consulta de Conta' )
@section('content')

    <h3>Conta: {{$conta->nome}}</h3>
    <p>{{$conta->descricao}}</p>

     <table class="table">
        <thead>
            <tr>

                <th>Valor</th>
                <th>Saldo Final</th>
                <th>Tipo</th>
                <th>Categoria</th>
                <th>Data</th>

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
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="form-group text-left">
            <a href="{{route('conta.index')}}" class="btn btn-secondary">Voltar</a>
    </div>

    {{ $movimentos->withQueryString()->links() }}
@endsection
