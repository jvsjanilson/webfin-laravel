<?php

use App\Http\Controllers\CidadeController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ContaController;
use App\Http\Controllers\ContaPagarController;
use App\Http\Controllers\ContaReceberController;
use App\Http\Controllers\EstadoController;
use App\Http\Controllers\FornecedorController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('/estados', EstadoController::class);
    Route::get('/estados/search/all', [EstadoController::class, 'all']);
    Route::get('/estados/search/{uf}', [EstadoController::class, 'findByUF']);


    Route::apiResource('/cidades', CidadeController::class);
    Route::get('/cidades/lookup/{estado_id}', [CidadeController::class, 'findCidadeByEstado']);

    Route::apiResource('/clientes', ClienteController::class);
    Route::get('/clientes/find/cpfcnpj/{cpfcnpj}', [ClienteController::class, 'findByCpfcnpj']);
    Route::get('/clientes/search/all', [ClienteController::class, 'all']);
    Route::apiResource('/fornecedores', FornecedorController::class);
    Route::get('/fornecedores/find/cpfcnpj/{cpfcnpj}', [FornecedorController::class, 'findByCpfcnpj']);
    Route::get('/fornecedores/search/all', [FornecedorController::class, 'all']);

    Route::apiResource('/contas', ContaController::class);
    Route::get('/contas/search/all', [ContaController::class, 'all']);

    Route::apiResource('/contarecebers', ContaReceberController::class);
    Route::put('/contarecebers/baixar/{id}', [ContaReceberController::class, 'baixar']);
    Route::put('/contarecebers/estornar/{id}', [ContaReceberController::class, 'estornar']);
    Route::get('/contarecebers/find/documento/{documento}', [ContaReceberController::class, 'findByDocumento']);

    Route::apiResource('/contapagars', ContaPagarController::class);
    Route::put('/contapagars/baixar/{id}', [ContaPagarController::class, 'baixar']);
    Route::put('/contapagars/estornar/{id}', [ContaPagarController::class, 'estornar']);

// });
