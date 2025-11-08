<?php

namespace App\Http\Controllers;

use App\Models\Tarefa;
use App\Models\GrauImportancia;
use Illuminate\Http\Request;
use App\Models\Projeto;
use Barryvdh\DomPDF\Facade\Pdf; 

class TarefaController extends Controller
{

public function gerarPDFTarefas()
{
    $tarefas = Tarefa::with('projeto')
        ->where('concluida', 1)
        ->get();

    if ($tarefas->isEmpty()) {
        return back()->with('error', 'Nenhuma tarefa concluída encontrada.');
    }

    $pdf = Pdf::loadView('tarefa.relatorio', compact('tarefas'));

    return $pdf->download('relatorio_tarefas_concluidas.pdf');
}
    public function index()
    {
        $dados = Tarefa::with('grauImportancia')->get();
        return view('tarefa.list', ['dados' => $dados]);
    }

    public function create()
    {
        $projetos = Projeto::all(); 
        $graus = GrauImportancia::all();

        return view('tarefa.form', [
            'dado' => new Tarefa(), 
            'projetos' => $projetos,
            'graus' => $graus,
        ]);
    }

    private function validateRequest(Request $request)
    {
        $request->validate([
            'titulo' => 'required',
            'descricao' => 'required',
            'dataentrega' => 'required|date',
            'grau_importancia_id' => 'required|exists:grau_importancias,id',
        ], [
            'titulo.required' => 'O campo título é obrigatório',
            'descricao.required' => 'O campo descrição é obrigatório',
            'dataentrega.required' => 'A data de entrega é obrigatória',
            'dataentrega.date' => 'A data de entrega deve ser uma data válida',
            'grau_importancia_id.required' => 'Selecione um grau de importância',
        ]);
    }

    public function store(Request $request)
    {
        $this->validateRequest($request);

        $data = $request->all();
        $data['concluida'] = $request->has('concluida'); 

        Tarefa::create($data);

        return redirect()->route('tarefa.index')->with('success', 'Tarefa cadastrada com sucesso!');
    }

 public function edit($id)
{
    $dado = Tarefa::findOrFail($id); 
    $projetos = Projeto::all();
    $graus = GrauImportancia::all();

    return view('tarefa.form', [
        'dado' => $dado,      
        'projetos' => $projetos,
        'graus' => $graus,
    ]);
}

   public function update(Request $request, $id)
{
    $this->validateRequest($request);

    $dado = Tarefa::findOrFail($id);

    $data = $request->all();
    $data['concluida'] = $request->has('concluida'); 

    $dado->update($data);

    return redirect()->route('tarefa.index')->with('success', 'Tarefa atualizada com sucesso!');
}

    public function destroy(string $id)
    {
        $dado = Tarefa::findOrFail($id);
        $dado->delete();

        return redirect()->route('tarefa.index')->with('success', 'Tarefa excluída com sucesso!');
    }

    public function search(Request $request)
    {
        if (!empty($request->valor)) {
            $dados = Tarefa::where(
                $request->tipo,
                'like',
                "%$request->valor%"
            )->with('grauImportancia')->get();
        } else {
            $dados = Tarefa::with('grauImportancia')->get();
        }

        return view('tarefa.list', ["dados" => $dados]);
    }
}
