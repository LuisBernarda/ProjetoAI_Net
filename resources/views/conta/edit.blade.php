@extends('layout_admin')
@section('title', 'Atualizar Conta' )
@section('content')
    <form method="POST" action="{{route('conta.update', ['conta' => $conta])}}" class="form-group">
        @csrf
        @method('PUT')
        <input type="hidden" name="user_id" value="{{$conta->user_id}}">
        @include('conta.partials.create-edit')
        {{-- @include('conta.partials.edit') --}}
        <div class="form-group text-right">
                <button type="submit" class="btn btn-success" name="ok">Save</button>
                <a href="{{route('conta.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
@endsection
