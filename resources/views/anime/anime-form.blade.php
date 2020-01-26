<div id="mensagens">
    @isset($success)
        <span class="info">
            {{ $success }}
        </span>
    @endisset

    <span class="error">
        {{ $errors->first('error') }}
    </span>
</div>

<form action="/anime" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="col-50">
        <div>
            <label for="nome">Nome: </label>
            <input name="nome" id="nome" type="text">
        </div>
        <span>{{ $errors->first('nome') }}</span>

        <div>
            <label for="estudio">Estudio: </label>
            <input name="estudio" id="estudio" type="text">
        </div>
        <span>{{ $errors->first('estudio') }}</span>

        <div>
            <label for="thumbnail">Thumbnail: </label>
            <input type="file" name="thumbnail">
        </div>
        <span>{{ $errors->first('thumbnail') }}</span>

        <div>
            <label for="sinopse">Sinopse: </label>
            <textarea name="sinopse" id="sinopse" cols="30" rows="10"></textarea>
        </div>
        <span>{{ $errors->first('sinopse') }}</span>

        <div>
            Status: <select name="status">
                <option value="-1">Selecione algo</option>
                <option value="0">Em andamento</option>
                <option value="1">Concluído</option>
                <option value="2">Cancelado</option>
            </select>
        </div>
        <span>{{ $errors->first('status') }}</span>

        <div>
            <label for="ano_lancamento">Ano de lançamento: </label>
            <input name="ano_lancamento" id="ano_lancamento" type="text">
        </div>
        <span>{{ $errors->first('ano_lancamento') }}</span>

        <div>
            <label for="tags">Tags: </label>
            <input name="tags" id="tags" type="text" placeholder="Ação, Drama, Histórico...">
        </div>
    </div>

    <div class="col-50">
        <input type="submit" value="Incluir">
        <input type="reset" value="Limpar">
    </div>
</form>
