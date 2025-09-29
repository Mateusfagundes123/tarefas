<?php

namespace App\Http\Controllers;

use App\Models\Tarefa;
use App\Models\GrauImportancia;
use Illuminate\Http\Request;
use App\Models\Projeto;

class TarefaController extends Controller
{
    public function index()
    {
        $dados = Tarefa::with('grauImportancia')->get();
        return view('tarefa.list', ['dados' => $dados]);
    } 

   public function create()
{
    $dado = new Tarefa();
    $graus = GrauImportancia::orderBy('nome')->get();
    $projetos = Projeto::orderBy('nome')->get();

    return view('tarefa.form', compact('dado', 'graus', 'projetos'));
}

    private function validateRequest(Request $request)
    {
        $request->validate([
            'titulo' => 'required',
            'descricao' => 'required',
            'dataentrega' => 'required|date',
        ], [
            'titulo.required' => 'O campo título é obrigatório',
            'descricao.required' => 'O campo descrição é obrigatório',
            'dataentrega.required' => 'A data de entrega é obrigatória',
            'dataentrega.date' => 'A data de entrega deve ser uma data válida',
            
        ]);
    }

    public function store(Request $request)
    {
        $this->validateRequest($request);

        $data = $request->all();
        $data['concluida'] = $request->has('concluida'); // checkbox

        Tarefa::create($data);

        return redirect('tarefa')->with('success', 'Tarefa cadastrada com sucesso!');
    }

   public function edit($id)
{
    $dado = Tarefa::findOrFail($id);
    $graus = GrauImportancia::orderBy('nome')->get();
    $projetos = Projeto::orderBy('nome')->get();

    return view('tarefa.form', compact('dado', 'graus', 'projetos'));
}
    public function update(Request $request, string $id)
    {
        $this->validateRequest($request);

        $dado = Tarefa::findOrFail($id);

        $data = $request->all();
        $data['concluida'] = $request->has('concluida'); // checkbox

        $dado->update($data);

        return redirect('tarefa')->with('success', 'Tarefa atualizada com sucesso!');
    }

    public function destroy(string $id)
    {
        $dado = Tarefa::findOrFail($id);
        $dado->delete();

        return redirect('tarefa')->with('success', 'Tarefa excluída com sucesso!');
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
