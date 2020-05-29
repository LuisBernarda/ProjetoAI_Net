@extends('layout_admin')
@section('title','Alterar User' )
@section('content')
    <form method="POST" action="{{route('user.update', ['user' => $user]) }}" class="form-group" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="user_id" value="{{$user->id}}">
        <div class="form-group">
            <label for="inputOldPassword">Password Antiga</label>
            <input type="text" class="form-control" name="oldPassword" id="inputOldPassword" value="{{old('oldPassword', $user->password)}}" >
            @error('password')
                <div class="small text-danger">{{$message}}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="inputNewPassword">Password nova</label>
            <input type="text" class="form-control" name="newPassword" id="inputNewPassword" value="{{old('newPassword', $user->password)}}" >
            @error('password')
                <div class="small text-danger">{{$message}}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="inputConfPassword">Confirme Password</label>
            <input type="text" class="form-control" name="confPassword" id="inputConfPassword" value="{{old('confPassword', $user->password)}}" >
            @error('password')
                <div class="small text-danger">{{$message}}</div>
            @enderror
        </div>
@endsection
