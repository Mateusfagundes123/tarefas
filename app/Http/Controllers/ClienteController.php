<?php
namespace App\Http\Controllers;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ClienteController extends Controller
{
    public function index()
    {
        $dados = Cliente::All();

        return view('cliente.list', ['dados' => $dados]);
    }

    public function create()
    {
        return view('cliente.form');
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

    public function edit(string $id)
    {
        $dado = Cliente::findOrFail($id);

        return view( 'cliente.form',
            [
                'dado' => $dado,
            ]
        );
    }

    public function update(Request $request, string $id)
    {
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

        if (!empty($dado->imagem) && Storage::disk('public')->exists($dado->imagem)) {
            Storage::disk('public')->delete($dado->imagem);
        }

        $dado->delete();

        return redirect('cliente')->with('success', 'Cliente excluído com sucesso!');
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
