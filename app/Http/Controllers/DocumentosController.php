<?php

namespace App\Http\Controllers;

use App\Models\Documentos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentosController extends Controller
{
    public function index()
    {
        $documentos = Documentos::latest()->paginate(10);
        return view('documentos.list', compact('documentos'));
    }

    public function create()
    {
        return view('documentos.create');
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

    public function show(Documentos $documentos)
    {
        return view('documentos.show', compact('documento'));
    }

    public function edit(Documentos $documentos)
    {
        return view('documentos.edit', compact('documento'));
    }

    public function update(Request $request, Documentos $documentos)
    {
        $request->validate([
            'descricao' => 'nullable|string|max:255',
        ]);

        $documentos->update([
            'descricao' => $request->descricao,
        ]);

        return redirect()->route('documentos.index')->with('success', 'Documento atualizado com sucesso!');
    }

    public function destroy(Documentos $documentos)
    {
        Storage::disk('public')->delete($documentos->caminho_arquivo);
        $documentos->delete();

        return redirect()->route('documentos.index')->with('success', 'Documento excluído com sucesso!');
    }
}
