@extends('layout_admin')
@section('title', 'Novo User' )
@section('content')
    <form method="POST" action="{{route('users.store')}}" class="form-group" enctype="multipart/form-data">
        @csrf
        @include('users.partials.create-edit')
        <div class="form-group">
            <label for="inputPassword">Password</label>
            <input type="text" class="form-control" name="password" id="inputPassword" value="{{old('password', $user->password)}}" >
            @error('password')
                <div class="small text-danger">{{$message}}</div>
            @enderror
        </div>
        <div class="form-group text-right">  
            <button type="submit" class="btn btn-success" name="ok">Save</button>
            <a href="{{route('apresentacao')}}" class="btn btn-secondary">Cancel</a>
        </div>
        <input type="hidden" name="adm" value="0" >
        <input type="hidden" name="bloqueado" value="0" >
    </form>
@endsection
