@extends('layout')

@section('title', 'Episodios de {{ $anime->nome }}')

@section('content')
<h1>
    {{ $anime->nome }}
</h1>
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
<table>
    <thead>
        <tr>
            <th>Titulo</th>
            <th>Thumbnail</th>
            <th>Temporada</th>
            <th>Episodio</th>
            <th>Views</th>
            <th>Tags</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($anime->episodios as $episodio)
        <tr>
            <td><a href="/{{ $episodio->id }}/embed">{{ $episodio->titulo }}</a></td>
            <td>{{ $episodio->thumbnail }}</td>
            <td>{{ $episodio->num_temporada }}</td>
            <td>{{ $episodio->num_episodio }}</td>
            <td>{{ $episodio->views }}</td>
            <td>
                @foreach ($episodio->tags as $tag)
                @if ($loop->iteration != $loop->count)
                <span>{{ $tag->nome }} <a href="#">x</a></span>,
                @else
                <span>{{ $tag->nome }} <a href="#">x</a></span>
                @endif
                @endforeach
            </td>
        </tr>
        @endforeach
        @if (count($anime->episodios) < 1)
        <tr>
            <span>Sem registro</span>
        </tr>
        @endif
    </tbody>
</table>
@endsection
