@extends('layout_admin')
@section('title','Alterar Password user' )
@section('content')
    <form method="POST" action="{{route('users.alterarPass', ['user' => $user]) }}" class="form-group" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="user_id" value="{{$user->id}}">
        <div class="form-group">
            <label for="oldPassword">Password Antiga</label>
            <input type="password" class="form-control" name="oldPassword" id="oldPassword" value="" >
            @error('oldPassword')
                <div class="small text-danger">{{$message}}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="newPassword">Password Nova</label>
            <input type="password" class="form-control" name="newPassword" id="newPassword" value="" >
            @error('newPassword')
                <div class="small text-danger">{{$message}}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="confPassword">Confirme Password</label>
            <input type="password" class="form-control" name="confPassword" id="confPassword" value="" >
            @error('confPassword')
                <div class="small text-danger">{{$message}}</div>
            @enderror
        </div>
        <div class="form-group text-right">
            <button type="submit" class="btn btn-success" name="ok">Save</button>
            <a href="{{route('apresentacao')}}" class="btn btn-secondary">Cancel</a>
        </div>
@endsection
