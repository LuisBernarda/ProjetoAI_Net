@extends('layout_admin')
@section('title', 'Alterar Movimento' )
@section('content')
     <form method="POST" enctype='multipart/form-data' action="{{route('conta.movimentos.update', ['conta'=>$conta,'movimento' => $movimento])}}" class="form-group">
        @csrf
        @method('PUT')
        <input type="hidden" name="user_id" value="{{$conta->user_id}}">
        @include('conta.movimentos.partials.create')

        <div class="form-group text-right">
                <button type="submit" class="btn btn-success" name="ok">Save</button>
                <a href="{{route('conta.consultar',['conta'=>$conta])}}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>



@endsection
