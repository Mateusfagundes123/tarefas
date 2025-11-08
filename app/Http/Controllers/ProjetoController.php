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
    public function index()
    {
        $projetos = Projeto::with('tarefas')->orderBy('id', 'desc')->get();
        return view('projetos.list', compact('projetos'));
    }

    public function create()
    {
        $tarefas = Tarefa::whereNull('projeto_id')->get(); // só tarefas livres
        return view('projetos.form', [
            'projeto' => new Projeto(),
            'tarefas' => $tarefas,
        ]);
    }

    public function store(Request $request)
    {
        $this->validateRequest($request);

        $projeto = Projeto::create($request->only(['nome', 'descricao', 'prazo']));

        if ($request->has('tarefas')) {
            Tarefa::whereIn('id', $request->tarefas)
                ->update(['projeto_id' => $projeto->id]);
        }

        return redirect()->route('projetos.index')
            ->with('success', 'Projeto criado com sucesso!');
    }

    public function edit($id)
    {
        $projeto = Projeto::findOrFail($id);

        $tarefas = Tarefa::whereNull('projeto_id')
            ->orWhere('projeto_id', $projeto->id)
            ->get();

        return view('projetos.form', compact('projeto', 'tarefas'));
    }

    public function update(Request $request, $id)
    {
        $this->validateRequest($request);

        $projeto = Projeto::findOrFail($id);
        $projeto->update($request->only(['nome', 'descricao', 'prazo']));

        Tarefa::where('projeto_id', $projeto->id)->update(['projeto_id' => null]); 

        if ($request->has('tarefas')) {
            Tarefa::whereIn('id', $request->tarefas)
                ->update(['projeto_id' => $projeto->id]); 
        }

        return redirect()->route('projetos.index')
            ->with('success', 'Projeto atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $projeto = Projeto::findOrFail($id);

        Tarefa::where('projeto_id', $projeto->id)->update(['projeto_id' => null]);

        $projeto->delete();

        return redirect()->route('projetos.index')
            ->with('success', 'Projeto excluído com sucesso!');
    }

    public function show($id)
    {
        $projeto = Projeto::with('tarefas')->findOrFail($id);
        return view('projetos.show', compact('projeto'));
    }

    public function search(Request $request)
    {
        $tipo = $request->tipo;
        $valor = $request->valor;

        $projetos = Projeto::with('tarefas')
            ->where($tipo, 'like', "%{$valor}%")
            ->get();

        return view('projetos.list', compact('projetos'));
    }

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
