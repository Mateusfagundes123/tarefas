@extends('base')

@section('titulo', 'Projetos')

@section('conteudo')
    <a href="{{ route('projeto.create') }}" class="btn btn-success mb-3">Novo Projeto</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Prazo</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($projetos as $projeto)
                <tr>
                    <td>{{ $projeto->id }}</td>
                    <td>{{ $projeto->nome }}</td>
                    <td>{{ $projeto->descricao }}</td>
                    <td>
    {{ $projeto->prazo ? \Carbon\Carbon::parse($projeto->prazo)->format('d/m/Y') : '-' }}
</td>
                    <td>
                        <a href="{{ route('projeto.edit', $projeto->id) }}" class="btn btn-primary btn-sm">Editar</a>

                        <form action="{{ route('projeto.destroy', $projeto->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Deseja realmente excluir?');">
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
