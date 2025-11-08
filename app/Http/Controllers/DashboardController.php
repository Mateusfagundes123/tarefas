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
        // Gráfico 1 - Tarefas concluídas e pendentes
        $tarefasConcluidas = Tarefa::where('concluida', 1)->count();
        $tarefasPendentes  = Tarefa::where('concluida', 0)->count();

        // Gráfico 2 - Projetos por cliente
        $clientes = Cliente::pluck('nome');
        $qtdProjeto = [];
        foreach ($clientes as $cliente) {
            $qtdProjeto[] = Projeto::where('cliente', $cliente)->count();
        }

        // Gráfico 3 - Documentos por tipo
        $tipos = Documentos::select('tipo')->distinct()->pluck('tipo');
        $qtdDocumentos = [];
        foreach ($tipos as $tipo) {
            $qtdDocumentos[] = Documento::where('tipo', $tipo)->count();
        }

        // TOTAL GERAL DE PROJETOS E DOCUMENTOS (para o topo do dashboard)
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
