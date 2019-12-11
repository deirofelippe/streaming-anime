@extends('anime.layout')

@section('title', 'Lista de animes')

@section('content')
<h1>
    Lista de animes
</h1>
<table>
    <thead>
        <tr>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Ano de lançamento</th>
            <th>Avaliação</th>
            <th>Quantidade de avaliações</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($animes as $anime)
        <tr>
            <td>{{ $anime->nome }}</td>
            <td>{{ $anime->descricao }}</td>
            <td>{{ $anime->ano_lancamento }}</td>
            <td>{{ $anime->avaliacao }}</td>
            <td>{{ $anime->num_avaliacoes }}</td>
        </tr>
        @endforeach
        @if (count($animes) < 1)
        <span>Sem registro</span>
        @endif
    </tbody>
    @endsection
</table>
