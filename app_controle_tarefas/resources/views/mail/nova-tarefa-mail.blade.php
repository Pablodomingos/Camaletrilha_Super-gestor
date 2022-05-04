@component('mail::message')
# {{ $tarefa }}

Data limite da tarefa: {{ $data_limite }}

@component('mail::button', ['url' => $url])
Clique aqui apra ver a tarefa!
@endcomponent

Att,<br>
{{ config('app.name') }}
@endcomponent
