

@extends('base')
@section('titulo', 'Formulário Reunião')
@section('conteudo')


<a href="{{ url('/') }}">
    <button class="btn btn-outline-primary btn-lg d-flex align-items-center justify-content-center"
            style="width: 55px; height: 55px; border-radius: 50%;">
        <img src="{{ asset('img/voltar.png') }}" alt="Voltar" width="20" height="20">
    </button>
</a>


<h1>{{ !empty($dado->id) ? 'Editar Reunião' : 'Cadastrar Reunião' }}</h1>


@php
    if (!empty($dado->id)) {
        $action = route('reunioes.update', $dado->id);
    } else {
        $action = route('reunioes.store');
    }
@endphp


<form action="{{ $action }}" method="post" enctype="multipart/form-data">
    @csrf


    @if (!empty($dado->id))
        @method('put')
    @endif


    <input type="hidden" name="id" value="{{ old('id', $dado->id ?? '') }}">


    <div class="row mt-3">
        <div class="col-md-6">
            <label for="">Nome da Reunião</label>
            <input type="text" class="form-control" name="nome" value="{{ old('nome', $dado->nome ?? '') }}">
        </div>


        <div class="col-md-3">
            <label for="">Data</label>
            <input type="date" class="form-control" name="data" value="{{ old('data', $dado->data ?? '') }}">
        </div>


        <div class="col-md-3">
            <label for="">Hora</label>
            <input type="time" class="form-control" name="hora" value="{{ old('hora', $dado->hora ?? '') }}">
        </div>
    </div>


    <div class="row mt-3">
        <div class="col-md-6">
            <label for="">Imagem (opcional)</label>
            <input type="file" class="form-control" name="imagem">
            @if (!empty($dado->imagem))
                <p class="mt-2">Imagem atual:</p>
                <img src="{{ asset('storage/' . $dado->imagem) }}" alt="Imagem da reunião" width="120" class="rounded">
            @endif
        </div>
    </div>


    <div class="row mt-4">
        <div class="col">
            <button type="submit" class="btn btn-success">
                {{ !empty($dado->id) ? 'Atualizar' : 'Salvar' }}
            </button>
            <a href="{{ route('reunioes.index') }}" class="btn btn-primary">Voltar</a>
        </div>
    </div>
</form>


@stop
