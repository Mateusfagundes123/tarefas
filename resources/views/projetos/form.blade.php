@extends('base')

@section('titulo', isset($projeto) ? 'Editar Projeto' : 'Novo Projeto')

@section('conteudo')
<head>
      <link rel="icon" type="image/png" href="../IMg/gato.png">
</head>

 <a href="{{ url('/') }}">
            <button class="btn btn-outline-primary btn-lg d-flex align-items-center justify-content-center"
                    style="width: 55px; height: 55px; border-radius: 50%;">
                <img src="{{ asset('img/voltar.png') }}" alt="Voltar" width="20" height="20">
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
        <label class="form-label">Tarefas</label>
        <div class="form-check-group" style="display: flex; flex-direction: column; gap: 5px;">
            @foreach($tarefas as $tarefa)
                <div class="form-check">
                    <input 
                        type="checkbox" 
                        name="tarefas[]" 
                        value="{{ $tarefa->id }}" 
                        id="tarefa_{{ $tarefa->id }}"
                        class="form-check-input"
                        @if(isset($projeto) && $projeto->tarefas->contains($tarefa->id)) checked @endif
                    >
                    <label class="form-check-label" for="tarefa_{{ $tarefa->id }}">
                        {{ $tarefa->titulo }}
                    </label>
                </div>
            @endforeach
        </div>
    </div>


        <button type="submit" class="btn btn-success">Salvar</button>
    </form>
@stop
