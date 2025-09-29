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

        <!-- <div class="form-group">
            <label for="grau_importancia_id">Grau de Importância</label>
            <select name="grau_importancia_id" id="grau_importancia_id" class="form-control">
                @foreach($graus as $g)
                    <option value="{{ $g->id }}" 
                        {{ old('grau_importancia_id', $dado->grau_importancia_id) == $g->id ? 'selected' : '' }}>
                        {{ $g->nome }}
                    </option>
                @endforeach
            </select>
        </div> -->

            <div class="mb-3">
                <label for="grau_importancia_id" class="form-label">Grau de Importância</label>
                    <select name="grau_importancia_id" class="form-control">
                        <option value="">-- Selecione --</option>
                        @foreach($graus as $grau)
                            <option value="{{ $grau->id }}" {{ old('grau_importancia_id', $dado->grau_importancia_id) == $grau->id ? 'selected' : '' }}>
                                {{ $grau->nome }}
                            </option>
                        @endforeach
                    </select>
            </div>



        <div class="mb-3">
            <label for="prazo">Data entrega</label>
            <input type="date" name="dataentrega" value="{{ old('dataentrega', $dado->dataentrega) }}" class="form-control">
        </div>

        <div class="form-check">
            <input type="checkbox" name="concluida" class="form-check-input" {{ $dado->concluida ? 'checked' : '' }}>
            <label class="form-check-label">Concluída</label>
        </div>

           <div class="mb-3">
    <label for="projeto_id" class="form-label">Projeto</label>
    <select name="projeto_id" class="form-control">
        <option value="">-- Selecione --</option>
        @foreach($projetos as $projeto)
            <option value="{{ $projeto->id }}" 
                {{ old('projeto_id', $dado->projeto_id) == $projeto->id ? 'selected' : '' }}>
                {{ $projeto->nome }}
            </option>
        @endforeach
    </select>
</div>
        

        <button type="submit" class="btn btn-success">Salvar</button>
    </form>
@stop
