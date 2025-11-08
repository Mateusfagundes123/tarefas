@extends('base')
@section('titulo', 'Formulário Cliente')

@section('conteudo')
 <a href="{{ url('/') }}">
            <button class="btn btn-outline-primary btn-lg d-flex align-items-center justify-content-center"
                    style="width: 55px; height: 55px; border-radius: 50%;">
                <img src="{{ asset('img/voltar.png') }}" alt="Voltar" width="20" height="20">
            </button>
        </a>

<h1>Cadastrar Clientes</h1>

@php
    if (!empty($dado->id)) {
        $action = route('cliente.update', $dado->id);
    } else {
        $action = route('cliente.store');
    }
@endphp

<form action="{{ $action }}" method="post" enctype="multipart/form-data">
    @csrf

    @if (!empty($dado->id))
        @method('put')
    @endif

    <input type="hidden" name="id" value="{{ old('id', $dado->id ?? '') }}">

    <div class="row">
        <div class="col">
            <label for="">Nome</label>
            <input type="text" class="form-control" name="nome" value="{{ old('nome', $dado->nome ?? '') }}">
        </div>

        <div class="col">
            <label for="">Email</label>
            <input type="text" class="form-control" name="email" value="{{ old('email', $dado->email ?? '') }}">
        </div>
    </div>

    <div class="row mt-3">
        <div class="col">
            <label for="">CPF</label>
            <input type="text" class="form-control" name="cpf" value="{{ old('cpf', $dado->cpf ?? '') }}">
        </div>

        <div class="col">
            <label for="">Telefone</label>
            <input type="text" class="form-control" name="telefone" value="{{ old('telefone', $dado->telefone ?? '') }}">
        </div>
    </div>

    {{-- Se quiser adicionar imagem depois:
    @php
        $nome_imagem = !empty($dado->imagem) ? $dado->imagem : 'sem_imagem.png';
    @endphp

    <div class="row mt-3">
        <div class="col">
            <label for="">Imagem</label>
            <img src="/storage/{{ $nome_imagem }}" width="200" height="200" alt="img">
            <input type="file" name="imagem" class="form-control" value="{{ old('imagem', $dado->imagem ?? '') }}">
        </div>
    </div>
    --}}

    <div class="row mt-3">
        <div class="col">
            <button type="submit" class="btn btn-success">
                {{ !empty($dado->id) ? 'Atualizar' : 'Salvar' }}
            </button>
            <a href="{{ route('cliente.index') }}" class="btn btn-primary">Voltar</a>
        </div>
    </div>
</form>
@stop
