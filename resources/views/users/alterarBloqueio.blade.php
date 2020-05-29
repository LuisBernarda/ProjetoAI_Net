@extends('layout_admin')
@section('title','Alterar Bloqueio' )
@section('content')
    <form method="POST" action="{{route('users.storeBloqueio', ['user' => $user])}}" class="form-group">
        @csrf
        @method('PUT')
        <div class="form-group">
            <div class="form-check form-check-inline">
                <input type="hidden" name="bloqueado" value="0">
                <input type="checkbox" class="form-check-input" id="inputBloqueado" name="bloqueado" value="1" {{old('bloqueado', $user->bloqueado) == '1' ? 'checked' : ''}}>
                <label class="form-check-label" for="inputBloqueado">
                    Bloqueado
                </label>
            </div>
            @error('bloqueado')
                <div class="small text-danger">{{$message}}</div>
            @enderror
            <div class="form-group text-right">
                <button type="submit" class="btn-success" name="ok">Guardar</button>
                <a href="{{route('admin.users', ['user' => $user]) }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </div>
    </form>
@endsection
