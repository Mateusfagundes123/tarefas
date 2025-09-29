@extends('base')

@section('titulo', isset($projeto) ? 'Editar Projeto' : 'Novo Projeto')

@section('conteudo')
    @php
        if (!empty($projeto->id)) {
            $action = route('projeto.update', $projeto->id);
            $method = 'PUT';
        } else {
            $action = route('projeto.store');
            $method = 'POST';
        }
    @endphp

    <form action="{{ $action }}" method="POST">
        @csrf
        @if ($method === 'PUT')
            @method('PUT')
        @endif

        <div class="mb-3">
            <label for="nome">Nome</label>
            <input type="text" name="nome" value="{{ old('nome', $projeto->nome ?? '') }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="descricao">Descrição</label>
            <textarea name="descricao" class="form-control">{{ old('descricao', $projeto->descricao ?? '') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="prazo">Prazo</label>
            <input type="date" name="prazo" value="{{ old('prazo', isset($projeto->prazo) ? $projeto->prazo->format('Y-m-d') : '') }}" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Salvar</button>
        <a href="{{ route('projeto.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@stop
