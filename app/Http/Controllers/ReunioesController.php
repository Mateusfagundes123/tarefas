<?php


namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

use App\Models\Reunioes;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;


class ReunioesController extends Controller
{
    public function gerarPDFReunioes()
    {
        $reunioes = Reunioes::all();


        if ($reunioes->isEmpty()) {
            return back()->with('error', 'Nenhuma reunião encontrada.');
        }


        $pdf = Pdf::loadView('reunioes.relatorio', compact('reunioes'));


        return $pdf->download('relatorio_reunioes.pdf');
    }

    public function index()
    {
        $dados = Reunioes::all();
        return view('reunioes.list', ['dados' => $dados]);
    }


    public function create()
    {
        return view('reunioes.form', ['dado' => new Reunioes()]);
    }


    private function validateRequest(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'data' => 'required|date',
            'hora' => 'required|string',
            'imagem' => 'nullable|image|max:2048', 
        ], [
            'nome.required' => 'O campo nome é obrigatório',
            'data.required' => 'A data é obrigatória',
            'hora.required' => 'A hora é obrigatória',
            'imagem.image' => 'O arquivo deve ser uma imagem válida',
            'imagem.max' => 'A imagem não pode ultrapassar 2MB',
        ]);
    }

    public function store(Request $request)
    {
        $this->validateRequest($request);


        $data = $request->all();


        if ($request->hasFile('imagem')) {
            $path = $request->file('imagem')->store('reunioes', 'public');
            $data['imagem'] = $path;
        }


        Reunioes::create($data);


        return redirect()->route('reunioes.index')->with('success', 'Reunião cadastrada com sucesso!');
    }

    public function edit($id)
    {
        $reuniao  = Reunioes::findOrFail($id);
        return view('reunioes.form', ['reuniao' => $reuniao]);
    }

    public function update(Request $request, $id)
    {
        $this->validateRequest($request);
        $dado = Reunioes::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('imagem')) {
            $path = $request->file('imagem')->store('reunioes', 'public');
            $data['imagem'] = $path;
        }

        $dado->update($data);
        return redirect()->route('reunioes.index')->with('success', 'Reunião atualizada com sucesso!');
    }

    public function destroy($id)
    {
        $dado = Reunioes::findOrFail($id);
        $dado->delete();


       if (!empty($dado->imagem) && Storage::disk('public')->exists($dado->imagem)) {
        Storage::disk('public')->delete($dado->imagem);
    }
    $dado->delete();

    return redirect('cliente')->with('success', 'Cliente excluído com sucesso!');
}












    // Busca
    public function search(Request $request)
    {
        if (!empty($request->valor)) {
            $dados = Reunioes::where(
                $request->tipo,
                'like',
                "%$request->valor%"
            )->get();
        } else {
            $dados = Reunioes::all();
        }


        // 🔧 Corrigido o nome da view (era 'reunioes.list', deve ser 'reuniao.list')
        return view('reunioes.list', ['dados' => $dados]);
    }
}
