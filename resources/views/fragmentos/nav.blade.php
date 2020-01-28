<header>
    <nav id="nav">
        <ul id="nav-left">
            <li><a href="/">HOME</a></li>
            <li><a href="#">ANIMES</a>
                <ul>
                    <li><a href="/anime">LIST ANIME</a></li>
                </ul>
            </li>
            <li><a href="#">MANGÁS</a></li>
            <li><a href="#">FÓRUM</a></li>
            <li><a href="#">NOTÍCIAS</a></li>
            <li><a href="/guilda">GUILDA</a></li>
            @can('isAdmin')
                <li><a href="/users">USUÁRIO</a></li>
            @endcan
        </ul>

        <ul id="nav-right">
            <li><a href="#">ALEATÓRIO</a></li>
            <li>AUTH
                <ul>
                    @include('fragmentos.auth')
                </ul>
            </li>
            <li>
                <div id="busca">
                    <form action="/anime/buscar" method="GET">
                        <input id="nome" type="text" name="nome" placeholder="Anime, mangá, etc.">
                        <input type="submit" value="BUSCAR">
                    </form>
                </div>
            </li>
        </ul>
    </nav>
</header>
