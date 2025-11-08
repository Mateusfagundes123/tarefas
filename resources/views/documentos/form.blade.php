@extends('base')

@section('titulo', isset($documento) ? 'Editar Documento' : 'Novo Documento')

@section('conteudo')
    <a href="{{ url('/') }}">
            <button class="btn btn-outline-primary btn-lg d-flex align-items-center justify-content-center"
                    style="width: 55px; height: 55px; border-radius: 50%;">
                <img src="{{ asset('img/voltar.png') }}" alt="Voltar" width="20" height="20">
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
            
        </div>

        <div class="mb-3">
            <label class="form-label">Descrição:</label>
            <textarea name="descricao" class="form-control" rows="3">{{ $documento->descricao ?? '' }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">
            {{ isset($documento) ? 'Atualizar' : 'Salvar' }}
        </button>
        <a href="{{ route('documentos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@stop
