@extends('base')
@section('titulo', isset($reuniao) ? 'Editar Reunião' : 'Cadastrar Reunião')

@section('conteudo')
<a href="{{ route('reunioes.index') }}">
    <button class="btn btn-outline-primary btn-lg d-flex align-items-center justify-content-center"
            style="width: 55px; height: 55px; border-radius: 50%;">
        <img src="{{ asset('img/voltar.png') }}" alt="Voltar" width="20" height="20">
    </button>
</a>

<h1>{{ isset($reuniao) ? 'Editar Reunião' : 'Cadastrar Reunião' }}</h1>

@php
    if (!empty($reuniao->id)) {
        $action = route('reunioes.update', $reuniao->id);
        $method = 'PUT';
    } else {
        $action = route('reunioes.store');
        $method = 'POST';
    }
@endphp

<form action="{{ $action }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if ($method === 'PUT')
        @method('PUT')
    @endif

    <div class="row">
        {{-- Nome da Reunião --}}
        <div class="col-md-6 mb-3">
            <label for="nome" class="form-label">Nome da Reunião</label>
            <input type="text" name="nome" id="nome"
                   class="form-control"
                   value="{{ old('nome', $reuniao->nome ?? '') }}"
                   required>
        </div>

        {{-- Data --}}
        <div class="col-md-3 mb-3">
            <label for="data" class="form-label">Data</label>
            <input type="date" name="data" id="data"
                   class="form-control"
                   value="{{ old('data', isset($reuniao->data) ? \Carbon\Carbon::parse($reuniao->data)->format('Y-m-d') : '') }}"
                   required>
        </div>

        {{-- Hora --}}
        <div class="col-md-3 mb-3">
            <label for="hora" class="form-label">Hora</label>
            <input type="time" name="hora" id="hora"
                   class="form-control"
                   value="{{ old('hora', $reuniao->hora ?? '') }}"
                   required>
        </div>
    </div>

    {{-- Campo de imagem (opcional) --}}
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="imagem" class="form-label">Imagem (opcional)</label>
            <input type="file" name="imagem" id="imagem" class="form-control">
            @if (!empty($reuniao->imagem))
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $reuniao->imagem) }}" alt="Imagem da Reunião" width="150" class="rounded">
                </div>
            @endif
        </div>
    </div>

    <div class="row mt-3">
        <div class="col">
            <button type="submit" class="btn btn-success">
                {{ isset($reuniao) ? 'Atualizar' : 'Salvar' }}
            </button>
            <a href="{{ route('reunioes.index') }}" class="btn btn-primary">Voltar</a>
        </div>
    </div>
</form>
@stop
