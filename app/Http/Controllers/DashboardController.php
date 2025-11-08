<?php

namespace App\Http\Controllers;

use App\Models\Tarefa;
use App\Models\Projeto;
use App\Models\Cliente;
use App\Models\Documentos; 
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        
        $tarefasConcluidas = Tarefa::where('concluida', 1)->count();
        $tarefasPendentes  = Tarefa::where('concluida', 0)->count();

      
        $clientes = Cliente::pluck('nome');
        $qtdProjeto = [];
        foreach ($clientes as $cliente) {
            $qtdProjeto[] = Projeto::where('cliente', $cliente)->count();
        }

        
        $tipos = Documentos::select('tipo')->distinct()->pluck('tipo');
        $qtdDocumentos = [];
        foreach ($tipos as $tipo) {
            $qtdDocumentos[] = Documentos::where('tipo', $tipo)->count();
        }

   
        $totalProjeto = Projeto::count();
        $totalDocumentos = Documentos::count();

        return view('dashboard.index', compact(
            'tarefasConcluidas',
            'tarefasPendentes',
            'clientes',
            'qtdProjeto',
            'tipos',
            'qtdDocumentos',
            'totalProjeto',
            'totalDocumentos'
        ));
    }
}
