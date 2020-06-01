@extends('layout_admin')
@section('title', 'Contas do Utilizador' )
@section('content')
<div class="form-group text-left">
    <a href="{{route('conta.create')}}" class="btn btn-secondary">Nova Conta</a>
</div>
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
                    <td><a href="{{route('conta.consultar', ['conta' => $conta])}}" class="btn btn-primary btn-sm" role="button" aria-pressed="true">Detalhes</a>
                        <a href="{{route('conta.edit', ['conta' => $conta])}}" class="btn btn-primary btn-sm" role="button" aria-pressed="true">Alterar</a>
                        <a href="{{route('conta.partilhas', ['conta' => $conta])}}" class="btn btn-primary btn-sm" role="button" aria-pressed="true">Partilhas</a>

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

  {{-- {{ $conta->withQueryString()->links() }} --}}



@endsection
