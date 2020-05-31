@extends('layout_admin')
@section('title', 'Consulta de Conta' )
@section('content')

    <h3>Conta: {{$conta->nome}}</h3>
    <h4>Saldo Inicial: <b>{{$conta->saldo_abertura}}</b> | Saldo Atual: <b>{{$conta->saldo_atual}}</b></h4>
    <p>{{$conta->descricao}}</p>

    <div class="form-group text-left">
        <a href="{{route('conta.movimentos.create',['conta'=>$conta])}}" class="btn btn-secondary">Novo Movimento</a>

        <form action="{{route('conta.consultar', ['conta' => $conta])}}" method="GET">
            @csrf
            @method("GET")

            <div id="origem-area">
                <div class="title-items">Filtrar por Tipo:</div>
                <div class="item-form">
                    <input type="radio" name="tipo" id="idTipoR" value="R" {{old('tipo')=='R'?'checked':''}}>
                    <label for="idTipoR">Receita</label>
                </div>
                <div class="item-form">
                    <input type="radio" name="tipo" id="idTipoD" value="D" {{old('tipo')=='D'?'checked':''}}>
                    <label for="idTipoD">Debito</label>
                </div>
            </div>

            <div class="item-form">
                <label for="idCategoria">Filtrar por Categoria: </label>
                <select name="categoria" id="idCcategoria">
                <option value="" selected></option>
                    @foreach($categorias as $categoria)

                        <option value={{$categoria->id}} {{old('categoria')==$categoria->id?'selected':''}}>{{$categoria->nome}}</option>

                    @endforeach
                </select>

            </div>


            <a><input type="submit" class="btn btn-secondary" value="Filtrar"></a>
        </form>

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
                    <td>{{$movimento->categoria['tipo']}}</td>
                    <td>{{$movimento->categoria['nome']}}</td>
                    <td>{{$movimento->data}}</td>
                    <td><a href="{{route('conta.movimentos.consultar', ['conta'=>$conta,'movimento' => $movimento])}}" class="btn btn-primary btn-sm" role="button" aria-pressed="true">Detalhes</a>
                        <a href="{{route('conta.movimentos.edit', ['conta'=>$conta,'movimento' => $movimento])}}" class="btn btn-primary btn-sm" role="button" aria-pressed="true">Alterar</a>
                         <a><form action="{{route('conta.movimentos.destroy', ['conta' => $conta, 'movimento' => $movimento])}}" method="POST">
                            @csrf
                            @method("DELETE")
                            <input type="submit" class="btn btn-danger btn-sm" value="Apagar">
                        </form></a>
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
