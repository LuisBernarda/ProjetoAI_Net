@extends('layout_admin')
@section('title','Alterar User' )
@section('content')
    <form method="POST" action="{{route('user.update', ['user' => $user]) }}" class="form-group" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="user_id" value="{{$user->id}}">
        @include('users.partials.create-edit')
        @empty($user->foto)
        @else
            <div class="form-group">
                <img src="{{$user->foto ? asset('storage/app/public/fotos/' . $duser->foto) : asset('img/default_img.png') }}"
                     alt="Foto do user"  class="img-profile"
                     style="max-width:100%">
            </div>
        @endempty
        <div class="form-group text-right">
            @empty(user->foto)
            @else
               
                    <button type="submit" class="btn btn-danger" name="deletefoto" form="form_delete_photo">Apagar Foto</button>
               
            @endempty
               
                    <button type="submit" class="btn btn-success" name="ok">Save</button>
                
                <a href="{{route('users.edit', ['user' => $user]) }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
    <form id="form_delete_photo" action="{{route('users.foto.destroy', ['user' => $user])}}" method="POST">
        @csrf
        @method('DELETE')
    </form>
@endsection

