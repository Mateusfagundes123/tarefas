<?php

namespace App\Http\Controllers;

use App\Models\Projeto;
use App\Models\Tarefa;
use Illuminate\Http\Request;

class ProjetoController extends Controller
{
    // Lista todos os projetos
    public function index()
    {
        $projetos = Projeto::orderBy('id', 'desc')->get();
        return view('projetos.list', compact('projetos'));
    }

    // Exibe o formulário para criar novo projeto
    public function create()
    {
        $tarefas = Tarefa::whereNull('projeto_id')->get(); // só as livres
        return view('projetos.form', compact('tarefas'));
    }

    // Salva o projeto no banco
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
        ]);

        $projeto = Projeto::create($request->only(['nome', 'descricao']));

        // Se tiver tarefas selecionadas, vincula ao projeto
        if ($request->has('tarefas')) {
            Tarefa::whereIn('id', $request->tarefas)
                  ->update(['projeto_id' => $projeto->id]);
        }

        return redirect()->route('projetos.list')
                         ->with('success', 'Projeto criado com sucesso!');
    }

    // Exibe o formulário para editar projeto existente
    public function edit(Projeto $projeto)
    {
        $tarefas = Tarefa::whereNull('projeto_id')
                         ->orWhere('projeto_id', $projeto->id)
                         ->get();

        return view('projetos.form', compact('projeto', 'tarefas'));
    }

    // Atualiza o projeto no banco
    public function update(Request $request, Projeto $projeto)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'prazo' => 'nullable|date',
        ]);

        $projeto->update($request->only(['nome', 'descricao', 'prazo']));

        // Atualiza tarefas associadas
        if ($request->has('tarefas')) {
            // Primeiro libera todas as tarefas antigas
            Tarefa::where('projeto_id', $projeto->id)->update(['projeto_id' => null]);

            // Depois associa as novas
            Tarefa::whereIn('id', $request->tarefas)
                  ->update(['projeto_id' => $projeto->id]);
        }

        return redirect()->route('projetos.list')
                         ->with('success', 'Projeto atualizado com sucesso!');
    }

    // Remove o projeto
    public function destroy(Projeto $projeto)
    {
        // Desassocia as tarefas antes de excluir o projeto
        Tarefa::where('projeto_id', $projeto->id)->update(['projeto_id' => null]);

        $projeto->delete();

        return redirect()->route('projetos.list')
                         ->with('success', 'Projeto excluído com sucesso!');
    }

    // Mostra detalhes de um projeto
    public function show(Projeto $projeto)
    {
        return view('projetos.show', compact('projeto'));
    }
    
}
