@extends('app.layouts.basico')

@section('titulo', 'Home')

@section('conteudo')

    <div class="conteudo-pagina">

        <div class="titulo-pagina2">
            <p>Fornecedor - Listar</p>
        </div>

        <div class="menu">
            <ul>
                <li><a href="{{ route('app.fornecedor.adicionar') }}">Novo</a></li>
                <li><a href="{{ route('app.fornecedor') }}">Consulta</a></li>
            </ul>
        </div>

        <div class="informacao-pagina">
            <div style="width: 90%; margin-left: auto; margin-right: auto;">
                <table border="1" width="100%">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>site</th>
                            <th>UF</th>
                            <th>E-mail</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($fornecedores as $fornecedor)
                            <tr>
                                <th>{{ $fornecedor->nome }}</th>
                                <th>{{ $fornecedor->site }}</th>
                                <th>{{ $fornecedor->uf }}</th>
                                <th>{{ $fornecedor->email }}</th>
                                <th>Editar</th>
                                <th>Excluir</th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
