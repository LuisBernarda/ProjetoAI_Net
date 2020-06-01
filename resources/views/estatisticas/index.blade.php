@extends('layout_admin')
@section('title','Estatistica' )
@section('content')
<div>Estatisticas do Utilizador</div>
@inject('User', 'App\Http\Controllers\UserController')
<div class="disc">
    <div class="disc-name">Saldo Total:</div>
    <a class="disc-count"> {{ $User->sumSaldo($user) }}</a>
</div>
@endsection
