<?php

namespace App\Http\Controllers;

use App\Models\Tarefa;
use Illuminate\Http\Request;

class TarefaController extends Controller
{
    public function index()
    {
        $tarefas = Tarefa::orderBy('prioridade')->get();
        return view('tarefas.index', compact('tarefas'));
    }

    public function store(Request $request)
    {
        $tarefa = new Tarefa();
        $tarefa->nome = $request->input('nome');
        $tarefa->prioridade = Tarefa::count() + 1;
        $tarefa->save();

        return redirect()->route('tarefas.index');
    }

    public function edit(Tarefa $tarefa)
    {
        return view('tarefas.edit', compact('tarefa'));
    }

    public function update(Request $request, Tarefa $tarefa)
    {
        $tarefa->nome = $request->input('nome');
        $tarefa->save();

        return redirect()->route('tarefas.index');
    }

    public function destroy(Tarefa $tarefa)
    {
        $tarefa->delete();

        return redirect()->route('tarefas.index');
    }
}
