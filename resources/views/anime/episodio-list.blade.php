@extends('layout')

@section('title', 'Episodios de')

@section('css')
<link rel="stylesheet" href="{{ asset('css/anime/anime-form.css') }}">
@endsection

@section('content')
<h1>
    {{ $anime->nome }} - {{ $anime->id }}
</h1>

<form action="/anime/{{ $anime->id }}/episodio" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}

    <div class="col-50">
        <input name="anime_id" value="{{ $anime->id }}" type="text" hidden>

        <div>
            <label for="titulo">Titulo: </label>
            <input name="titulo" type="text">
        </div>
        {{ $errors->first('titulo') }}

        <div>
            <label for="thumbnail">Thumbnail: </label>
            <input name="thumbnail" type="file">
        </div>
        {{ $errors->first('thumbnail') }}

        <div>
            <label for="num_episodio">Número do episódio: </label>
            <input name="num_episodio" type="text">
        </div>
        {{ $errors->first('num_episodio') }}

        <div>
            <label for="num_temporada">Temporada: </label>
            <input name="num_temporada" type="text">
        </div>
        {{ $errors->first('num_temporada') }}

        <div>
            <label for="video">Video: </label>
            <input type="file" name="video">
        </div>
        {{ $errors->first('video') }}
    </div>

    <div class="col-50">
        <input type="submit" value="Incluir">
    </div>
</form>

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
        @foreach ($episodios as $episodio)
        <tr>
            <td><img src="{{ url($episodio->getThumbnail()) }}" alt="{{ $episodio->titulo }}" width="200" height="100"></td>
            <td><a href="/anime/{{ $anime->id }}/episodio/{{ $episodio->id }}">{{ $episodio->titulo }}</a></td>
            <td>{{ $episodio->num_episodio }}</td>
            <td>{{ $episodio->num_temporada }}</td>
            <td>
                <video width="400" controls>
                    <source src="{{ url($episodio->getVideo()) }}" type="video/mp4" />
                    Seu navegador não suporta HTML5
                </video>

                </td>
                <td>{{ $episodio->views }}</td>
                <td>
                </td>
            </tr>
            @endforeach
            @if (count($episodios) < 1)
            <tr>
                <span>Sem registro</span>
            </tr>
            @endif
        </tbody>
    </table>
    @endsection
