@extends('layout_admin')
@section('title', 'Novo User' )
@section('content')
    <form method="POST" action="{{route('users.store')}}" class="form-group" enctype="multipart/form-data">
        @csrf
        @include('users.partials.create-edit')
        <div class="form-group text-right">
                
                    <button type="submit" class="btn btn-success" name="ok">Save</button>
               
                <a href="{{route('home')}}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
@endsection
