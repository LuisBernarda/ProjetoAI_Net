@extends('layout_admin')
@section('title', 'Novo Movimento' )
@section('content')

    <form method="POST" enctype='multipart/form-data' action="{{route('conta.movimentos.store',['conta'=>$conta])}}" class="form-group">
        @csrf
        @include('conta.movimentos.partials.create')
        <div class="form-group text-right">
                <button type="submit" class="btn btn-success" name="ok">Save</button>
                <a href="{{route('conta.consultar',['conta'=>$conta])}}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
@endsection
