@extends('layout')

@section('title', 'Users')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/anime/anime.css') }}">
@endsection

@section('content')

@can('isAdmin')
    @include('user.user-form')
@endcan

<section>
    <div class="itens">
        @foreach ($users as $user)
        <div class="coluna item" id="anime-{{ $user->id }}">
            <div class="linha info-principal">
                <div>
                    <img src="{{ url($user->getAvatar()) }}" alt="{{ $user->nome}}" width="210" height="118">
                </div>
                <div>
                    <h1><a href="/user/{{ $user->id }}">{{ $user->username }}</a></h1>
                </div>
                <div>
                    @foreach ($user->permissoes as $permissao)
                        <span>{{ $permissao->permissao }}</span><a href="permissao/remover/{{ $user->id }}/{{ $permissao->id }}">x</a>
                    @endforeach
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>
@endsection
