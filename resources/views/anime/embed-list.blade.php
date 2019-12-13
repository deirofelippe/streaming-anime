@extends('layout')

@section('title', 'Episodios de {{ $anime->nome }}')

@section('content')
<h1>
    Episódio {{ $episodio->num_episodio }} - {{ $episodio->titulo }}
</h1>
<a href="/{{$episodio->id}}/embed">CRIAR EMBED</a>
<div>
    @foreach ($episodio->embedVideos as $embed)
        <br>
        {{$embed->nome}}
        <br>
        @switch($embed->resolucao)
            @case(1)
                SD
                @break
            @case(2)
                HD
                @break
            @case(3)
                FULL HD
                @break
            @case(4)
                4K
                @break
            @default
                ERROR
        @endswitch
        <br>
        @switch($embed->sub_dub)
            @case(1)
                SUB
                @break
            @case(2)
                DUB
                @break
            @default
                ERROR
        @endswitch
        <br>
        <div>
            {!! $embed->codigo_embed !!}
        </div>
    @endforeach
</div>
@endsection
