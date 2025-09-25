<?php

namespace App\Http\Controllers;

use App\Models\Tarefa;
use App\Models\CategoriaAluno;
use Illuminate\Http\Request;

class TarefaController extends Controller
{
    public function index()
    {
        $dados = Tarefa::All();

        return view('tarefa.list', ['dados' => $dados]);
    }


    public function create()
    {
        //use App\Models\CategoriaAluno;
        $categorias = CategoriaAluno::orderBy('nome')->get();

        return view('tarefa.form', ['categorias' => $categorias]);
    }

    private function validateRequest(Request $request)
    {
        $request->validate([
            'titulo' => 'required',
            'descricao' => 'required',
            'dataentrega' => 'required',
        ], [
            'titulo.required' => 'O :attribute é obrigatório',
            'descricao.required' => 'O :attribute é obrigatório',
            'dataentrega.required' => 'O :attribute é obrigatório',
        ]);
    }


    // public function store(Request $request)
    // {
    //     // dd($request->all());
    //     $this->validateRequest($request);
    //     $data = $request->all();
    //     $imagem = $request->file('imagem');

    //     if ($imagem) {
    //         $nome_imagem = date('YmdiHs') . "." . $imagem->getClientOriginalExtension();
    //         $diretorio = "imagem/aluno/";

    //         $imagem->storeAs(
    //             $diretorio,
    //             $nome_imagem,
    //             'public'
    //         );
    //         $data['imagem'] = $diretorio . $nome_imagem;
    //     }

    //     Aluno::create($data);

    //     return redirect('aluno');
    // }


    public function show(string $id)
    {
        //
    }


    // public function edit(string $id)
    // {
    //     // dd($dado);
    //     $dado = Aluno::findOrFail($id);
    //     $categorias = CategoriaAluno::orderBy('nome')->get();

    //     return view( 'aluno.form',
    //         [
    //             'dado' => $dado,
    //             'categorias'=>$categorias
    //         ]
    //     );
    // }


    // public function update(Request $request, string $id)
    // {
    //     //dd($request->all());
    //     $this->validateRequest($request);
    //     $data = $request->all();
    //     $imagem = $request->file('imagem');

    //     if ($imagem) {
    //         $nome_imagem = date('YmdiHs') . "." . $imagem->getClientOriginalExtension();
    //         $diretorio = "imagem/aluno/";

    //         $imagem->storeAs(
    //             $diretorio,
    //             $nome_imagem,
    //             'public'
    //         );
    //         $data['imagem'] = $diretorio . $nome_imagem;
    //     }

    //     Aluno::updateOrCreate(['id' => $id], $data);

    //     return redirect('aluno');
    // }


    public function destroy(string $id)
    {
        $dado = Tarefa::findOrFail($id);

        $dado->delete();

        return redirect('tarefa');
    }

    public function search(Request $request)
    {
        if (!empty($request->valor)) {
            $dados = Tarefa::where(
                $request->tipo,
                'like',
                "%$request->valor%"
            )->get();
        } else {
            $dados = Tarefa::All();
        }

        return view('tarefa.list', ["dados" => $dados]);
    }
}
