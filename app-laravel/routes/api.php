<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['prefix' => 'clientes'], function () {

    Route::get('cliente', [App\Http\Controllers\ClientesController::class, 'index']);
    Route::post('cliente', [App\Http\Controllers\ClientesController::class, 'store']);
    Route::put('cliente/{id}', [App\Http\Controllers\ClientesController::class, 'update']);
    Route::delete('cliente/{id}', [App\Http\Controllers\ClientesController::class, 'destroy']);
    Route::get('consulta/final-placa/{numero}', [App\Http\Controllers\ClientesController::class, 'searchByPlaca']);

});


