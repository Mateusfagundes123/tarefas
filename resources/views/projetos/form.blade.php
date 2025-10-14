@extends('base')

@section('titulo', isset($projeto) ? 'Editar Projeto' : 'Novo Projeto')

@section('conteudo')
<a href="{{ url('/') }}">
    <button >
        <img src="{{ asset('img/voltar.png') }}" alt="Voltar" width="15" height="15">
    </button>
</a>
<h1>Cadastrar projetos</h1>
    @php
        if (!empty($projeto->id)) {
            $action = route('projetos.update', $projeto->id);
            $method = 'PUT';
        } else {
            $action = route('projetos.store');
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
            <input type="date" name="prazo" 
                value="{{ old('prazo', isset($projeto->prazo) ? \Carbon\Carbon::parse($projeto->prazo)->format('Y-m-d') : '') }}" 
                class="form-control">
        </div>

        <div class="mb-3">
            <label for="tarefas" class="form-label">Tarefas</label>
            <select name="tarefas[]" class="form-control" multiple>
                @foreach($tarefas as $tarefa)
                    <option value="{{ $tarefa->id }}"
                        @if(isset($projeto) && $projeto->tarefas->contains($tarefa->id)) selected @endif>
                        {{ $tarefa->titulo }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Salvar</button>
    </form>
@stop
