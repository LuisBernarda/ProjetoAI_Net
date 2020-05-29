<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserPost;


class UserController extends Controller
{

    public function index(){
        $qry = User::query();
        $users = $qry->paginate(10);
        //dd($users);
        return view('users.index')->withUsers($users);
    }
    
    public function admin(){

        $qry = User::query();
        $users = $qry->paginate(15);
        //dd($users);
        return view('users.admin')->withUsers($users);
    }

    public function alterarTipo(User $user){
        
        return view('users.alterarTipo')
            ->withUser($user);
    }

    public function alterarBloqueio(User $user){
        
        return view('users.alterarBloqueio')
            ->withUser($user);
    }

    public function storeTipo(UserPost $request, User $user){

        //not functional
        $user->adm = $request->adm;
        $user->save();
        return redirect()->route('admin.users')
            ->with('alert-msg', 'User "' . $user->name . '" foi alterado com sucesso!')
            ->with('alert-type', 'success');
    }

    public function storeBloqueio(UserPost $request, User $user){

        //not functional
        
        $validated_data = $request->only($this->bloqueado);
        $user->bloqueado = $validated_data;
        $user->save;
        return redirect()->route('admin.users')
            ->with('alert-msg', 'User "' . $user->name . '" foi alterado com sucesso!')
            ->with('alert-type', 'success');
    }

    public function create(){

        $newUser = new User;
        return view('users.create')
            ->withUser($newUser);
    }

    public function store(UserPost $request){

        $validated_data = $request->validated();

        $newUser = new User;
        $newUser->name = $validated_data['name'];
        $newUser->email = $validated_data['email'];
        $newUser->NIF = $validated_data['NIF'];
        $newUser->telefone = $validated_data['telefone'];
        $newUser->password = Hash::make($validated_data['password']);
        $newUser->adm = '0';
        $newUser->bloqueado = '0';
        if ($request->hasFile('foto')) {
            $path = $request->foto->store('storage/app/public/fotos');
            $newUser->foto = basename($path);
        }
        $newUser->save();

        /*
        //todo alert msg quando rotas tiverem OK
        return redirect()->route('#')
            ->with('alert-msg', 'User "' . $validated_data['name'] . '" foi criado com sucesso!')
            ->with('alert-type', 'success');
        */
    }

    public function edit(User $user){

        return view('users.edit')
            ->withUser($user);
    }

    public function update(UserPost $request, User $user){

        $validated_data = $request->validated();

        $user->name = $validated_data['name'];
        $user->email = $validated_data['email'];
        $user->NIF = $validated_data['NIF'];
        $user->telefone = $validated_data['telefone'];
        if ($request->hasFile('foto')) {
            Storage::delete('storage/app/public/fotos' . $user->foto);
            $path = $request->foto->store('storage/app/public/fotos');
            $user->foto = basename($path);
        }

        $user->save();

        /*
        //todo alert msg quando rotas tiverem OK
        return redirect()->route('#')
            ->with('alert-msg', 'User "' . $validated_data['name'] . '" foi atualizado com sucesso!')
            ->with('alert-type', 'success');
        */
    }

    public function mudarPass(User $user)
    {
        return view('users.editPassword')
            ->withUser($user);
    }

    public function delete(){
        //todo
        //quando tiver mais ou menos os outros a trabalhar tendo em conta que esta apaga todos os movimentos e contas que pertencem ao utilizador
    }

    public function destroy_foto(User $user)
    {
        Storage::delete('public/app/public/fotos/' . $user->foto);
        $user->foto = null;
        $user->save();
        return redirect()->route('users.edit', ['user' => $user])
            ->with('alert-msg', 'Foto do user "' . $user->name . '" foi removida!')
            ->with('alert-type', 'success');
    }

    

}
