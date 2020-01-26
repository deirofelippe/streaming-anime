@extends('layout')

@section('title', 'Episodio')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/anime/anime.css') }}">
@endsection

@section('content')
<section>
    <div>
        <img src="{{ url($user->getAvatar()) }}" alt="" width="210" height="118">
        <h1>{{ $user->name }}</h1>
        <h1>{{ $user->username }}</h1>
        <h1>{{ $user->descricao }}</h1>
        <h1>{{ $user->dataDeNascimento }}</h1>
        <h1>{{ $user->email }}</h1>
    </div>
</section>
@endsection
