@extends('layout')

@section('title', 'Episodios')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/anime/anime.css') }}">
@endsection

@section('content')

@include('anime.episodio-form')

<h1>
    {{ $anime->nome }}
</h1>

<section>
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
                    <td><img src="{{ url($episodio->getThumbnail()) }}" alt="{{ $episodio->titulo }}" width="210" height="118"></td>
                    <td><a href="/anime/{{ $anime->id }}/episodio/{{ $episodio->id }}">{{ $episodio->titulo }}</a></td>
                    <td>{{ $episodio->num_episodio }}</td>
                    <td>{{ $episodio->num_temporada }}</td>
                    <td>
                        <video width="210" height="118" controls>
                            <source src="{{ url($episodio->getVideo()) }}" type="video/mp4" />
                            Seu navegador não suporta HTML5
                        </video>
                    </td>
                    <td>{{ $episodio->views }}</td>
                </tr>
            @endforeach

            @if (count($episodios) < 1)
                <tr>
                    <span>Sem registro</span>
                </tr>
            @endif
        </tbody>
    </table>
</section>
@endsection
