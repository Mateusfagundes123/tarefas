<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Projeto;
use App\Models\Tarefa;
use Illuminate\Http\Request;

class ProjetoController extends Controller
{
    public function gerarPDF()
{
    $projetos = Projeto::with('tarefas')->get();

    $pdf = Pdf::loadView('projetos.relatorio', compact('projetos'));

    return $pdf->download('relatorio_projetos.pdf');
}



    // Lista todos os projetos
    public function index()
    {
        $projetos = Projeto::with('tarefas')->orderBy('id', 'desc')->get();
        return view('projetos.list', compact('projetos'));
    }

    // Exibe o formulário para criar novo projeto
    public function create()
    {
        $tarefas = Tarefa::whereNull('projeto_id')->get(); // só tarefas livres
        return view('projetos.form', [
            'projeto' => new Projeto(),
            'tarefas' => $tarefas,
        ]);
    }

    // Salva o projeto no banco
    public function store(Request $request)
    {
        $this->validateRequest($request);

        $projeto = Projeto::create($request->only(['nome', 'descricao', 'prazo']));

        // Se tiver tarefas selecionadas, vincula ao projeto
        if ($request->has('tarefas')) {
            Tarefa::whereIn('id', $request->tarefas)
                ->update(['projeto_id' => $projeto->id]);
        }

        return redirect()->route('projetos.index')
            ->with('success', 'Projeto criado com sucesso!');
    }

    // Exibe o formulário para editar projeto existente
    public function edit($id)
    {
        $projeto = Projeto::findOrFail($id);

        $tarefas = Tarefa::whereNull('projeto_id')
            ->orWhere('projeto_id', $projeto->id)
            ->get();

        return view('projetos.form', compact('projeto', 'tarefas'));
    }

    // Atualiza o projeto no banco
    public function update(Request $request, $id)
    {
        $this->validateRequest($request);

        $projeto = Projeto::findOrFail($id);
        $projeto->update($request->only(['nome', 'descricao', 'prazo']));

        // Atualiza tarefas associadas
        Tarefa::where('projeto_id', $projeto->id)->update(['projeto_id' => null]); // libera antigas

        if ($request->has('tarefas')) {
            Tarefa::whereIn('id', $request->tarefas)
                ->update(['projeto_id' => $projeto->id]); // associa novas
        }

        return redirect()->route('projetos.index')
            ->with('success', 'Projeto atualizado com sucesso!');
    }

    // Remove o projeto
    public function destroy($id)
    {
        $projeto = Projeto::findOrFail($id);

        // Desassocia as tarefas antes de excluir o projeto
        Tarefa::where('projeto_id', $projeto->id)->update(['projeto_id' => null]);

        $projeto->delete();

        return redirect()->route('projetos.index')
            ->with('success', 'Projeto excluído com sucesso!');
    }

    // Mostra detalhes de um projeto
    public function show($id)
    {
        $projeto = Projeto::with('tarefas')->findOrFail($id);
        return view('projetos.show', compact('projeto'));
    }

    // Busca projetos pelo campo selecionado
    public function search(Request $request)
    {
        $tipo = $request->tipo;
        $valor = $request->valor;

        $projetos = Projeto::with('tarefas')
            ->where($tipo, 'like', "%{$valor}%")
            ->get();

        return view('projetos.list', compact('projetos'));
    }

    // Validação padrão
    private function validateRequest(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'prazo' => 'nullable|date',
        ], [
            'nome.required' => 'O campo nome é obrigatório',
            'prazo.date' => 'O prazo deve ser uma data válida',
        ]);
    }
}
