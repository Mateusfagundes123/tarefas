<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Relatório de Tarefas Concluídas</title>
    <style>
        body { font-family: Arial, Helvetica, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background-color: #ddd; }
    </style>
</head>
<body>
    <h2>Relatório de Tarefas</h2>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Descrição</th>
                <th>Data Entrega</th>
                <th>Projeto</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tarefas as $tarefa)
                <tr>
                    <td>{{ $tarefa->id }}</td>
                    <td>{{ $tarefa->titulo }}</td>
                    <td>{{ $tarefa->descricao }}</td>
                    <td>{{ $tarefa->dataentrega ? \Carbon\Carbon::parse($tarefa->dataentrega)->format('d/m/Y') : '-' }}</td>
                    <td>{{ $tarefa->projeto ? $tarefa->projeto->nome : 'Sem projeto' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
