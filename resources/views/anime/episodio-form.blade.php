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
