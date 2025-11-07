@extends('base')

@section('titulo', 'Lista de Projetos')

@section('conteudo')
    <a href="{{ url('/') }}">
        <button >
            <img src="{{ asset('img/voltar.png') }}" alt="Voltar" width="15" height="15">
        </button>
    </a>
    <h1>Lista de Projetos</h1>

    <div class="row">
        <div class="col">
            <form action="{{ route('projetos.search') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-3">
                        <label class="form-label">Tipo</label>
                        <select name="tipo" class="form-select">
                            <option value="nome">Nome</option>
                            <option value="descricao">Descrição</option>
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
                        <a href="{{ route('projetos.create') }}" class="btn btn-success mb-3">Novo Projeto</a>
                        <a href="{{ route('projetos.pdf') }}" class="btn btn-secondary mb-3">Gerar Relatório PDF</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Prazo</th>
                <th>Tarefas Associadas</th>
                <th>Ações</th>
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
                        @if($projeto->tarefas->count() > 0)
                            <ul>
                                @foreach($projeto->tarefas as $tarefa)
                                    <li>{{ $tarefa->titulo }} ({{ $tarefa->concluida ? 'Concluída' : 'Pendente' }})</li>
                                @endforeach
                            </ul>
                        @else
                            Nenhuma tarefa
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('projetos.edit', $projeto->id) }}" class="btn btn-primary btn-sm">Editar</a>

                        <form action="{{ route('projetos.destroy', $projeto->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Deseja realmente excluir?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" type="submit">Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@stop
