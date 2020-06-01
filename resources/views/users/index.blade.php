@extends('layout_admin')
@section('title','Users')
@section('content')

    <div class="form-group text-left">

        <form action="{{route('users.consultar')}}" method="GET">
            @csrf
            @method("GET")
            <div class="title-items">Filtrar Users:</div>
            <hr>
                <div class="item-form">
                    <label for="nome">nome</label>
                    <input type="text" class="form-control" name="nome" id="nome" value="" style="width:45%;">   
                </div>
               
                <div class="item-form">
                    <label for="nome">email</label>
                    <input type="text" class="form-control" name="email" id="email" value="" style="width:45%;">
                </div>
            </div>
            


            <a><input type="submit" class="btn btn-secondary" value="Filtrar"></a>
        </form>
        <hr>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th></th>
                <th>Nome</th>
                <th>Email</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>
                        <img src="{{$user->foto ? asset('storage/fotos/' . $user->foto) : asset('img/default_img.png') }}" alt="Foto do User" class="img-profile rounded-circle" style="width:40px;height:40px">
                    </td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>                    
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $users->withQueryString()->links() }}
@endsection
