<?php

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

Route::GET('/', function () {
    return view('welcome');
});

Auth::routes();

Route::GET('/home', 'HomeController@index')->name('home');
Route::POST('/pasatiempoSelect', 'PasatiempoController@pasatiempoSelect');
Route::POST('/ciudadSelect', 'PersonaController@ciudadSelect');
Route::POST('/pasatiempoCreate', 'PasatiempoController@create')->name('pasatiempoCreate');
Route::GET('/users', 'PersonaController@index')->name('users');
Route::POST('/pasatiempoUpdate', 'PasatiempoController@update')->name('pasatiempoUpdate');
Route::POST('/pasatiempoAgg', 'PasatiempoController@insert')->name('pasatiempoAgg');
Route::DELETE('/pasatiempoDelete', 'PasatiempoController@destroy')->name('pasatiempoDelete');
Route::POST('/userSelect', 'PersonaController@userSelect')->name('userSelect');
Route::POST('/userUpdate', 'PersonaController@update')->name('userUpdate');
Route::POST('/perfilSelect', 'PersonaController@perfilSelect')->name('perfilSelect');
Route::POST('/ciudadSelect', 'PersonaController@ciudadSelect')->name('ciudadSelect');
Route::POST('/ciudadSelected', 'PersonaController@ciudadSelected')->name('ciudadSelected');
Route::POST('/perfilSelect', 'PersonaController@perfilSelect')->name('perfilSelect');
Route::POST('/perfilSelected', 'PersonaController@perfilSelected')->name('perfilSelected');