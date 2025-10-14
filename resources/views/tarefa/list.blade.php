@extends('base')
@section('titulo', 'Lista de Tarefas')
@section('conteudo')
<a href="{{ url('/') }}">
    <button >
        <img src="{{ asset('img/voltar.png') }}" alt="Voltar" width="15" height="15">
    </button>
</a>
    <h1>Lista de Tarefas</h1>

        <div class="row">
        <div class="col">
            <form action="{{ route('tarefa.search') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-3">
                        <label class="form-label">Tipo</label>
                        <select name="tipo" class="form-select">
                            <option value="titulo">Titulo</option>
                        </select>

                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Valor</label>
                        <input type="text" class="form-control" name="valor" placeholder="Pesquisar...">
                    </div>

                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa-solid fa-magnifying-glass"></i> Buscar
                        </button>
                    </div>

                    <div class="col-md-3">
                       <a href="{{ route('tarefa.create') }}" class="btn btn-success mb-3">Nova Tarefa</a>
                    </div>
                </div>
            </form>

        </div>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Descrição</th>
                <th>Grau de Importancia</th>
                <th>Data Entrega</th>
                <th>Concluída</th>
                <th>Projeto</th>
                <th>Ações</th>
            </tr>
        </thead>
      <tbody>
    @foreach ($dados as $tarefa)
        <tr>
            <td>{{ $tarefa->id }}</td>
            <td>{{ $tarefa->titulo }}</td>
            <td>{{ $tarefa->descricao }}</td>
            <td>{{ $tarefa->grauImportancia?->nome ?? 'Sem grau definido' }}</td>
            <td>{{ $tarefa->dataentrega }}</td>
            <td>{{ $tarefa->concluida ? 'Sim' : 'Não' }}</td>
            <td>{{ $tarefa->projeto?->nome ?? 'Sem projeto' }}</td>

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