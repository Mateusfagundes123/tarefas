<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Relatório de Projetos</title>
    <style>
        body { font-family: Arial, Helvetica, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background-color: #ddd; }
    </style>
</head>
<body>
    <h2>Relatório de Projetos</h2>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Prazo</th>
                <th>Tarefas</th>
            </tr>
        </thead>
        <tbody>
            @foreach($projetos as $projeto)
                <tr>
                    <td>{{ $projeto->id }}</td>
                    <td>{{ $projeto->nome }}</td>
                    <td>{{ $projeto->descricao }}</td>
                    <td>{{ $projeto->prazo ? \Carbon\Carbon::parse($projeto->prazo)->format('d/m/Y') : '-' }}</td>
                    <td>
                        @forelse($projeto->tarefas as $tarefa)
                            - {{ $tarefa->titulo }} ({{ $tarefa->concluida ? 'OK' : 'Pendente' }}) <br>
                        @empty
                            Nenhuma tarefa
                        @endforelse
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
