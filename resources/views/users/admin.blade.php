@extends('layout_admin')
@section('title','Users')
@section('content')

    <div class="form-group text-left">

        <form action="{{route('admin.users.consultar')}}" method="GET">
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
            
            
            <div class="item-form">
                <label for="idTipo">Filtrar por Tipo: </label>
                <select name="adm" id="idTipo">
                    <option value="" selected></option>
                    <option value="0">Normal</option>
                    <option value="1">Admin</option>
                </select>
            
                <span style="display:inline-block; width: 50px;"></span>
            
                <label for="idBlock">Filtrar por Bloqueado: </label>
                <select name="bloqueado" id="idBlock">
                    <option value="" selected></option>
                    <option value="0">Normal</option>
                    <option value="1">Bloqueado</option>
                </select>
            </div>
            <hr>

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
                <th>Tipo de User</th>
                <th>Bloqueado</th>
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
                    <td>{{$user->adm}}</td>
                    <td>{{$user->bloqueado}}</td>

                    @can('viewOthers',$user,Auth::user())
                    <td>
                          
                        <a href="{{route('users.alterarTipo', ['user' => $user])}}" class="btn btn-primary btn-sm" role="button" aria-pressed="true">Alterar tipo</a>
                        

                    </td>
                    <td>
                        
                        <a href="{{route('users.alterarBloqueio', ['user' => $user])}}" class="btn btn-primary btn-sm" role="button" aria-pressed="true">Alterar bloqueio</a>
                       
                    </td>

                   @endcan
                </tr>
            @endforeach
        </tbody>
    </table>
    
    {{ $users->withQueryString()->links() }}
@endsection

