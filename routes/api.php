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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return 'ola';
//    // return $request->user();
// });



// Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('/estados', EstadoController::class);
    Route::apiResource('/cidades', CidadeController::class);
    Route::apiResource('/clientes', ClienteController::class);
    Route::apiResource('/fornecedores', FornecedorController::class);
    Route::apiResource('/contas', ContaController::class);

    Route::apiResource('/contarecebers', ContaReceberController::class);
    Route::put('/contarecebers/baixar/{id}', [ContaReceberController::class, 'baixar']);
    Route::put('/contarecebers/estornar/{id}', [ContaReceberController::class, 'estornar']);

    Route::apiResource('/contapagars', ContaPagarController::class);
    Route::put('/contapagars/baixar/{id}', [ContaPagarController::class, 'baixar']);
    Route::put('/contapagars/estornar/{id}', [ContaPagarController::class, 'estornar']);

// });
