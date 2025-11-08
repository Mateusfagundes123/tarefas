@extends('base')
@section('titulo', 'Lista de Clientes')
@section('conteudo')

<a href="{{ url('/') }}">
    <button class="btn btn-outline-primary btn-lg d-flex align-items-center justify-content-center"
            style="width: 55px; height: 55px; border-radius: 50%;">
        <img src="{{ asset('img/voltar.png') }}" alt="Voltar" width="20" height="20">
    </button>
</a>

<h1>Lista de Clientes</h1>

<div class="row">
    <div class="col">
        <form action="{{ route('cliente.search') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-3">
                    <label class="form-label">Tipo</label>
                    <select name="tipo" class="form-select">
                        <option value="nome">Nome</option>
                        <option value="email">Email</option>
                        <option value="cpf">CPF</option>
                        <option value="telefone">Telefone</option>
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
                    <a href="{{ route('cliente.create') }}" class="btn btn-success mb-3">Novo Cliente</a>
                </div>
            </div>
        </form>
    </div>
</div>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Imagem</th>
            <th>Nome</th>
            <th>Email</th>
            <th>CPF</th>
            <th>Telefone</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($dados as $cliente)
            <tr>
                <td>{{ $cliente->id }}</td>

                <td>
                    @if ($cliente->imagem)
                        <div style="
                            width: 80px;
                            height: 80px;
                            border-radius: 10px;
                            overflow: hidden;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            background-color: #f8f9fa;
                            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
                        ">
                            <img src="{{ asset('storage/' . $cliente->imagem) }}"
                                 alt="Imagem cliente"
                                 style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                    @else
                        <span class="text-muted">Sem imagem</span>
                    @endif
                </td>

                <td>{{ $cliente->nome }}</td>
                <td>{{ $cliente->email }}</td>
                <td>{{ $cliente->cpf }}</td>
                <td>{{ $cliente->telefone ?? '—' }}</td>

                <td>
                    <a href="{{ route('cliente.edit', $cliente->id) }}" class="btn btn-primary btn-sm">
                        Editar
                    </a>

                    <form action="{{ route('cliente.destroy', $cliente->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
                            Excluir
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@stop
