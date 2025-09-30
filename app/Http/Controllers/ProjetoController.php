<?php

namespace App\Http\Controllers;
use App\Models\Projeto;
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
        return view('projetos.form');
    }

    // Salva o projeto no banco
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'prazo' => 'nullable|date',
        ]);

        Projeto::create($request->all());

        return redirect()->route('projeto.index')->with('success', 'Projeto criado com sucesso!');
    }

    // Exibe o formulário para editar projeto existente
    public function edit(Projeto $projeto)
    {
        return view('projeto.form', compact('projeto'));
    }

    // Atualiza o projeto no banco
    public function update(Request $request, Projeto $projeto)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'prazo' => 'nullable|date',
        ]);

        $projeto->update($request->all());

        return redirect()->route('projeto.index')->with('success', 'Projeto atualizado com sucesso!');
    }

    // Remove o projeto
    public function destroy(Projeto $projeto)
    {
        $projeto->delete();

        return redirect()->route('projeto.index')->with('success', 'Projeto excluído com sucesso!');
    }

    
    public function show(Projeto $projeto)
    {
        return view('projeto.show', compact('projeto'));
    }
}
