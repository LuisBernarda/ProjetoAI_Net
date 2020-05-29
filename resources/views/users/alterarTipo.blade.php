@extends('layout_admin')
@section('title','Alterar Tipo' )
@section('content')
    <form method="POST" action="{{route('users.storeTipo', ['user' => $user]) }}" class="form-group" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <div class="form-check form-check-inline">
                <input type="hidden" name="adm" value="0">
                <input type="checkbox" class="form-check-input" id="adm" name="adm" value="1" {{old('adm', $user->adm) == '1' ? 'checked' : ''}}>
                <label class="form-check-label" for="adm">
                    Administrador
                </label>
            </div>
            @error('adm')
                <div class="small text-danger">{{$message}}</div>
            @enderror
            <div class="form-group text-right">
                <button type="submit" class="btn-success" name="ok">Guardar</button>
                <a href="{{route('admin.users', ['user' => $user]) }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </div>
    </form>
@endsection
