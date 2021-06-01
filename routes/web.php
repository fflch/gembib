<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\SugestaoController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProcessarController;
use App\Http\Controllers\EtiquetaController;
use App\Http\Controllers\RelatorioController;
use App\Http\Controllers\ControleController;

Route::get('/', [ItemController::class, 'indexPublic'])->name('home');

/* rotas para login e logout */
Route::get('login', [LoginController::class, 'redirectToProvider'])->name('login');
Route::get('callback', [LoginController::class, 'handleProviderCallback']);
Route::post('/logout', [LoginController::class, 'logout']);

/* rotas de sugestão */
Route::get('/sugestao', [SugestaoController::class, 'sugestaoForm']);
Route::post('/sugestao', [SugestaoController::class, 'sugestao']);

/* rotas de inserção */
Route::get('/item', [ItemController::class, 'index']);
Route::get('/item/create', [ItemController::class, 'create']);
Route::post('/item', [ItemController::class, 'store']);
Route::get('/excel', [ItemController::class, 'excel']);

/* rotas de edição */
Route::get('/item/{item}/edit', [ItemController::class, 'edit']);
Route::patch('/item/{item}', [ItemController::class, 'update']);

/* show item */
Route::get('/item/{item}', [ItemController::class, 'show']);

/* rotas para processar */
Route::get('/processar', [ProcessarController::class, 'processarIndex']);
Route::post('/processar_sugestao/{item}', [ProcessarController::class, 'processarSugestao']);
Route::post('/processar_cotacao/{item}', [ProcessarController::class, 'processarCotacao']);
Route::post('/processar_licitacao/{item}', [ProcessarController::class, 'processarLicitacao']);
Route::post('/processar_tombamento/{item}', [ProcessarController::class, 'processarTombamento']);
Route::post('/enviar_processamento/{item}', [ProcessarController::class, 'enviarProcessamento']);
Route::post('/processar_processamento/{item}', [ProcessarController::class, 'processarProcessamento']);
Route::post('/processar_processado/{item}', [ProcessarController::class, 'processarProcessado']);
Route::post('/processar_acervo/{item}', [ProcessarController::class, 'processarAcervo']);

/* Etiquetas */
Route::get('/etiquetas', [EtiquetaController::class, 'form']);
Route::post('/etiquetas', [EtiquetaController::class, 'show']);

/* Relatório */
Route::get('/relatorios', [RelatorioController::class, 'form']);
Route::post('/relatorios', [RelatorioController::class, 'show']);

/* Controle */
Route::get('/controle', [ControleController::class, 'index']);
Route::get('/controle/index', [ControleController::class, 'show']);
//salvar e editar
Route::post('/controle', [ControleController::class, 'store']);
Route::get('/controle/{controle}/edit', [ControleController::class, 'edit']);
Route::patch('/controle/{controle}', [ControleController::class, 'update']);

# Logs - deveria ser admin
Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index')->middleware('can:sai');