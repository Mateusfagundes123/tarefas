@extends('base')
@section('titulo', 'Lista de Tarefas')
@section('conteudo')
    <h1>Lista de Tarefas</h1>
    <a href="{{ route('tarefa.create') }}" class="btn btn-success mb-3">Nova Tarefa</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Descrição</th>
                <th>Prazo</th>
                <th>Concluída</th>
                <th>Ações</th>
            </tr>
        </thead>
      <tbody>
    @foreach ($dados as $tarefa)
        <tr>
            <td>{{ $tarefa->id }}</td>
            <td>{{ $tarefa->titulo }}</td>
            <td>{{ $tarefa->descricao }}</td>
            <td>{{ $tarefa->prazo }}</td>
            <td>{{ $tarefa->concluida ? 'Sim' : 'Não' }}</td>
            <td>
                <a href="{{ route('tarefa.edit', $tarefa->id) }}" class="btn btn-primary btn-sm">Editar</a>
                <form action="{{ route('tarefa.destroy', $tarefa->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                </form>
            </td>
        </tr>
    @endforeach
</tbody>

    </table>
@stop