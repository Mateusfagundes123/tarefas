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

   <form action="{{ route('tarefa.store') }}" method="POST">
    @csrf

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
        <input type="date" name="prazo" value="{{ old('prazo', $dado->prazo) }}" class="form-control">
    </div>

    <div class="mb-3">
        <label for="categoria_id">Categoria</label>
        <select name="categoria_id" class="form-control">
            @foreach ($categorias as $categoria)
                <option value="{{ $categoria->id }}"
                    {{ old('categoria_id', $dado->categoria_id) == $categoria->id ? 'selected' : '' }}>
                    {{ $categoria->nome }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="form-check">
        <input type="checkbox" name="concluida" class="form-check-input" {{ $dado->concluida ? 'checked' : '' }}>
        <label class="form-check-label">Concluída</label>
    </div>

    <button type="submit" class="btn btn-success">Salvar</button>
</form>

@stop
