<?php

use Illuminate\Support\Facades\Route;

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

use App\Http\Controllers\TarefaController;

Route::get('/', [TarefaController::class, 'index'])->name('tarefas.index');
Route::post('/tarefas', [TarefaController::class, 'store'])->name('tarefas.store');
Route::get('/tarefas/{tarefa}', [TarefaController::class, 'edit'])->name('tarefas.edit');
Route::put('/tarefas/{tarefa}', [TarefaController::class, 'update'])->name('tarefas.update');
Route::delete('/tarefas/{tarefa}', [TarefaController::class, 'destroy'])->name('tarefas.destroy');