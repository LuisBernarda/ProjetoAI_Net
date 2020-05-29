@extends('layout_admin')
@section('title','Users')
@section('content')

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
                        <img src="{{$user->foto ? asset('storage/app/public/fotos/' . $user->foto) : asset('img/default_img.png') }}" alt="Foto do User" class="img-profile rounded-circle" style="width:40px;height:40px">
                    </td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->adm}}</td>
                    <td>{{$user->bloqueado}}</td>
                     <td>
                    <a href="{{route('alterarTipo', ['user' => $user])}}" class="btn btn-primary btn-sm" role="button" aria-pressed="true">Alterar tipo</a>
                    </td>
                    <td>
                    <a href="{{route('alterarBloqueio', ['user' => $user])}}" class="btn btn-primary btn-sm" role="button" aria-pressed="true">Alterar bloqueio</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $users->withQueryString()->links() }}
@endsection

