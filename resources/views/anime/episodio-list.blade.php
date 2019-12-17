@extends('layout')

@section('title', 'Episodios de {{ $anime->nome }}')

@section('content')
<h1>
    {{ $anime->nome }}
</h1>
<fieldset class="col-100">
    <legend class="centralizado">Episódio: </legend>

    <form action="/anime/{{ $anime->id }}/episodio" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="col-50">
            <input name="anime_id" value="{{ $anime->id }}" type="text" hidden>

            <label for="">Titulo: </label>
            <input name="titulo" type="text">

            <label for="">Thumbnail: </label>
            <input name="thumbnail" type="file">

            <label for="">Número do episódio: </label>
            <input name="num_episodio" type="text">

            <label for="">Temporada: </label>
            <input name="num_temporada" type="text">

            <label for="video">Video: </label>
            <input type="file" name="video">
        </div>

        <div class="col-50">
            <input type="submit" value="Incluir">
        </div>
    </form>
</fieldset>

<table>
    <thead>
        <tr>
            <th>Thumbnail</th>
            <th>Titulo</th>
            <th>Episodio</th>
            <th>Temporada</th>
            <th>Vídeo</th>
            <th>Views</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($anime->episodios as $episodio)
        <tr>
            <td><img src="{{ url($episodio->getThumbnail()) }}" alt="{{ $episodio->titulo }}" width="200" height="100"></td>
            <td><a href="/anime/{{ $anime->id }}/episodio/{{ $episodio->id }}">{{ $episodio->titulo }}</a></td>
            <td>{{ $episodio->num_episodio }}</td>
            <td>{{ $episodio->num_temporada }}</td>
            <td>
                <video width="400" controls>
                    <source src="{{ url($episodio->getVideo()) }}" type="video/mp4">
                    Seu navegador não suporta HTML5
                </video>

            </td>
            <td>{{ $episodio->views }}</td>
            <td>
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
