@extends('layouts.app')

@section('content')

@if (Session::has('success'))
    <div class="alert alert-danger alert-elevate col-sm-12" role="alert">
        <div class="alert-icon"><i class="flaticon2-checkmark text-light"></i></div>
        <div class="alert-text">
            {{Session::get('success')}}<br>
        </div>
    </div>
@endif

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Tarefas
                    <a href="{{route('tarefa.exportacao')}}" style="float: right" target="_blank">
                        PDF V2
                    </a>
                    <a href="{{route('tarefa.exportar', ['tipo_exportacao' => 'pdf'])}}" style="float: right;margin-right: 20px">
                        PDF
                    </a>
                    <a href="{{route('tarefa.exportar', ['tipo_exportacao' => 'csv'])}}" style="float: right;margin-right: 20px">
                        CSV
                    </a>
                    <a href="{{route('tarefa.exportar', ['tipo_exportacao' => 'xlsx'])}}" style="float: right;margin-right: 20px">
                        XLSX
                    </a>
                    <a href="{{route('tarefa.create')}}" style="float: right;margin-right: 20px">
                        Novo
                    </a>
                </div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Tarefa</th>
                                <th scope="col">Data Limite de Conclusão</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tarefas as $tarefa)
                                <tr>
                                    <td>{{$tarefa->id}}</td>
                                    <td>{{$tarefa->tarefa}}</td>
                                    <th scope="row">{{date('d/m/Y', strtotime($tarefa->data_limite))}}</th>
                                    <th>
                                        <a href="{{ route('tarefa.edit', ['tarefa' => $tarefa->id]) }}">Editar</a>

                                        <form id="form_{{ $tarefa->id }}" method="POST" action="{{ route('tarefa.destroy', ['tarefa' => $tarefa->id]) }}">
                                            @method('delete')
                                            @csrf
                                        </form>

                                        <a href="#" onclick="document.getElementById('form_{{$tarefa->id}}').submit()">Excluir</a>
                                    </th>
                                </tr>
                            @endforeach
                        </tbody>
                      </table>

                      <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link" href="{{ $tarefas->previousPageUrl() }}">Voltar</a></li>

                            @for($i = 1; $i <= $tarefas->lastPage(); $i++)
                                <li class="page-item  {{ $tarefas->currentPage() == $i ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $tarefas->url($i) }}">{{ $i }}</a>
                                </li>
                            @endfor

                            <li class="page-item"><a class="page-link" href="{{ $tarefas->nextPageUrl() }}">Avançar</a></li>
                        </ul>
                      </nav>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
