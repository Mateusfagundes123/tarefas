<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

use App\Models\Documentos;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;


class DocumentosController extends Controller
{
    public function index()
    {
        $documentos = Documentos::latest()->paginate(10);
        return view('documentos.list', compact('documentos'));
    }

    public function create()
    {
        return view('documentos.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'arquivo' => 'required|file|max:5120', // até 5MB
            'descricao' => 'nullable|string|max:255',
        ]);

        $file = $request->file('arquivo');
        $path = $file->store('documentos', 'public');

        Documentos::create([
            'nome_arquivo' => $file->getClientOriginalName(),
            'tipo' => $file->getClientOriginalExtension(),
            'tamanho' => $file->getSize(),
            'caminho_arquivo' => $path,
            'descricao' => $request->descricao,
        ]);

        return redirect()->route('documentos.index')->with('success', 'Documento enviado com sucesso!');
    }

    public function show(Documentos $documento)
{
    return view('documentos.show', compact('documento'));
}

public function edit(Documentos $documento)
{
    return view('documentos.form', compact('documento'));
}

        public function update(Request $request, Documentos $documento)
        {
            $request->validate([
                'descricao' => 'nullable|string|max:255',
            ]);

            $documento->update([
                'descricao' => $request->descricao,
            ]);

            return redirect()->route('documentos.index')->with('success', 'Documento atualizado com sucesso!');
        }

        public function destroy(Documentos $documento)
        {
            Storage::disk('public')->delete($documento->caminho_arquivo);
            $documento->delete();

            return redirect()->route('documentos.index')->with('success', 'Documento excluído com sucesso!');
        }
        public function gerarPDF()
        {
            $documentos = Documentos::all();

            $pdf = Pdf::loadView('documentos.relatorio', compact('documentos'));

            return $pdf->download('relatorio_documentos.pdf');
        }
        public function download(Documentos $documento)
        {
            $filePath = $documento->caminho_arquivo;

            if (!Storage::disk('public')->exists($filePath)) {
                return redirect()->route('documentos.index')->with('error', 'Arquivo não encontrado.');
            }

            return Storage::disk('public')->download($filePath, $documento->nome_arquivo);
        }
}
