<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Preview</title>

        <style>
            .page-break {
                page-break-after: always;
            }

            .titulo{
                border: 1px;
                width: 100%;
                background-color: #c2c2c2;
                text-align: center;
                text-transform: uppercase;
                font-weight: bolder;
                margin-bottom: 20px
            }

            table th{
                text-align: left;
            }
        </style>
    </head>

    <body>
        <div class="titulo">LIsta de Tarefas</div>

        <table style="width: 100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome Tarefa</th>
                    <th>Data limite de conclusão</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($tarefas as $key => $tarefa)
                    <tr>
                        <td>{{$tarefa->id}}</td>
                        <td>{{$tarefa->tarefa}}</td>
                        <td>{{date('d/m/Y', strtotime($tarefa->data_limite))}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="page-break"></div>
        <h2>Página 2</h2>

        <div class="page-break"></div>
        <h2>Página 3</h2>

        <div class="page-break"></div>
        <h2>Página 4</h2>
    </body>
</html>
