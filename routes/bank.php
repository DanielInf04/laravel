<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DefaultController;
use App\Http\Controllers\CuentaController;
use App\Http\Controllers\ClienteController;

/*Route::get('/', function () {
    return view('welcome');
});*/
//Route::get('/', [DefaultController::class, 'home']);
Route::get('/', [DefaultController::class, 'home'])->name('home');

/*Route::get('/welcome', [DefaultController::class, 'welcome']);

Route::get('/ejemplo', [DefaultController::class, 'ejemplo']);*/

//// ESTADISTICAS

Route::get('/cuenta/stadistics', [DefaultController::class, 'stadistics'])->name('cuentas_stadistics');

//// CUENTAS

Route::get('/cuenta/list', [CuentaController::class, 'list'])->name('cuenta_list');

Route::get('/cuenta/filtro', [CuentaController::class, 'filtrar'])->name('cuenta_filtro');

// CLIENTES

Route::get('/cliente/list', [ClienteController::class, 'list'])->name('cliente_list');

Route::middleware(['auth', 'auth.session'])->group(function () {
    
    // CUENTAS

    // Crear nueva cuenta
    Route::match(['get', 'post'], '/cuenta/new', [CuentaController::class, 'new'])->name('cuenta_new');
    // Modificar cuenta
    Route::match(['get', 'post'], '/cuenta/edit/{id}', [CuentaController::class, 'edit'])->name('cuenta_edit');
    // Eliminar cuenta
    Route::get('/cuenta/delete/{id}', [CuentaController::class, 'delete'])->name('cuenta_delete');

    // CLIENTES

    // Crear nuevo cliente
    Route::match(['get', 'post'], '/cliente/new', [ClienteController::class, 'new'])->name('cliente_new');
    // Modificar cliente
    Route::match(['get', 'post'], '/cliente/edit/{id}', [ClienteController::class, 'edit'])->name('cliente_edit');
    // Eliminar Cliente
    Route::get('/cliente/delete/{id}', [ClienteController::class, 'delete'])->name('cliente_delete');

});