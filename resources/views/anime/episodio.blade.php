@extends('layout')

@section('title', 'Episodio')

@section('css')
    {{-- <link rel="stylesheet" href="{{ asset('css/anime/anime-form.css') }}"> --}}
@endsection

@section('content')
<section>
    <div>
        <video width="980" height="600" controls>
            <source src="{{ url($episodio->getVideo()) }}" type="video/mp4" />
            Seu navegador não suporta HTML5
        </video>
        <h1>{{ $episodio->titulo }}</h1>
    </div>

    <div>
        <div>mover o carosel p esquerda</div>

        <div>
            <img src="{{ url($episodio->getThumbnail()) }}" alt="" width="210" height="118">
            <h2>numero episodio e temporada</h2>
            <h2>titulo</h2>
            <span>tempo assistido</span>
        </div>

        <div>mover o carosel p direita</div>
    </div>

    <h1>comentarios</h1>
    <div>
        <div>
            <form action="" method="post">
                <textarea name="" id="" cols="30" rows="10"></textarea>
                <input type="checkbox" name="" id="">
                <input type="submit" value="">
            </form>
        </div>

        <div>
            <div>
                <div><img src="" alt="avatar"></div>
                <div>
                    <p>nome</p>
                    <p>corpo do comentario</p>
                </div>
                <div>
                    <button>curtir</button>
                    <button>responder</button>
                </div>
            </div>

            <div>mais comentarios</div>
        </div>
    </div>

    <h1>manga relacionado</h1>
    <div>
        <div>
            <div>
                <img src="" alt="capa do manga">
            </div>

            <div>
                <h2>nome</h2>
                <p>numero de caps</p>
                <p>status: </p>
                <p>autor</p>
            </div>

            <div>
                <span>tag1</span>
                <span>tag2</span>
            </div>

            <div>
                <h3>sinopse</h3>
                <p>corpo</p>
            </div>
        </div>

        <div>
            <h2>este episodio esta a partir do: </h2>
            <div>
                <img src="" alt="capa do manga">
            </div>
            <div>
                <h3>nome manga</h3>
                <p>nome cap</p>
                <p>num cap</p>
                <button>ler capitulo</button>
            </div>
        </div>

        <div>
            <h2>avaliacao dos usuarios</h2>
            <div>
                <p>avaliacao media</p>
                <span>estrelas</span>
            </div>
            <div>
                5 <span>barra de total avaliado</span>
                4 <span>barra de total avaliado</span>
                3 <span>barra de total avaliado</span>
                2 <span>barra de total avaliado</span>
                1 <span>barra de total avaliado</span>
            </div>
            <a href="#">ler analises</a>
        </div>
    </div>
</section>
@endsection
