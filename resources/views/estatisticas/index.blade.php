@extends('layout_admin')
@section('title','Estatistica' )
@section('content')
<div>Estatisticas do Utilizador</div>
@inject('User', 'App\Http\Controllers\UserController')
<div class="disc">
    <div class="disc-name">Saldo Total:</div>
    <a class="disc-count"> {{ $saldo_total=$User->sumSaldo($user) }}</a>
    <div class="disc-name">Percentagens por Conta:</div>
    <a class="disc-count"> {{ $User->nomeContas($user) }}</a>
    @foreach($User->saldosPercent($user) as $saldo)
        <p>{{number_format((float)($saldo*100)/$saldo_total, 2, '.', '')}}%</p>
    @endforeach
</div>
@endsection
