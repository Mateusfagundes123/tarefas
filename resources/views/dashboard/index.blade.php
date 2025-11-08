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

    {{-- Gráfico centralizado com gráfico maior dentro do card --}}
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow border-0">
                <div class="card-header bg-primary text-white text-center">
                    <i class="fa-solid fa-tasks"></i> Tarefas (Concluídas x Pendentes)
                </div>
                <div class="card-body text-center">
                    <div style="width: 100%; display: flex; justify-content: center;">
                        <canvas id="graficoTarefas" style="width: 90% !important; max-width: 500px !important; height: 300px !important;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://kit.fontawesome.com/6dc3a0dcf1.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    
    new Chart(document.getElementById('graficoTarefas'), {
        type: 'doughnut',
        data: {
            labels: ['Concluídas', 'Pendentes'],
            datasets: [{
                data: [{{ $tarefasConcluidas }}, {{ $tarefasPendentes }}],
                backgroundColor: ['#28a745', '#dc3545'],
                hoverOffset: 8,
                cutout: '55%' 
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'bottom' }
            }
        }
    });
</script>
@stop
