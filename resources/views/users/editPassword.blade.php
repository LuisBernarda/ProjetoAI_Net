@extends('layout_admin')
@section('title','Alterar Password user' )
@section('content')
    <form method="POST" action="{{route('users.update', ['user' => $user]) }}" class="form-group" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="user_id" value="{{$user->id}}">
        <div class="form-group">
            <label for="inputOldPassword">Password Antiga</label>
            <input type="text" class="form-control" name="oldPassword" id="inputOldPassword" value="" >
            @error('password')
                <div class="small text-danger">{{$message}}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="inputNewPassword">Password Nova</label>
            <input type="text" class="form-control" name="newPassword" id="inputNewPassword" value="" >
            @error('password')
                <div class="small text-danger">{{$message}}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="inputConfPassword">Confirme Password</label>
            <input type="text" class="form-control" name="confPassword" id="inputConfPassword" value="" >
            @error('password')
                <div class="small text-danger">{{$message}}</div>
            @enderror
        </div>
        <div class="form-group text-right">
            <button type="submit" class="btn btn-success" name="ok">Save</button>
            <a href="{{route('apresentacao')}}" class="btn btn-secondary">Cancel</a>
        </div>
@endsection
