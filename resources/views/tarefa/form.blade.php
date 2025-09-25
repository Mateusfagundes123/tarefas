@extends('base')

@section('titulo', 'Formulário Tarefa')

@section('conteudo')
    @php
        if (!empty($dado->id)) {
            $action = route('tarefa.update', $dado->id);
            $method = 'PUT';
        } else {
            $action = route('tarefa.store');
            $method = 'POST';
        }
    @endphp

    <form action="{{ $action }}" method="POST">
        @csrf
        @if ($method === 'PUT')
            @method('PUT')
        @endif

        <div class="mb-3">
            <label for="titulo">Título</label>
            <input type="text" name="titulo" value="{{ old('titulo', $dado->titulo) }}" class="form-control">
        </div>

        <div class="mb-3">
            <label for="descricao">Descrição</label>
            <textarea name="descricao" class="form-control">{{ old('descricao', $dado->descricao) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="prazo">Prazo</label>
            <input type="date" name="dataentrega" value="{{ old('dataentrega', $dado->dataentrega) }}" class="form-control">
        </div>

        <div class="form-check">
            <input type="checkbox" name="concluida" class="form-check-input" {{ $dado->concluida ? 'checked' : '' }}>
            <label class="form-check-label">Concluída</label>
        </div>

        <button type="submit" class="btn btn-success">Salvar</button>
    </form>
@stop
