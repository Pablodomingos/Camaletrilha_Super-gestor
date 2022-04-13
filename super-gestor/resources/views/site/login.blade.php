@extends('site.layouts.basico')

@section('titulo', $titulo)

@section('conteudo')
    <div class="conteudo-pagina">
        <div class="titulo-pagina">
            <h1>Entre em contato conosco</h1>
        </div>

        <div class="informacao-pagina" style="text-align: left">
            <div style="width:30%; margin: auto">
                <form action="{{ route('site.form') }}" method="POST">
                @csrf
                <label for="email">Email</label>
                <input value="{{ old('email') }}" type="email" id="email" name="email" class="borda-preta @error('email') is-invalid @enderror" placeholder="Digite sua email.">
                @error('email')
                    <div style="color: red"><li>{{ $message }}</li></div>
                @enderror

                <label for="password">Senha</label>
                <input type="password" id="password" name="password" class="borda-preta @error('password') is-invalid @enderror" placeholder="Digite sua senha.">
                @error('password')
                    <div style="color: red"><li>{{ $message }}</li></div>
                @enderror
                
                <button class="borda-branca" type="submit">Login</button>
                </form>

                <div style="text-align: center">{{ isset($erro) ? $erro : '' }}</div>
            </div>
        </div>
    </div>

    <div class="rodape">
        <div class="redes-sociais">
            <h2>Redes sociais</h2>
            <img src="{{ asset('img/facebook.png') }}">
            <img src="{{ asset('img/linkedin.png') }}">
            <img src="{{ asset('img/youtube.png') }}">
        </div>
        <div class="area-contato">
            <h2>Contato</h2>
            <span>(11) 3333-4444</span>
            <br>
            <span>supergestao@dominio.com.br</span>
        </div>
        <div class="localizacao">
            <h2>Localização</h2>
            <img src="{{ asset('img/mapa.png') }}">
        </div>
    </div>
@endsection
