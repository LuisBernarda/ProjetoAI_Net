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
