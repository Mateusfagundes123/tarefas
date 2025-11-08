<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\TarefaController;
use App\Http\Controllers\ProjetoController;
use App\Http\Controllers\DocumentosController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReunioesController;


Route::get('/', function () {
    return view('welcome');
});

 //rotas cliente 
Route::get('/cliente', [ClienteController::class, 'index'])->name('cliente.index');
Route::get('/cliente/create', [ClienteController::class, 'create'])->name('cliente.create');
Route::post('/cliente', [ClienteController::class, 'store'])->name('cliente.store');
Route::get('/cliente/edit/{id}', [ClienteController::class, 'edit'])->name('cliente.edit');
Route::put('/cliente/update/{id}', [ClienteController::class, 'update'])->name('cliente.update');
Route::post('/cliente/search', [ClienteController::class, 'search'])->name('cliente.search');
Route::delete('/cliente/{id}', [ClienteController::class, 'destroy'])->name('cliente.destroy');

//Rotas Tarefa
Route::get('/tarefa', [TarefaController::class, 'index'])->name('tarefa.index');
Route::get('/tarefa/create', [TarefaController::class, 'create'])->name('tarefa.create');
Route::post('/tarefa', [TarefaController::class, 'store'])->name('tarefa.store');
Route::get('/tarefa/edit/{id}', [TarefaController::class, 'edit'])->name('tarefa.edit');
Route::put('/tarefa/update/{id}', [TarefaController::class, 'update'])->name('tarefa.update');
Route::post('/tarefa/search', [TarefaController::class, 'search'])->name('tarefa.search');
Route::delete('tarefa/{id}', [TarefaController::class, 'destroy'])->name('tarefa.destroy');

//Rotas projeto
Route::post('/projetos/search', [ProjetoController::class, 'search'])->name('projetos.search');
Route::get('/projetos', [ProjetoController::class, 'index'])->name('projetos.list');
Route::get('/projetos/create', [ProjetoController::class, 'create'])->name('projetos.create');
Route::post('/projetos', [ProjetoController::class, 'store'])->name('projetos.store');
Route::get('/projetos/edit{id}', [ProjetoController::class, 'edit'])->name('projetos.edit');
Route::put('/projetos/{projeto}', [ProjetoController::class, 'update'])->name('projetos.update');
Route::delete('/projetos/{projeto}', [ProjetoController::class, 'destroy'])->name('projetos.destroy');
Route::get('/projetos/{projeto}', [ProjetoController::class, 'show'])->name('projetos.show');
Route::resource('projetos', ProjetoController::class);

//rotas documentos
Route::get('/documentos', [DocumentosController::class, 'index'])->name('documentos.index');
Route::get('/documentos/create', [DocumentosController::class, 'create'])->name('documentos.create');
Route::post('/documentos', [DocumentosController::class, 'store'])->name('documentos.store');
Route::get('/documentos/{documento}', [DocumentosController::class, 'show'])->name('documentos.show');
Route::get('/documentos/{documento}/edit', [DocumentosController::class, 'edit'])->name('documentos.edit');
Route::put('/documentos/{documento}', [DocumentosController::class, 'update'])->name('documentos.update');
Route::delete('/documentos/{documento}', [DocumentosController::class, 'destroy'])->name('documentos.destroy');
Route::get('/documentos/{documento}/download', [DocumentosController::class, 'download'])->name('documentos.download');
Route::post('/documentos/search', [DocumentosController::class, 'search'])->name('documentos.search');
Route::get('/projetos.pdf', [ProjetoController::class, 'gerarPDF'])->name('projetos.pdf');
Route::get('/tarefas.pdf', [TarefaController::class, 'gerarPDFTarefas'])->name('tarefas.pdf');

//rota dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

//rotas reunioes
Route::get('/reunioes', [ReunioesController::class, 'index'])->name('reunioes.index');
Route::get('/reunioes/create', [ReunioesController::class, 'create'])->name('reunioes.create');
Route::post('/reunioes', [ReunioesController::class, 'store'])->name('reunioes.store');
Route::get('/reunioes/{reuniao}', [ReunioesController::class, 'show'])->name('reunioes.show');
Route::get('/reunioes/{reuniao}/edit', [ReunioesController::class, 'edit'])->name('reunioes.edit');
Route::put('/reunioes/{reuniao}', [ReunioesController::class, 'update'])->name('reunioes.update');
Route::delete('/reunioes/{reuniao}', [ReunioesController::class, 'destroy'])->name('reunioes.destroy');
Route::post('/reunioes/search', [ReunioesController::class, 'search'])->name('reunioes.search');
