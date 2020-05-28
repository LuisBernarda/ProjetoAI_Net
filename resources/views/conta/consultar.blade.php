@extends('layout_admin')
@section('title', 'Consultar Conta' )
@section('content')
     <table class="table">
        <thead>
            <tr>

                <th>Data</th>
                <th>Movimento</th>
                <th>Saldo</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($contas as $conta)
                <tr>

                    <td>{{$conta->nome}}</td>
                    <td>{{$conta->saldo_atual}}</td>
                    <td><a href="{{route('conta.consultar', ['conta' => $conta])}}" class="btn btn-primary btn-sm" role="button" aria-pressed="true">Detalhes</a>
                        <a href="{{route('conta.edit', ['conta' => $conta])}}" class="btn btn-primary btn-sm" role="button" aria-pressed="true">Alterar</a>

                        <form action="{{route('conta.destroy', ['conta' => $conta])}}" method="POST">
                            @csrf
                            @method("DELETE")
                            <input type="submit" class="btn btn-danger btn-sm" value="Apagar">
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>



@endsection
