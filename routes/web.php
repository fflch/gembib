<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\SugestaoController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProcessarController;
use App\Http\Controllers\EtiquetaController;
use App\Http\Controllers\RelatorioController;
use App\Http\Controllers\EstatisticaController;
use App\Http\Controllers\MigracaoController;
use App\Http\Controllers\TesteController;


Route::get('/', [IndexController::class, 'index'])->name('home');

/* rotas para login e logout */
Route::get('login', [LoginController::class, 'redirectToProvider']);
Route::get('callback', [LoginController::class, 'handleProviderCallback']);
Route::post('/logout', [LoginController::class, 'logout']);
Route::get('/logout', [LoginController::class, 'logout']);

/* rotas de sugestão */
Route::get('/sugestao', [SugestaoController::class, 'sugestaoForm']);
Route::post('/sugestao', [SugestaoController::class, 'sugestao']);

/* rotas de inserção */
Route::get('/item', [ItemController::class, 'index']);
Route::get('/item/create', [ItemController::class, 'create']);
Route::post('/item', [ItemController::class, 'store']);
Route::get('/excel', [ItemController::class, 'excel']);

/* rotas para processar */
Route::get('/processar', [ProcessarController::class, 'processarIndex']);
Route::post('/processar_sugestao/{item}', [ProcessarController::class, 'processarSugestao']);
Route::post('/processar_cotacao/{item}', [ProcessarController::class, 'processarCotacao']);
Route::post('/processar_licitacao/{item}', [ProcessarController::class, 'processarLicitacao']);
Route::post('/processar_tombamento/{item}', [ProcessarController::class, 'processarTombamento']);
Route::post('/processar_processamento/{item}', [ProcessarController::class, 'processarProcessamento']);
Route::post('/processar_processado/{item}', [ProcessarController::class, 'processarProcessado']);

/* show item */
Route::get('/item/{item}', [ItemController::class, 'show']);

/* Etiquetas */
Route::get('/etiquetas', [EtiquetaController::class, 'form']);
Route::post('/etiquetas', [EtiquetaController::class, 'show']);

/* Relatório */
Route::get('/relatorios', [RelatorioController::class, 'form']);
Route::post('/relatorios', [RelatorioController::class, 'show']);

/* Estatísticas */
Route::get('/estatisticas', [EstatisticaController::class, 'form']);
Route::post('/estatisticas', [EstatisticaController::class, 'show']);

Route::get('/migracao', [MigracaoController::class, 'migracao']);

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
