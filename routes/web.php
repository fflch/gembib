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

Route::get('/', 'IndexController@index');

/* login */
Route::get('login', 'Auth\LoginController@redirectToProvider');
Route::get('callback', 'Auth\LoginController@handleProviderCallback');
Route::post('/logout', 'Auth\LoginController@logout');
Route::get('/logout', 'Auth\LoginController@logout');

Route::get('/itens/create','ItemController@create');
Route::post('/itens','ItemController@store');
Route::get('/itens','ItemController@index');

Route::get('/itens/processar_sugestao/{item}','ItemController@processar_sugestao');
Route::post('/itens/store_processar_sugestao/{item}','ItemController@store_processar_sugestao');


Route::get('/itens/processar_tombamento/{tombamento}','ItemController@processar_tombamento');
Route::post('/itens/store_processar_tombamento/{tombamento}','ItemController@store_processar_tombamento');

//Rota para mostrar as sugestões em processo de aquisição
Route::get('/itens/lista_aquisicao/','ItemController@lista_aquisicao');

//Rota para mostrar a lista com o status das sugestões
Route::get('/itens/consulta/','ItemController@consulta');

//Rota para inserção direta
Route::get('/itens/insercao_direta/','ItemController@createInsercao');
Route::post('/itens/store_insercao_direta/','ItemController@storeInsercao');


Route::get('/itens/disparar_email', function(){
	Mail::send('mail.sugestao', ['usuario' => 'Gabriela'], function($m){//conseguir passar o nome do usuário 
		$user = Auth::user();
		$m->from('gabsreisg@gmail.com', 'Gabriela');//o remetente deve ser o email gembib
		$m->subject('Sugestão enviada!'); //assunto
		$m->to($user->email);//email do usuário que fez a sugestão
	});
});


