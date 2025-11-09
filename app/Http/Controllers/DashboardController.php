<?php

namespace App\Http\Controllers;

use App\Models\Tarefa;
use App\Models\Projeto;
use App\Models\Cliente;
use App\Models\Documentos;

class DashboardController extends Controller
{
    public function index()
    {
        // Gráfico de tarefas concluídas e pendentes
        $tarefasConcluidas = Tarefa::where('concluida', 1)->count();
        $tarefasPendentes  = Tarefa::where('concluida', 0)->count();

        // Contagem geral
        $totalClientes     = Cliente::count();
        $totalProjetos     = Projeto::count();
        $totalDocumentos   = Documentos::count();

        // Dados para view
        return view('dashboard.index', compact(
            'tarefasConcluidas',
            'tarefasPendentes',
            'totalClientes',
            'totalProjetos',
            'totalDocumentos'
        ));
    }
}
