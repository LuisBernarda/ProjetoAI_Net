@extends('layout_admin')
@section('title','Partilhas')
@section('content')

    <table class="table">
        <thead>
            <tr>
                <th></th>
                <th>Nome</th>
                <th>Email</th>
                <th>Tipo</th>
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
                    <td>{{$user->pivot->so_leitura}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $users->withQueryString()->links() }}
    <div class="form-group text-left">
            <a href="{{route('conta.index')}}" class="btn btn-secondary">Voltar</a>
    </div>
@endsection
