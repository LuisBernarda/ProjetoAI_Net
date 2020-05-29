@extends('layout_admin')
@section('title', 'Nova Conta' )
@section('content')
    <form method="POST" action="{{route('conta.store')}}" class="form-group">
        @csrf
        @include('conta.partials.create-edit')
        <div class="form-group text-right">
                <button type="submit" class="btn btn-success" name="ok">Save</button>
                <a href=9 class="btn btn-secondary">Cancel</a>
        </div>
    </form>
@endsection


