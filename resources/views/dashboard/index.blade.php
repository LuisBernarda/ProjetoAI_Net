@extends('layout_admin')
@section('title','Dashboard' )
@section('content')
<div>Zona de Administração</div>
<div style="width: 50%">
    {!! $movsChart->container() !!}
</div>
@endsection

