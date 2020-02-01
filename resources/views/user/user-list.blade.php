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
                    <img src="{{ url($user->getAvatar()) }}" alt="{{ $user->name}}" width="210" height="118">
                </div>
                <div>
                    <h1><a href="/user/{{ $user->id }}">{{ $user->name }}</a></h1>
                </div>
                @foreach ($user->getRoles() as $role)
                    <h1>{{ $role->role }}</h1>
                @endforeach
            </div>
        </div>
        @endforeach
    </div>
</section>
@endsection
