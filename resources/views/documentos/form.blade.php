@extends('base')

@section('titulo', isset($documento) ? 'Editar Documento' : 'Novo Documento')

@section('conteudo')
    <a href="{{ route('documentos.index') }}">
        <button>
            <img src="{{ asset('img/voltar.png') }}" alt="Voltar" width="15" height="15">
        </button>
    </a>

    <h1>{{ isset($documento) ? 'Editar Documento' : 'Novo Documento' }}</h1>

    <form
        action="{{ isset($documento) ? route('documentos.update', $documento->id) : route('documentos.store') }}"
        method="POST"
        enctype="multipart/form-data"
    >
        @csrf
        @if(isset($documento))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label class="form-label">Arquivo:</label>
            @if(!isset($documento))
                <input type="file" name="arquivo" class="form-control" required>
            @else
                <p><strong>Arquivo atual:</strong> {{ $documento->nome_arquivo }}</p>
                <a href="{{ asset('storage/' . $documento->caminho_arquivo) }}" target="_blank" class="btn btn-outline-primary btn-sm">Visualizar</a>
            @endif
        </div>

        <div class="mb-3">
            <label class="form-label">Descrição:</label>
            <textarea name="descricao" class="form-control" rows="3">{{ $documento->descricao ?? '' }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">
            💾 {{ isset($documento) ? 'Atualizar' : 'Salvar' }}
        </button>
        <a href="{{ route('documentos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@stop
