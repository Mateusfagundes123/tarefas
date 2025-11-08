@extends('base')

@section('titulo', 'Lista de Documentos')

@section('conteudo')
   <a href="{{ url('/') }}">
            <button class="btn btn-outline-primary btn-lg d-flex align-items-center justify-content-center"
                    style="width: 55px; height: 55px; border-radius: 50%;">
                <img src="{{ asset('img/voltar.png') }}" alt="Voltar" width="20" height="20">
            </button>
        </a>
    <h1>Lista de Documentos</h1>

    <div class="row">
        <div class="col">
            <form action="{{ route('documentos.search') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-3">
                        <label class="form-label">Tipo</label>
                        <select name="tipo" class="form-select">
                            <option value="nome_arquivo">Nome do Arquivo</option>
                            <option value="descricao">Descrição</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Valor</label>
                        <input type="text" class="form-control" name="valor" placeholder="Pesquisar...">
                    </div>

                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary mt-4">
                            <i class="fa-solid fa-magnifying-glass"></i> Buscar
                        </button>
                    </div>

                    <div class="col-md-3 mt-4">
                        <a href="{{ route('documentos.create') }}" class="btn btn-success mb-3">Novo Documento</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success mt-3">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome do Arquivo</th>
                <th>Tipo</th>
                <th>Descrição</th>
                <th>Data de Upload</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse($documentos as $documento)
                <tr>
                    <td>{{ $documento->id }}</td>
                    <td>{{ $documento->nome_arquivo }}</td>
                    <td>{{ $documento->tipo }}</td>
                    <td>{{ $documento->descricao ?? '-' }}</td>
                    <td>{{ $documento->created_at ? \Carbon\Carbon::parse($documento->created_at)->format('d/m/Y') : '-' }}</td>
                    <td>
                        <a href="{{ route('documentos.download', $documento->id) }}" class="btn btn-success btn-sm">Baixar</a>
                        <a href="{{ route('documentos.edit', $documento->id) }}" class="btn btn-primary btn-sm">Editar</a>

                        <form action="{{ route('documentos.destroy', $documento->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Deseja realmente excluir este documento?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" type="submit">Excluir</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Nenhum documento encontrado.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@stop
