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

    // Secção de Administração
Route::get('admin', 'DashboardController@index')->name('admin.dashboard');

    //Seccao users

Route::get('users', 'UserController@index')->name('users.index');
Route::get('users/create', 'UserController@create')->name('users.create');
Route::get('users/{user}/edit', 'UserController@edit')->name('users.edit');
Route::get('users/{user}/editPassword', 'UserController@mudarPass')->name('users.mudarPass');
Route::post('users', 'UserController@store')->name('users.store');
Route::put('users/{user}', 'UserController@update')->name('users.update');
Route::delete('users/{user}/foto', 'UserController@destroy_foto')->name('users.foto.destroy');


    //seccao adm users
Route::get('admin/users', 'UserController@admin')->name('admin.users');
Route::put('admin/users/{user}', 'UserController@storeBloqueio')->name('users.storeBloqueio');
Route::put('admin/users/{user}', 'UserController@storeTipo')->name('users.storeTipo');
Route::get('admin/users/{user}/alterarTipo', 'UserController@alterarTipo')->name('users.alterarTipo');
Route::get('admin/users/{user}/alterarBloqueio', 'UserController@alterarBloqueio')->name('users.alterarBloqueio');


//Secção Conta

Route::get('conta', 'ContaController@index')->name('conta.index');
Route::get('conta/create', 'ContaController@create')->name('conta.create');
Route::post('conta', 'ContaController@store')->name('conta.store');
Route::get('conta/{conta}/edit', 'ContaController@edit') ->name('conta.edit');
Route::put('conta/{conta}', 'ContaController@update')->name('conta.update');
Route::delete('conta/{conta}', 'ContaController@destroy')->name('conta.destroy');
Route::get('conta/{conta}/consultar', 'ContaController@consultar')->name('conta.consultar');


//Movimentos
Route::get('conta/{movimento}/detalhes', 'MovimentoController@consultar')->name('conta.movimentos.consultar');
Route::get('conta//{conta}/create', 'MovimentoController@create')->name('conta.movimentos.create');
Route::post('conta/{conta}', 'MovimentoController@store')->name('conta.movimentos.store');
Route::get('conta/{conta}/{movimento}/edit', 'MovimentoController@edit') ->name('conta.movimentos.edit');
Route::put('conta/{conta}/{movimento}/edit', 'MovimentoController@update')->name('conta.movimentos.update');
Route::delete('conta/{conta}/{movimento}', 'MovimentoController@destroy')->name('conta.movimentos.destroy');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

