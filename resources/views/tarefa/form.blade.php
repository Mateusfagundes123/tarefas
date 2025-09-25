@extends('base')
@section('titulo', 'Formulário Aluno')
@section('conteudo')

    @php
        if (!empty($dado->id)) {
            $action = route('tarefa.update', $dado->id);
        } else {
            $action = route('tarefa.store');
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
                <label for="">Titulo</label>
                <input type="text" name="titulo" value="{{ old('tiyulo', $dado->tutulo ?? '') }}">
            </div>
            <div class="col">
                <label for="">descriçao</label>
                <input type="text" name="descricao" value="{{ old('descricao', $dado->descricao ?? '') }}">
            </div>
            <div class="col">
                <label for="">data entrega</label>
                <input type="text" name="dataentrega" value="{{ old('dataentrega', $dado->dataentrega ?? '') }}">
            </div>

        </div>
        <div class="row">
            <div class="col">
                <button type="submit" class="btn btn-success">{{ !empty($dado->id) ? 'Atualizar' : 'Salvar' }}</button>
                <a href="{{ url('aluno') }}" class="btn btn-primary">Voltar</a>
            </div>
        </div>
    </form>
@stop
