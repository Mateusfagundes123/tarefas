@extends('base')

@section('titulo', isset($documento) ? 'Editar Documento' : 'Novo Documento')

@section('conteudo')
<head>
    <link rel="icon" type="image/png" href="../img/gato.png">
</head>

<a href="{{ route('documentos.index') }}">
    <button class="btn btn-outline-primary btn-lg d-flex align-items-center justify-content-center"
            style="width: 55px; height: 55px; border-radius: 50%;">
        <img src="{{ asset('img/voltar.png') }}" alt="Voltar" width="20" height="20">
    </button>
</a>

<h1>{{ isset($documento) ? 'Editar Documento' : 'Cadastrar Documento' }}</h1>

@php
    if (!empty($documento->id)) {
        $action = route('documentos.update', $documento->id);
        $method = 'PUT';
    } else {
        $action = route('documentos.store');
        $method = 'POST';
    }
@endphp

<form action="{{ $action }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if ($method === 'PUT')
        @method('PUT')
    @endif

    {{-- Campo de upload do arquivo --}}
    <div class="mb-3">
        <label for="arquivo" class="form-label">Arquivo</label>
        @if (!empty($documento->caminho_arquivo))
            <p><strong>Arquivo atual:</strong> {{ $documento->nome_arquivo }}</p>
        @endif
        <input 
            type="file" 
            name="arquivo" 
            id="arquivo" 
            class="form-control" 
            @if(empty($documento)) required @endif
        >
    </div>

    {{-- Campo de descrição --}}
    <div class="mb-3">
        <label for="descricao" class="form-label">Descrição</label>
        <textarea 
            name="descricao" 
            id="descricao" 
            class="form-control" 
            rows="3">{{ old('descricao', $documento->descricao ?? '') }}</textarea>
    </div>

    <button type="submit" class="btn btn-success">Salvar</button>
</form>
@stop
