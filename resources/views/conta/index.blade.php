@extends('layout_admin')
@section('content')
    <h1>CONTA INDEX</h1>


    <a href="{{route('conta.create')}}" class="btn btn-secondary">Create</a>

    <table class="table">
        <thead>
            <tr>

                <th>Nome</th>
                <th>Saldo</th>
                <th>Acções</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($contas as $conta)
                <tr>

                    <td>{{$conta->nome}}</td>
                    <td>{{$conta->saldo_atual}}</td>
                    <td><a class="btn btn-primary btn-sm" role="button" aria-pressed="true">Detalhes</a></td>

                </tr>
            @endforeach
        </tbody>
    </table>





@endsection
