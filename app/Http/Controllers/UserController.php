<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Conta;
use App\Movimento;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\SoftDeletes;
//ja n esta a ser utilizado, funcionalidades passaram para o register controller
//use App\Http\Requests\UserPost;
use App\Http\Requests\UserPostUpdate;
use App\Http\Requests\UserPostTipo;
use App\Http\Requests\UserPostBloqueado;
use App\Http\Requests\UserPostPassword;

class UserController extends Controller
{

    public function index(){
        $qry = User::query();
        $users = $qry->paginate(15);
        //dd($users);
        return view('users.index')->withUsers($users);
    }

    public function admin(){

        $qry = User::query();
        $users = $qry->paginate(15);
        //dd($users);
        return view('users.admin')
            ->withUsers($users);
    }

    public function alterarTipo(User $user){

        return view('users.alterarTipo')
            ->withUser($user);
    }

    public function alterarBloqueio(User $user){

        return view('users.alterarBloqueio')
            ->withUser($user);
    }

    public function guardarTipo(UserPostTipo $request, User $user){

        //funcional
        //problema resolvido com recurso a mais posts, se fosse feito um refactor ao codigo ver mais regras de ignore
        $validated_data = $request->validated();

        $user->adm = $validated_data['adm'];
        $user->save();
        return redirect()->route('admin.users')
            ->with('alert-msg', 'User "' . $user->name . '" foi alterado com sucesso!')
            ->with('alert-type', 'success');
    }

    public function guardarBloqueio(UserPostBloqueado $request, User $user){

        //funcional
        //problema resolvido com recurso a mais posts, se fosse feito um refactor ao codigo
        
        $validated_data = $request->validated();

        $user->bloqueado = $validated_data['bloqueado'];
        $user->save();
        return redirect()->route('admin.users')
            ->with('alert-msg', 'User "' . $user->name . '" foi alterado com sucesso!')
            ->with('alert-type', 'success');
    }

    /*
    public function create(){

        $newUser = new User;
        return view('users.create')
            ->withUser($newUser);
    }

    public function store(UserPost $request){

        //adm e bloqueado injetado (a 0) como extra com hidden na create.blade

        $validated_data = $request->validated();
        dd($validated_data);
        $newUser = new User;
        $newUser->name = $validated_data['name'];
        $newUser->email = $validated_data['email'];
        $newUser->NIF = $validated_data['NIF'];
        $newUser->telefone = $validated_data['telefone'];
        $newUser->password = Hash::make($validated_data['password']);
        $newUser->adm = $validated_data['adm'];
        $newUser->bloqueado = $validated_data['bloqueado'];
        if ($request->hasFile('foto')) {
            $path = $request->foto->store('storage/fotos');
            $newUser->foto = basename($path);
        }
        $newUser->save();
        return redirect()->route('apresentacao')
            ->with('alert-msg', 'User "' . $newUser->name . '" foi criado com sucesso!')
            ->with('alert-type', 'success');
    }
    */

    public function edit(User $user){

        return view('users.edit')
            ->withUser($user);
    }
    
    public function update(UserPostUpdate $request, User $user){

        $validated_data = $request->validated();

        $user->name = $validated_data['name'];
        $user->email = $validated_data['email'];
        $user->NIF = $validated_data['NIF'];
        $user->telefone = $validated_data['telefone'];
        if ($request->hasFile('foto')) {
            Storage::delete('storage/fotos/' . $user->foto);
            $path = $request->foto->store('storage/fotos/');
            $user->foto = basename($path);
        }

        $user->save();
        return redirect()->route('apresentacao')
            ->with('alert-msg', 'User "' . $user->name . '" foi atualizado com sucesso!')
            ->with('alert-type', 'success');
    }

    public function mudarPass(User $user)
    {
        return view('users.editPassword')
            ->withUser($user);
    }

    public function delete(User $user){

        $oldName = $user->name;

        $contas = $user->contas;
        //dd($user->contas);
        try{
            foreach($contas as $conta){
                $movimentos = $conta->movimentos;
                 //dd($movimentos);
                foreach($movimentos as $movimento){
                    $movimento->delete();
                }
                $conta->delete();
            }

            return redirect()->route('apresentacao')
            ->with('alert-msg', 'Contas de User "' . $oldName . '" foram apagadas com sucesso!')
            ->with('alert-type', 'success');
        } catch (\Throwable $th) {

            if ($th->errorInfo[1] == 1451) {   // 1451 - MySQL Error number for "Cannot delete or update a parent row: a foreign key constraint fails (%s)"
                return redirect()->route('apresentacao')
                    ->with('alert-msg', 'Não foi possível apagar as contas de user "' . $oldName . '", porque  já estão em uso!')
                    ->with('alert-type', 'danger');
            } else {
                return redirect()->route('apresentacao')
                    ->with('alert-msg', 'Não foi possível apagar as contas de user "' . $oldName . '". Erro: ' . $th->errorInfo[2])
                    ->with('alert-type', 'danger');
            }
        }
    }

    public function destroy_foto(User $user)
    {
        Storage::delete('storage/fotos/' . $user->foto);
        $user->foto = null;
        $user->save();
        return redirect()->route('users.edit', ['user' => $user])
            ->with('alert-msg', 'Foto do user "' . $user->name . '" foi removida!')
            ->with('alert-type', 'success');
    }

    public function counter()
    {
        $total_users = User::count();
        return $total_users;
    }

    public function storePassword(UserPostPassword $request, User $user)
    {
        $validated_data = $request->validated();

        if(!(Hash::check($validated_data['oldPassword'], $user->password))){
            return redirect()->back()
                ->with('alert-msg', 'Password errada!')
                ->with('alert-type', 'danger');
        }

        if(strcmp($validated_data['newPassword'], $validated_data['confPassword']) != 0){
             return redirect()->back()
                ->with('alert-msg', 'Passwords nao coincidem!')
                ->with('alert-type', 'danger');
        }

        $user->password=Hash::make($validated_data['newPassword']);
        $user->save();
        return redirect()->route('apresentacao')
            ->with('alert-msg', 'Password de "' . $user->name . '" foi atualizada com sucesso!')
            ->with('alert-type', 'success');
    }

    public function consultarUser(Request $request){

        
        $qry = User::query();

        if ($request['nome'] != null){
            $qry = $qry->where('name', 'LIKE', '%' .$request['nome']. '%');
        }

        if ($request['email'] != null){
            $qry = $qry->where('email', 'LIKE', '%' .$request['email']. '%');
        }

        $users = $qry->paginate(15);
        return view('users.index')->withUsers($users);
    }

    public function consultarAdm(Request $request){

        $qry = User::query();
       

        if ($request['nome'] != null){
            $qry = $qry->where('name', 'like', '%' . $request['nome'] . '%');
        }

        if ($request['email'] != null){
            $qry = $qry->where('email', 'like', '%' . $request['email'] . '%');
        }

        if ($request['adm'] != null){
            $qry = $qry->where('adm', $request['adm'] );
        }

        if ($request['bloqueado'] != null){
            $qry = $qry->where('bloqueado', $request['bloqueado']);
        }

        $users = $qry->paginate(15);
        return view('users.admin')->withUsers($users);
    }

}
