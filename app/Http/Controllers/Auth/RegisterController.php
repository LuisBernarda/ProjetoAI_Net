<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        dd($data);
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'adm'   =>  ['required', 'boolean'],
            'bloqueado'   =>  ['required', 'boolean'],
            'NIF'   =>  ['nullable', 'integer'],
            'telefone'   =>  ['nullable'],
            'foto'      => ['nullable', 'image', 'max:8192'],            
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        
        if($data['foto'] != null){
        $imageName = time() . '.' . $data['foto']->getClientOriginalExtension();

        $data['foto']->move(
        base_path() . '/public/storage/fotos/', $imageName
        );
        } else {
            $imageName = "";
        }
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'adm'   => $data['adm'],
            'bloqueado' => $data['bloqueado'],
            'NIF' => $data['NIF'],
            'telefone' => $data['telefone'],
            'foto'  =>  $imageName,
        ]);
    }
}

/*
logica portada do UserController para ver se os sistema automatico de mails começa a funcionar.

$validated_data = $request->validated();
        //dd($validated_data);
        $newUser = new User;
        $newUser->name = $validated_data['name'];
        $newUser->email = $validated_data['email'];
        $newUser->NIF = $validated_data['NIF'];
        $newUser->telefone = $validated_data['telefone'];
        $newUser->password = Hash::make($validated_data['password']);
        $newUser->adm = $validated_data['adm'];
        $newUser->bloqueado = $validated_data['bloqueado'];
        if ($request->hasFile('foto')) {
            $path = $request->foto->store('storage/app/public/fotos');
            $newUser->foto = basename($path);
        }
        $newUser->save();
        return redirect()->route('apresentacao')
            ->with('alert-msg', 'User "' . $newUser->name . '" foi criado com sucesso!')
            ->with('alert-type', 'success');


            public function rules()
    {
        return [
           
            'name'   =>         'required',
            'password' =>       'required',
            'adm'   =>          'required|boolean',
            'bloqueado' =>      'required|boolean',
            'NIF'   =>          'nullable|integer',
            'telefone' =>       'nullable',
            'foto' =>           'nullable|image|max:8192',
            'email' => [
               'required',
               'email',
                Rule::unique('users')->ignore($this->user)],
            
        ];
    }
*/

