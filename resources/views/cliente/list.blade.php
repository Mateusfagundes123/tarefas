@extends('base')
@section('titulo', 'Listagem de Clientes')
@section('conteudo')
    <div class="d-flex align-items-center justify-content-between mb-3">
        <a href="{{ url('/') }}">
            <button class="btn btn-outline-primary btn-lg d-flex align-items-center justify-content-center"
                    style="width: 55px; height: 55px; border-radius: 50%;">
                <img src="{{ asset('img/voltar.png') }}" alt="Voltar" width="20" height="20">
            </button>
        </a>

        {{-- Título maior --}}
        <h1 class="text-center flex-grow-1 fw-bold mb-0" style="font-size: 2rem;">
            Listagem de Clientes
        </h1>
    </div>

    <div class="row mb-4 justify-content">
        <div class="col-md-8 col-lg-6"> {{-- 🔹 Centraliza e limita a largura --}}
            <form action="{{ route('cliente.search') }}" method="post">
                @csrf
                <div class="row align-items-end g-2">
                    <div class="col-md-3">
                        <label class="form-label small mb-1">Tipo</label>
                        <select name="tipo" class="form-select form-select-sm">
                            <option value="nome">Nome</option>
                            <option value="cpf">CPF</option>
                            <option value="telefone">Telefone</option>
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
                        <a class="btn btn-success btn-sm flex-fill" href="{{ url('/cliente/create') }}">
                            <i class="fa-solid fa-plus"></i> Novo
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        <table class="table table-hover">
            <thead>
                <tr>
                    <td>#ID</td>
                    <td>Nome</td>
                    <td>Email</td>
                    <td>CPF</td>
                    <td>Telefone</td>
                    <td colspan="2" class="text-center">Ação</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($dados as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->nome }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->cpf }}</td>
                        <td>{{ $item->telefone }}</td>
                        <td class="text-center">
                            <a href="{{ route('cliente.edit', $item->id) }}" class="btn btn-outline-warning btn-sm">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                        </td>
                        <td class="text-center">
                            <form action="{{ route('cliente.destroy', $item->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger"
                                    onclick="return confirm('Deseja Remover o registro?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@stop
