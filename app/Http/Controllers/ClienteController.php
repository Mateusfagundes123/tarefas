<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index()
    {
        $dados = Cliente::All();

        return view('cliente.list', ['dados' => $dados]);
    }


    public function create()
    {
        //$categorias = CategoriaCliente::orderBy('nome')->get();

        return view('cliente.form', ['categorias' => $categorias]);
    }

    private function validateRequest(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'cpf' => 'required',
            'imagem' => 'nullable|image|mimes:png,jpg,jpeg'
        ], [
            'nome.required' => 'O :attribute é obrigatório',
            'cpf.required' => 'O :attribute é obrigatório',
            'imagem.image' => 'O :attribute deve ser enviado',
            'imagem.mimes' => 'O :attribute deve ser das extensões:PNG,JPEG,JPG',
        ]);
    }


    public function store(Request $request)
    {
        // dd($request->all());
        $this->validateRequest($request);
        $data = $request->all();
        $imagem = $request->file('imagem');

        if ($imagem) {
            $nome_imagem = date('YmdiHs') . "." . $imagem->getClientOriginalExtension();
            $diretorio = "imagem/aluno/";

            $imagem->storeAs(
                $diretorio,
                $nome_imagem,
                'public'
            );
            $data['imagem'] = $diretorio . $nome_imagem;
        }

        Cliente::create($data);

        return redirect('cliente');
    }


    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        // dd($dado);
        $dado = Cliente::findOrFail($id);
        //$categorias = CategoriaCliente::orderBy('nome')->get();

        return view( 'cliente.form',
            [
                'dado' => $dado,
                //'categorias'=>$categorias
            ]
        );
    }


    public function update(Request $request, string $id)
    {
        //dd($request->all());
        $this->validateRequest($request);
        $data = $request->all();
        $imagem = $request->file('imagem');

        if ($imagem) {
            $nome_imagem = date('YmdiHs') . "." . $imagem->getClientOriginalExtension();
            $diretorio = "imagem/aluno/";

            $imagem->storeAs(
                $diretorio,
                $nome_imagem,
                'public'
            );
            $data['imagem'] = $diretorio . $nome_imagem;
        }

        Cliente::updateOrCreate(['id' => $id], $data);

        return redirect('cliente');
    }


    public function destroy(string $id)
    {
        $dado = Cliente::findOrFail($id);

        $dado->delete();

        return redirect('cliente');
    }

    public function search(Request $request)
    {
        if (!empty($request->valor)) {
            $dados = Cliente::where(
                $request->tipo,
                'like',
                "%$request->valor%"
            )->get();
        } else {
            $dados = Cliente::All();
        }

        return view('Cliente.list', ["dados" => $dados]);
    }
}
