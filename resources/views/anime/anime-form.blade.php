@extends('layout')

@section('title', 'Formulário de anime')

@section('content')
<fieldset class="col-100">
    <legend class="centralizado">Anime: </legend>

    <form action="/anime" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="col-50">
            <label for="nome">Nome: </label>
            <input name="nome" id="nome" type="text">
            <span>{{ $errors->first('nome') }}</span>

            <label for="estudio">Estudio: </label>
            <input name="estudio" id="estudio" type="text">
            <span>{{ $errors->first('estudio') }}</span>

            <label for="thumbnail">Thumbnail: </label>
            <input type="file" name="thumbnail">

            <label for="descricao">Descrição: </label>
            <textarea name="descricao" id="descricao" cols="30" rows="10"></textarea>
            <span>{{ $errors->first('descricao') }}</span>

            Status: <select name="status">
                <option value="-1">Selecione algo</option>
                <option value="0">Em andamento</option>
                <option value="1">Concluído</option>
                <option value="2">Cancelado</option>
            </select>

            <label for="ano_lancamento">Ano de lançamento: </label>
            <input name="ano_lancamento" id="ano_lancamento" type="text" max="4">
            <span>{{ $errors->first('ano_lancamento') }}</span>

            <label for="tags">Tags: </label>
            <input name="tags" id="tags" type="text" placeholder="Ação, Drama, Histórico...">
        </div>

        <div class="col-50">
            <input type="submit" value="Incluir">
        </div>
    </form>
</fieldset>
@endsection
