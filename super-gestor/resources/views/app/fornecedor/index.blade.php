@extends('app.layouts.basico')

@section('titulo', 'Home')

@section('conteudo')

    <div class="conteudo-pagina">

        <div class="titulo-pagina2">
            <p>Fornecedor</p>
        </div>

        <div class="menu">
            <ul>
                <li><a href="{{ route('app.fornecedor.adicionar') }}">Novo</a></li>
                <li><a href="{{ route('app.fornecedor') }}">Consulta</a></li>
            </ul>
        </div>

        <div class="informacao-pagina">
            <div style="width: 30%; margin-left: auto; margin-right: auto;">
                <form action="{{ route('app.fornecedor.lista') }}" method="POST">
                    @csrf
                    @component('app.layouts._partials.fornecedor_form', ['nome' => 'Pesquisa'])
                    @endcomponent
                </form>
            </div>
        </div>
    </div>

@endsection
