@extends('base')

@section('titulo', 'Dashboard do Sistema')

@section('conteudo')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold text-primary">
            <i class="fa-solid fa-chart-line"></i> Dashboard do Sistema
        </h1>
        <a href="{{ url('/') }}" class="btn btn-outline-secondary">
            <i class="fa-solid fa-house"></i> Início
        </a>
    </div>

    {{-- Cards de resumo --}}
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card text-bg-success shadow-sm border-0">
                <div class="card-body text-center">
                    <i class="fa-solid fa-list-check fa-2x mb-2"></i>
                    <h5 class="card-title">Tarefas Concluídas</h5>
                    <h2>{{ $tarefasConcluidas }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-bg-danger shadow-sm border-0">
                <div class="card-body text-center">
                    <i class="fa-solid fa-clock fa-2x mb-2"></i>
                    <h5 class="card-title">Tarefas Pendentes</h5>
                    <h2>{{ $tarefasPendentes }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-bg-info shadow-sm border-0">
                <div class="card-body text-center">
                    <i class="fa-solid fa-folder-open fa-2x mb-2"></i>
                    <h5 class="card-title">Total de Projetos</h5>
                    <h2>{{ $clientes->count() }}</h2>
                </div>
            </div>
        </div>
    </div>

    {{-- Gráficos --}}
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card shadow border-0">
                <div class="card-header bg-primary text-white">
                    <i class="fa-solid fa-tasks"></i> Tarefas (Concluídas x Pendentes)
                </div>
                <div class="card-body">
                    <canvas id="graficoTarefas" height="180"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow border-0">
                <div class="card-header bg-success text-white">
                    <i class="fa-solid fa-users"></i> Projetos por Cliente
                </div>
                <div class="card-body">
                    <canvas id="graficoProjetos" height="180"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow border-0">
                <div class="card-header bg-warning text-dark">
                    <i class="fa-solid fa-file-lines"></i> Documentos por Tipo
                </div>
                <div class="card-body">
                    <canvas id="graficoDocumentos" height="180"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://kit.fontawesome.com/6dc3a0dcf1.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // grafico 1 - tarefas
    new Chart(document.getElementById('graficoTarefas'), {
        type: 'doughnut',
        data: {
            labels: ['Concluídas', 'Pendentes'],
            datasets: [{
                data: [{{ $tarefasConcluidas }}, {{ $tarefasPendentes }}],
                backgroundColor: ['#28a745', '#dc3545'],
                hoverOffset: 6
            }]
        }
    });

    // grafico 2 - projetos por cliente
    new Chart(document.getElementById('graficoProjetos'), {
        type: 'bar',
        data: {
            labels: {!! json_encode($clientes) !!},
            datasets: [{
                label: 'Projetos',
                data: {!! json_encode($qtdProjeto) !!},
                backgroundColor: '#0d6efd'
            }]
        },
        options: {
            responsive: true,
            scales: { y: { beginAtZero: true } }
        }
    });

    // Gráfico 3 - Documentos por Tipo
    new Chart(document.getElementById('graficoDocumentos'), {
        type: 'pie',
        data: {
            labels: {!! json_encode($tipos) !!},
            datasets: [{
                data: {!! json_encode($qtdDocumentos) !!},
                backgroundColor: ['#ffc107', '#17a2b8', '#6f42c1', '#20c997', '#fd7e14'],
                hoverOffset: 6
            }]
        }
    });
</script>
@stop
