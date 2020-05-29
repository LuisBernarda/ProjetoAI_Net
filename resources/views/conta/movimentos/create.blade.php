@extends('layout_admin')
@section('title', 'Novo Movimento' )
@section('content')

    <form method="POST" action="{{route('conta.movimentos.store',['conta'=>$conta])}}" class="form-group">
        @csrf
        @include('conta.movimentos.partials.create')
        <div class="form-group text-right">
                <button type="submit" class="btn btn-success" name="ok">Save</button>
                <a href="{{url()->previous()}}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
@endsection