<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\SugestaoController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProcessarController;
use App\Http\Controllers\EtiquetaController;
use App\Http\Controllers\RelatorioController;
use App\Http\Controllers\ControleController;
use App\Http\Controllers\SaiController;
use App\Http\Controllers\StlController;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

Route::get('/',[ItemController::class,'index']);

Route::post('/response', function(Request $request){
    $var = session()->get('prioridadesSelecionadas', []);
    session()->put('prioridadesSelecionadas', $var);
    return response()->json($var);
})->name("index");

/* rotas de sugestão */
Route::get('/sugestao', [SugestaoController::class, 'sugestaoForm']);
Route::post('/sugestao', [SugestaoController::class, 'sugestao']);
Route::get('/sugestao/pesquisa', [SugestaoController::class, 'index']);

/* excel */
Route::get('/excelSTL', [StlController::class, 'excel']);
Route::get('/excelSAI', [SaiController::class, 'excel']);

/* rota item */
Route::resource('/item', ItemController::class);
Route::post('/item/is_active', [ItemController::class, 'set_is_active']);
Route::post('/item/duplicar', [ItemController::class, 'duplicar']);
Route::post('/item/etiqueta_update/{item}', [ItemController::class, 'etiqueta_update']);
Route::delete('/item/etiqueta_update/{item}', [ItemController::class, 'destroy']);
Route::get('/item/{item}/imprimir', [ItemController::class, 'imprimir']);

/* rotas para processar */
Route::post('/processar_sugestao/{item}', [ProcessarController::class, 'processarSugestao']);
Route::post('/processar_cotacao/{item}', [ProcessarController::class, 'processarCotacao']);
Route::post('/processar_licitacao/{item}', [ProcessarController::class, 'processarLicitacao']);
Route::post('/processar_tombamento/{item}', [ProcessarController::class, 'processarTombamento']);
Route::post('/processar_processamento/{item}', [ProcessarController::class, 'processarProcessamento']);
Route::post('/processar_processado/{item}', [ProcessarController::class, 'processarProcessado']);
Route::post('/processar_acervo/{item}', [ProcessarController::class, 'processarAcervo']);

/* Etiquetas */
Route::get('/etiquetas/{codimpressao}', [EtiquetaController::class, 'impressao']);
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
Route::delete('/controle/{controle}/destroy', [ControleController::class, 'destroy']);

Route::get('/controle/pdf', [ControleController::class, 'geraPDF']);

# Logs - deveria ser admin
Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index')->middleware('can:admin');

# rotas para SAI
Route::get('/sai', [SaiController::class, 'index']);

# rotas para STL
Route::get('/stl', [StlController::class, 'index']);
Route::get('/stl/relatorio', [StlController::class, 'relatorio']);

#o user quem faz a requisição
Route::put('/pedido-prioridade', [ItemController::class, 'pedidoPrioridade'])->name('pedidoPrioridade')->middleware('auth');

Route::post('/salvar-prioridades', function (Request $request) {
    // IDs de todos os checkboxes da página atual
    $pageIds = $request->input('page_ids', []);
    // IDs que foram selecionados na página atual
    $selectedIds = $request->input('selected_ids', []);

    // Recupera os itens já salvos na sessão (de outras páginas)
    $sessao = session()->get('prioridadesSelecionadas', []);

    // Remove da sessão os IDs que pertencem à página atual
    $sessao = array_filter($sessao, function ($id) use ($pageIds) {
        return !in_array($id, $pageIds);
    });

    //adiciona os IDs selecionados na página atual
    $novosSelecionados = array_merge($sessao, $selectedIds);
    $novosSelecionados = array_unique($novosSelecionados);
    // Salva na sessão
    session()->put('prioridadesSelecionadas', $novosSelecionados);
    return response()->json(['status' => 'success']);
})->name('salvarPrioridades');

#sai/stl quem controla
Route::get('prioridades', [ItemController::class, 'viewPrioridade']);
Route::put('processado/{item}', [ItemController::class, 'aceitarProcessamentoItem']);
