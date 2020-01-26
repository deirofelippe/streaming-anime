<div class="card-body">
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="form-group row">
            Name <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
        </div>

        <div>
            Username <input type="text" name="username">
        </div>

        <div>
            array de permissoes
            Comum: <input type="checkbox" name="permissao" value="comum">
            Admin: <input type="checkbox" name="permissao" value="admin">
        </div>

        <div class="form-group row">
            Email <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
        </div>

        <div class="form-group row">
            Password <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
        </div>

        <div class="form-group row">
            Password confirm <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
        </div>

        <div class="form-group row mb-0">
            <button type="submit" class="btn btn-primary">Register</button>
            <button type="reset" class="btn btn-primary">Limpar</button>
        </div>
    </form>
</div>
