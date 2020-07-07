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

Route::get('/', 'IndexController@index')->name('home');

/* rotas para login e logout */
Route::get('login', 'Auth\LoginController@redirectToProvider');
Route::get('callback', 'Auth\LoginController@handleProviderCallback');
Route::post('/logout', 'Auth\LoginController@logout');
Route::get('/logout', 'Auth\LoginController@logout');

/* rotas de sugestão */
Route::get('/sugestao','SugestaoController@sugestaoForm');
Route::post('/sugestao','SugestaoController@sugestao');

/* rotas de inserção */
Route::get('/item','ItemController@index');
Route::get('/item/create','ItemController@create');
Route::post('/item','ItemController@store');
Route::get('/excel','ItemController@excel');

/* rotas para processar */
Route::get('/processar','ProcessarController@processarIndex');
Route::post('/processar_sugestao/{item}','ProcessarController@processarSugestao');
Route::post('/processar_cotacao/{item}','ProcessarController@processarCotacao');
Route::post('/processar_licitacao/{item}','ProcessarController@processarLicitacao');
Route::post('/processar_tombamento/{item}','ProcessarController@processarTombamento');
Route::post('/processar_processamento/{item}','ProcessarController@processarProcessamento');
Route::post('/processar_processado/{item}','ProcessarController@processarProcessado');

/* show item */
Route::get('/item/{item}','ItemController@show');

/* Etiquetas */
Route::get('/etiquetas','EtiquetaController@form');
Route::post('/etiquetas','EtiquetaController@show');

/* Relatório */
Route::get('/relatorios','RelatorioController@form');
Route::post('/relatorios','RelatorioController@show');

/* Estatísticas */
Route::get('/estatisticas', 'EstatisticaController@form');
Route::post('/estatisticas','EstatisticaController@show');

/*

Route::get('/itens/processar_tombamento/{tombamento}','ItemController@processar_tombamento');
Route::post('/itens/store_processar_tombamento/{tombamento}','ItemController@store_processar_tombamento');

//Rota para mostrar as sugestões em processo de aquisição
Route::get('/itens/lista_aquisicao/','ItemController@lista_aquisicao');

//Rota para mostrar a lista com o status das sugestões
Route::get('/itens/consulta/','ItemController@consulta');




Route::get('/itens/disparar_email', function(){
	Mail::send('mail.sugestao', ['usuario' => 'Gabriela'], function($m){//conseguir passar o nome do usuário
		$user = Auth::user();
		$m->from('gabsreisg@gmail.com', 'Gabriela');//o remetente deve ser o email gembib
		$m->subject('Sugestão enviada!'); //assunto
		$m->to($user->email);//email do usuário que fez a sugestão
	});
});


//Rota para edição
Route::get('/itens/edit/{item}','editController@editEdit');
Route::post('/itens/updateEdit/{item}','editController@updateEdit');
*/
