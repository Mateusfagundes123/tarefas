@extends('base')
@section('titulo', 'Lista de Reuniões')
@section('conteudo')
    <div class="d-flex align-items-center justify-content-between mb-3">
        <a href="{{ url('/') }}">
            <button class="btn btn-outline-primary btn-lg d-flex align-items-center justify-content-center"
                    style="width: 55px; height: 55px; border-radius: 50%;">
                <img src="{{ asset('img/voltar.png') }}" alt="Voltar" width="20" height="20">
            </button>
        </a>

        <h1 class="text-center flex-grow-1 fw-bold mb-0" style="font-size: 2rem;">
            Lista de Reuniões
        </h1>
    </div>

    <div class="row mb-4 justify-content-center">
        <div class="col-md-8 col-lg-6">
            <form action="{{ route('reunioes.search') }}" method="post">
                @csrf
                <div class="row align-items-end g-2">
                    <div class="col-md-3">
                        <label class="form-label small mb-1">Tipo</label>
                        <select name="tipo" class="form-select form-select-sm">
                            <option value="nome">Nome</option>
                            <option value="data">Data</option>
                        </select>
                    </div>

                    <div class="col-md-5">
                        <label class="form-label small mb-1">Valor</label>
                        <input type="text" class="form-control form-control-sm" name="valor" placeholder="Pesquisar...">
                    </div>

                    <div class="col-md-4 d-flex gap-2">
                        <button type="submit" class="btn btn-primary btn-sm flex-fill">
                            <i class="fa-solid fa-magnifying-glass"></i> Buscar
                        </button>
                        <a class="btn btn-success btn-sm flex-fill" href="{{ route('reunioes.create') }}">
                            <i class="fa-solid fa-plus"></i> Novo
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle text-center">
            <thead class="table-light">
                <tr>
                    <th>#ID</th>
                    <th>Imagem</th>
                    <th>Nome</th>
                    <th>Data</th>
                    <th>Hora</th>
                    <th colspan="2">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dados as $reuniao)
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
                                    <img src="{{ asset('storage/reunioes/') . $reuniao->imagem) }}"
                                         alt="Imagem da reunião"
                                         style="width: 100%; height: 100%; object-fit: cover;">
                                </div>
                            @else
                                <span class="text-muted">Sem imagem</span>
                            @endif
                        </td>

                        <td class="fw-semibold">{{ $reuniao->nome }}</td>
                        <td>{{ \Carbon\Carbon::parse($reuniao->data)->format('d/m/Y') }}</td>
                        <td>{{ $reuniao->hora }}</td>

                        <td>
                            <a href="{{ route('reunioes.edit', $reuniao->id) }}" class="btn btn-outline-warning btn-sm">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                        </td>

                        <td>
                            <form action="{{ route('reunioes.destroy', $reuniao->id) }}" method="POST" onsubmit="return confirm('Deseja excluir esta reunião?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@stop
