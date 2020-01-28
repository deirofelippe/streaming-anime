@extends('layout')

@section('title', 'Animes')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/anime/anime.css') }}">
@endsection

@section('content')
@can('isAdmin')
    @include('anime.anime-form')
@endcan

<section>
    <div class="itens">
        @foreach ($animes as $anime)
        <div class="coluna item" id="anime-{{ $anime->id }}">
            <div class="linha info-principal">
                <div>
                    <img src="{{ url($anime->getThumbnail()) }}" alt="{{ $anime->nome}}" width="210" height="118">
                </div>
                <div>
                    <h1><a href="/anime/{{ $anime->id }}/episodios">{{ $anime->nome }}</a></h1>
                </div>
            </div>

            {{-- <div class="info-detalhes">
                {{ $anime->nome }}
                {{ $anime->sinopse }}
                {{ $anime->studio }}
                {{ $anime->getStatus() }}
                {{ $anime->ano_lancamento }}
                {{ $anime->avaliacao }}
            </div> --}}
        </div>
        @endforeach
    </div>
</section>
@endsection
