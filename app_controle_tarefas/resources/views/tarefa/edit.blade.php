@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Atualizar Tarefa</div>

                <div class="card-body">
                    <form method="POST" action="{{route('tarefa.update', ['tarefa' => $tarefa->id])}}">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="tarefaLabel" class="form-label">Tarefa</label>
                            <input type="text" value="{{ old('tarefa') ?? $tarefa->tarefa }}" class="form-control @error('tarefa') is-invalid @enderror" id="tarefaLabel" name="tarefa">
                            @error('tarefa')
                                <ul style="color: red">{{$message}}</ul>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="dataLimite" class="form-label">Data limite de conclusão</label>
                            <input type="date" value="{{ $tarefa->data_limite }}" class="form-control @error('data_limite') is-invalid @enderror" id="dataLimite" name="data_limite">
                            @error('data_limite')
                                <ul style="color: red">{{$message}}</ul>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Atualizar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
