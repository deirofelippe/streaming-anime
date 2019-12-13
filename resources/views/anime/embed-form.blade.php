@extends('layout')

@section('title', '{{$episodio->titulo}} ep. {{$episodio->num_episodio}} assistir')

@section('content')
<h1>Episódio: {{ $episodio->num_episodio }} - {{ $episodio->titulo }}</h1>
<a href="/{{$episodio->id}}/embeds">LISTAR EMBED</a>
<fieldset class="col-100">
    <legend class="centralizado">Embed Video: </legend>

    <form action="/embed" method="POST">
        {{ csrf_field() }}
        <div class="col-50">
            <input name="episodio_id" value="{{ $episodio->id }}" type="text" hidden>

            Nome: <input name="nome" type="text">
            Código html: <textarea name="codigo_embed"></textarea>

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
                <option value="1">SUB</option>
                <option value="2">DUB</option>
            </select>
        </div>

        <div class="col-50">
            <input type="submit" value="Incluir">
        </div>
    </form>
</fieldset>
@endsection

