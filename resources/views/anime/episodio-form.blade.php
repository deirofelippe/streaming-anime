@extends('layout')

@section('title', 'Formulário de anime')

@section('content')
<h1>Anime: {{ $anime->nome }}</h1>

<fieldset class="col-100">
    <legend class="centralizado">Episódio: </legend>

    <form action="/episodio" method="POST">
        {{ csrf_field() }}

        <div class="col-50">
            <input name="anime_id" value="{{ $anime->id }}" type="text" hidden>

            <label for="">Titulo: </label>
            <input name="titulo" type="text">

            <label for="">Thumbnail: </label>
            <input name="thumbnail" type="text">

            <label for="">Número do episódio: </label>
            <input name="num_episodio" type="text">

            <label for="">Temporada: </label>
            <input name="num_temporada" type="text">

            <label for="tags">Tags: </label>
            <input name="tags" id="tags" type="text" placeholder="Ação, Drama, Histórico...">
        </div>

        <div class="col-50">
            <input type="submit" value="Incluir">
        </div>
    </form>
</fieldset>

<fieldset class="col-100">
    <legend class="centralizado">Embed Video: </legend>

    <form action="/embed/add" method="POST">
        {{ csrf_field() }}
        <div class="col-50">
            Nome: <input type="text">
            Código html: <textarea name="" id="" cols="30" rows="10" ></textarea>

            Resolução:
            <select name="resolucao">
                <option value="0">Seleciona algo</option>
                <option value="1">SD</option>
                <option value="2">HD</option>
                <option value="3">FULL HD</option>
                <option value="4">4K</option>
            </select>

            Tipo:
            <select name="sub_dub">
                <option value="0">Selecione algo</option>
                <option value="1">DUB</option>
                <option value="2">SUB</option>
            </select>
        </div>

        <div class="col-50">
            <input type="submit" value="Incluir">
        </div>
    </form>
</fieldset>
@endsection

