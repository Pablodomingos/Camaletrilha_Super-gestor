@extends('site.layouts.basico')

@section('titulo', 'Cadastro')

@section('conteudo')
    <div class="conteudo-pagina">
        <div class="titulo-pagina">
            <h1>Faça seu cadastro</h1>
        </div>

        <div class="informacao-pagina" style="text-align: left">
            <div style="width:30%; margin: auto">
                <form action="{{ route('cadastro.form') }}" method="POST">
                    @csrf
                    <label for="name">Nome</label>
                    <input value="{{ old('name') }}" type="text" name="name" id="name" class="@error('name') is-invalid @enderror">
                    @error('name')
                        <div style="color: red"><li>{{ $message }}</li></div>
                    @enderror

                    <label for="email">Email</label>
                    <input value="{{ old('email') }}" type="text" name="email" id="email" class="@error('email') is-invalid @enderror">
                    @error('email')
                        <div style="color: red"><li>{{ $message }}</li></div>
                    @enderror

                    <label for="password">Senha</label>
                    <input type="password" name="password" id="password" class="@error('password') is-invalid @enderror">
                    @error('password')
                        <div style="color: red"><li>{{ $message }}</li></div>
                    @enderror

                    <label for="newPassword">Digite de novo</label>
                    <input type="password" name="newPassword" id="newPassword" class="@error('newPassword') is-invalid @enderror">
                    @error('newPassword')
                        <div style="color: red"><li>{{ $message }}</li></div>
                    @enderror

                    <div style="text-align: center">{{ isset($erro) ? $erro : '' }}</div>

                    <button type="submit">Cadastrar</button>
                    <a style="width: 100%; background-color:blueviolet; color:black; padding:8px 0; display:block; text-align:center; text-decoration:none; border-radius: 3px" href="{{ route('site.login') }}">Voltar</a>
                </form>
            </div>
        </div>
    </div>
@endsection
