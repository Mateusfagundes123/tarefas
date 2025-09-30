<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\TarefaController;
use App\Http\Controllers\ProjetoController;


Route::get('/', function () {
    return view('welcome');
});

/**
 * Rotas Cliente
 */
Route::get('/cliente', [ClienteController::class, 'index'])->name('cliente.index');
Route::get('/cliente/create', [ClienteController::class, 'create'])->name('cliente.create');
Route::post('/cliente', [ClienteController::class, 'store'])->name('cliente.store');
Route::get('/cliente/edit/{id}', [ClienteController::class, 'edit'])->name('cliente.edit');
Route::put('/cliente/update/{id}', [ClienteController::class, 'update'])->name('cliente.update');
Route::post('/cliente/search', [ClienteController::class, 'search'])->name('cliente.search');
Route::delete('/cliente/{id}', [ClienteController::class, 'destroy'])->name('cliente.destroy');

/**
 * Rotas Tarefa
 */
Route::get('/tarefa', [TarefaController::class, 'index'])->name('tarefa.index');
Route::get('/tarefa/create', [TarefaController::class, 'create'])->name('tarefa.create');
Route::post('/tarefa', [TarefaController::class, 'store'])->name('tarefa.store');
Route::get('/tarefa/edit/{id}', [TarefaController::class, 'edit'])->name('tarefa.edit');
Route::put('/tarefa/update/{id}', [TarefaController::class, 'update'])->name('tarefa.update');
Route::post('/tarefa/search', [TarefaController::class, 'search'])->name('tarefa.search');
Route::delete('tarefa/{id}', [TarefaController::class, 'destroy'])->name('tarefa.destroy');
/**
 * Rotas projeto
 */ 
Route::get('/projetos', [ProjetoController::class, 'index'])->name('projetos.list');
Route::get('/projetos/create', [ProjetoController::class, 'create'])->name('projetos.create');
Route::post('/projetos', [ProjetoController::class, 'store'])->name('projetos.store');
Route::get('/projetos/{projeto}/edit', [ProjetoController::class, 'edit'])->name('projetos.edit');
Route::put('/projetos/{projeto}', [ProjetoController::class, 'update'])->name('projetos.update');
Route::delete('/projetos/{projeto}', [ProjetoController::class, 'destroy'])->name('projetos.destroy');
Route::get('/projetos/{projeto}', [ProjetoController::class, 'show'])->name('projetos.show');