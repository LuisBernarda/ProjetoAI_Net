@extends('layout_admin')
@section('title','Estatistica' )
@section('content')
<div>Estatisticas do Utilizador</div>
@inject('User', 'App\Http\Controllers\UserController')
<div class="disc">
    <div class="disc-name">Saldo Total: <b>{{ $saldo_total=$User->sumSaldo($user) }} €</b></div>

<table class="table">
        <thead>
            <tr>

                <th>Nome Conta</th>
                <th>Saldo Total</th>
                <th>Percentagem</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($user->contas as $conta)
                <tr>

                    <td>{{$conta->nome}}</td>
                    <td>{{$conta->saldo_atual}}</td>
                    <td>{{number_format((float)($conta->saldo_atual*100)/$saldo_total, 2, '.', '')}}% </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
