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

Route::get('/', 'PageController@index')->name('home');



    // Secção de Administração
Route::get('admin', 'DashboardController@index')->name('admin.dashboard');

    //User admin
Route::get('admin/users', 'UserController@admin')->name('users');
Route::get('admin/users/{user}/alterarTipo', 'UserController@alterarTipo')->name('alterarTipo');
//Route::get('admin/users/alterarBloqueio', 'UserController@alterarBloqueio')->name('alterarBloqueio');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Secção Conta

Route::get('conta', 'ContaController@index')->name('conta.index');
Route::get('conta/create', 'ContaController@create')->name('conta.create');
Route::post('conta', 'ContaController@store')->name('conta.store');
Route::get('conta/{conta}/edit', 'ContaController@edit') ->name('conta.edit');
Route::put('conta/{conta}', 'ContaController@update')->name('conta.update');
Route::delete('conta/{conta}', 'ContaController@destroy')->name('conta.destroy');
Route::get('conta/{conta}/consultar', 'ContaController@consultar')->name('conta.consultar');
