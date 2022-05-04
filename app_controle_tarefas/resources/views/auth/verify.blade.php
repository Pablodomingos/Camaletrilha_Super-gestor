@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Falta pouco agora! Basta verificar se o E-mail cadastrado e valido</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            Reenviamos o e-mail para você com o link  de validação.
                        </div>
                    @endif

                    Antes de prosceguirmos precisamos que você valide o e-mail cadastrado.
                    Se você não recebeu o e-mail
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">Clique aqui para recebe-lo</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
