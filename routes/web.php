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


Auth::routes();

// ROUTES ADMIN [GET]
Route::get('/admin', 'AdminController@index')->name('paineladmin');

Route::get('/admin/trabalho/{id}', 'AdminController@verTrabalho')->name('paineladmintrabalho');


// ROUTES [GET]
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', 'HomeController@index')->name('home');

Route::get('/incluir', 'HomeController@incTexto')->name('incluir');

Route::get('/criticar', 'HomeController@criticar')->name('criticar');

Route::get('/resultados', 'HomeController@resultados')->name('resultados');

Route::get('/regulamento', 'HomeController@regulamento')->name('regulamento');

Route::get('/contato', 'HomeController@contato')->name('contato');

Route::get('/incluir/{title}/{page}/{headalert}/{type}', 'HomeController@alerts')->name('msgTexto');

Route::get('/senha', 'AuthPassController@index')->name('senha');

Route::get('/atualizar', 'AuthPassController@indexFake')->name('attsenha');


// ROUTES [POST]
Route::post('/incluir/add', 'TrabalhoController@store')->name('addTexto');

Route::post('/critica/add', 'CriticaController@store')->name('addCritica');

Route::any('/critica/visitada', 'CriticaController@att')->name('visCritica');

Route::post('/senha/atualizar', 'AuthPassController@update')->name('attSenha');

Route::post('/contato/enviar', 'HomeController@enviarContato')->name('enviarContato');