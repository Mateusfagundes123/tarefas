@extends('base')

@section('titulo', 'Lista de Reuniões')

@section('conteudo')
    <a href="{{ url('/') }}">
        <button class="btn btn-outline-primary btn-lg d-flex align-items-center justify-content-center"
                style="width: 55px; height: 55px; border-radius: 50%;">
            <img src="{{ asset('img/voltar.png') }}" alt="Voltar" width="20" height="20">
        </button>
    </a>

    <h1>Lista de Reuniões</h1>

    <div class="row">
        <div class="col">
            <form action="{{ route('reunioes.search') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-3">
                        <label class="form-label">Tipo</label>
                        <select name="tipo" class="form-select">
                            <option value="nome">Nome</option>
                            <option value="data">Data</option>
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
                        <a href="{{ route('reunioes.create') }}" class="btn btn-success mb-3">
                            <i class="fa-solid fa-plus"></i> Nova Reunião
                        </a>
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
                <th>Imagem</th>
                <th>Nome</th>
                <th>Data</th>
                <th>Hora</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse($dados as $reuniao)
                <tr>
                    <td>{{ $reuniao->id }}</td>
                    <td>
                        @if ($reuniao->imagem)
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
                                <img src="{{ asset('storage/' . $reuniao->imagem) }}"
                                     alt="Imagem da reunião"
                                     style="width: 100%; height: 100%; object-fit: cover;">
                            </div>
                        @else
                            <span class="text-muted">Sem imagem</span>
                        @endif
                    </td>

                    <td>{{ $reuniao->nome }}</td>
                    <td>{{ \Carbon\Carbon::parse($reuniao->data)->format('d/m/Y') }}</td>
                    <td>{{ $reuniao->hora }}</td>

                    <td>
                        <a href="{{ route('reunioes.edit', $reuniao->id) }}" class="btn btn-primary btn-sm">
                            <i class="fa-solid fa-pen-to-square"></i> Editar
                        </a>

                        <form action="{{ route('reunioes.destroy', $reuniao->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Deseja realmente excluir esta reunião?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" type="submit">
                                <i class="fa-solid fa-trash"></i> Excluir
                            </button>
                        </form>
                    </td>
                </tr>
            @empty

            @endforelse
        </tbody>
    </table>
@stop
