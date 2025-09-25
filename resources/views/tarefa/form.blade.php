@extends('base')

@section('titulo', 'Formulário Tarefa')

@section('conteudo')
    @php
        if (!empty($dado->id)) {
            $action = route('tarefas.update', $dado->id);
        } else {
            $action = route('tarefas.store');
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
                <label for="titulo">Título</label>
                <input type="text" name="titulo" class="form-control"
                       value="{{ old('titulo', $dado->titulo ?? '') }}" required>
            </div>

            <div class="col">
                <label for="descricao">Descrição</label>
                <input type="text" name="descricao" class="form-control"
                       value="{{ old('descricao', $dado->descricao ?? '') }}">
            </div>

            <div class="col">
                <label for="prazo">Data de Entrega</label>
                <input type="date" name="prazo" class="form-control"
                       value="{{ old('prazo', $dado->prazo ?? '') }}">
            </div>

            <div class="col">
                <label for="concluida">Concluída?</label><br>
                <input type="checkbox" name="concluida" value="1"
                       {{ old('concluida', $dado->concluida ?? false) ? 'checked' : '' }}>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col">
                <button type="submit" class="btn btn-success">
                    {{ !empty($dado->id) ? 'Atualizar' : 'Salvar' }}
                </button>
                <a href="{{ route('tarefas.index') }}" class="btn btn-primary">Voltar</a>
            </div>
        </div>
    </form>
@stop
