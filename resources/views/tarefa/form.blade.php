@extends('base')
@section('titulo', 'Formulário Tarefa')
@section('conteudo')

    @php
        if (!empty($dado->id)) {
            $action = route('tarefa.update', $dado->id);
        } else {
            $action = route('tarefa.store');
        }
    @endphp

    <form action="{{ $action }}" method="post">
        @csrf

        @if (!empty($dado->id))
            @method('put')
        @endif

        <input type="hidden" name="id" value="{{ old('id', $dado->id ?? '') }}">

        <div class="row">
            <div class="col">
                <label for="">Título</label>
                <input type="text" class="form-control" name="titulo" value="{{ old('titulo', $dado->titulo ?? '') }}">
            </div>
            <div class="col">
                <label for="">Descrição</label>
                <textarea class="form-control" name="descricao">{{ old('descricao', $dado->descricao ?? '') }}</textarea>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col">
                <label for="">Grau de Importância</label>
                <select name="grau_importancia_id" class="form-select">
                    <option value="">Selecione</option>
                    @foreach($graus as $grau)
                        <option value="{{ $grau->id }}" {{ old('grau_importancia_id', $dado->grau_importancia_id ?? '') == $grau->id ? 'selected' : '' }}>
                            {{ $grau->nome }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                <label for="">Data de Entrega</label>
                <input type="date" class="form-control" name="dataentrega" value="{{ old('dataentrega', $dado->dataentrega ?? '') }}">
            </div>
        </div>

        <div class="row mt-3">
            <div class="col">
                <label for="">Projeto</label>
                <select name="projeto_id" class="form-select">
                    <option value="">Selecione</option>
                    @foreach($projetos as $projeto)
                        <option value="{{ $projeto->id }}" {{ old('projeto_id', $dado->projeto_id ?? '') == $projeto->id ? 'selected' : '' }}>
                            {{ $projeto->nome }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col d-flex align-items-center">
                <div class="form-check mt-4">
                    <input type="checkbox" class="form-check-input" name="concluida" value="1"
                        {{ old('concluida', $dado->concluida ?? false) ? 'checked' : '' }}>
                    <label class="form-check-label">Concluída</label>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col">
                <button type="submit" class="btn btn-success">{{ !empty($dado->id) ? 'Atualizar' : 'Salvar' }}</button>
                <a href="{{ route('tarefa.index') }}" class="btn btn-primary">Voltar</a>
            </div>
        </div>
    </form>
@stop
