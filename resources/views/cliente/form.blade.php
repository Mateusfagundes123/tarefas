@extends('base')
@section('titulo', 'Formulário de Cliente')
@section('conteudo')

<a href="{{ route('cliente.index') }}">
    <button class="btn btn-outline-primary btn-lg d-flex align-items-center justify-content-center"
            style="width: 55px; height: 55px; border-radius: 50%;">
        <img src="{{ asset('img/voltar.png') }}" alt="Voltar" width="20" height="20">
    </button>
</a>

<h1 class="mt-3">{{ !empty($dado->id) ? 'Editar Cliente' : 'Cadastrar Cliente' }}</h1>

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

    {{-- Nome --}}
    <div class="row mt-3">
        <div class="col-md-6">
            <label class="form-label">Nome</label>
            <input type="text" class="form-control" name="nome" value="{{ old('nome', $dado->nome ?? '') }}" required>
            @error('nome')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" name="email" value="{{ old('email', $dado->email ?? '') }}">
            @error('email')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>
    </div>

    {{-- CPF e Telefone --}}
    <div class="row mt-3">
        <div class="col-md-4">
            <label class="form-label">CPF</label>
            <input type="text" class="form-control" name="cpf" value="{{ old('cpf', $dado->cpf ?? '') }}" required>
            @error('cpf')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-4">
            <label class="form-label">Telefone</label>
            <input type="text" class="form-control" name="telefone" value="{{ old('telefone', $dado->telefone ?? '') }}">
            @error('telefone')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-4">
            <label class="form-label">Imagem (opcional)</label>
            <input type="file" class="form-control" name="imagem">
            @if (!empty($dado->imagem))
                
            @endif
            @error('imagem')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="row mt-4">
        <div class="col">
            <button type="submit" class="btn btn-success">
                {{ !empty($dado->id) ? 'Atualizar' : 'Salvar' }}
            </button>
            <a href="{{ route('cliente.index') }}" class="btn btn-secondary">Voltar</a>
        </div>
    </div>
</form>

@stop
