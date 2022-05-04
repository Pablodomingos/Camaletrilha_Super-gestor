Seja bem vindo ao site
<br/>

{{-- Tudo que for colocado dentro do auth só vai aparecer
    para o usuário que estiver autenticado --}}
@auth
    Usuario autenticado.
    <p>ID-> {{Auth::user()->id}}</p>
    <p>Nome-> {{Auth::user()->name}}</p>
    <p>E-mail-> {{Auth::user()->email}}</p>
@endauth

{{-- Tudo que estiver dentro do guest só vai aparecer
    para o usuário que não estiver autenticado --}}
@guest
    Olá visitante, como vai ?
    <br/>
    ...
    <br/>
    ...
@endguest
