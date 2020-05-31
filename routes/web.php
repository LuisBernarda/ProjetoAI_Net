<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'PageController@index')->name('apresentacao');
Route::get('users/create', 'UserController@create')->name('users.create');
Route::post('users', 'UserController@store')->name('users.store');


    // Secção de Administração
Route::get('admin', 'DashboardController@index')->name('admin.dashboard')
    ->middleware('can:viewAdm,App\User');
    

    //Seccao users
Route::middleware('auth')->group(function () {
    Route::get('users', 'UserController@index')->name('users.index');
    Route::get('users/{user}/edit', 'UserController@edit')->name('users.edit')
        ->middleware('verified');
    Route::get('users/{user}/editPassword', 'UserController@mudarPass')->name('users.mudarPass')
        ->middleware('verified');
    Route::put('users/{user}', 'UserController@update')->name('users.update')
        ->middleware('verified');
    Route::delete('users/{user}/foto', 'UserController@destroy_foto')->name('users.foto.destroy')
        ->middleware('verified');
});

    //seccao adm users
    Route::middleware('auth')->group(function () {
Route::get('admin/users', 'UserController@admin')->name('admin.users')
    ->middleware('verified')
    ->middleware('can:viewAdm,App\User');
Route::put('admin/users/{user}/bloqueio', 'UserController@guardarBloqueio')->name('users.guardar.Bloqueio')
    ->middleware('verified');
Route::put('admin/users/{user}/tipo', 'UserController@guardarTipo')->name('users.guardar.Tipo')
    ->middleware('verified');
Route::get('admin/users/{user}/alterarTipo', 'UserController@alterarTipo')->name('users.alterarTipo')
    ->middleware('verified');
Route::get('admin/users/{user}/alterarBloqueio', 'UserController@alterarBloqueio')->name('users.alterarBloqueio')
    ->middleware('verified');
});

//Secção Conta

Route::get('conta', 'ContaController@index')->name('conta.index');
Route::get('conta/create', 'ContaController@create')->name('conta.create');
Route::get('conta/{conta}/consultar', 'ContaController@consultar')->name('conta.consultar');
Route::get('conta/{conta}/edit', 'ContaController@edit')->name('conta.edit');
Route::post('conta', 'ContaController@store')->name('conta.store');
Route::put('conta/{conta}', 'ContaController@update')->name('conta.update');
Route::delete('conta/{conta}', 'ContaController@destroy')->name('conta.destroy');



//Movimentos
Route::get('conta/{conta}/{movimento}/upload', 'MovimentoController@upload')->name('conta.movimentos.upload');
Route::get('conta/{conta}/{movimento}/detalhes', 'MovimentoController@consultar')->name('conta.movimentos.consultar');
Route::get('conta/{conta}/create', 'MovimentoController@create')->name('conta.movimentos.create');
Route::get('conta/{conta}/{movimento}/edit', 'MovimentoController@edit') ->name('conta.movimentos.edit');
Route::put('conta/{conta}/{movimento}/edit', 'MovimentoController@update')->name('conta.movimentos.update');
Route::delete('conta/{conta}/{movimento}', 'MovimentoController@destroy')->name('conta.movimentos.destroy');
Route::post('conta/{conta}', 'MovimentoController@store')->name('conta.movimentos.store');


Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

