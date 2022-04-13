<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AutenticacaoMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $metodo_autenticacao, $perfil, $param3, $param4)
    {
        // echo $metodo_autenticacao.' - '.$perfil.'<br>';

        // if($metodo_autenticacao == 'padrao') {
        //     echo 'Verificar o usuário e senha no bando de dados <br>';
        // } else {
        //     echo 'Verificar o usuário e senha no AD <br>';
        // }

        // if($perfil == 'visitante') {
        //     echo 'Exibir apenar alguns recursos <br>';
        // } else {
        //     echo 'Carregar perfil do banco de dados <br>';
        // }

        // if(true) {
        //     return $next($request);
        // } else  {
        //     return Response('Você não está autenticado a acessar essa roda.');
        // }

        session_start();

        if(isset($_SESSION['email']) && $_SESSION['email'] != '') {
            return $next($request);
        } else {
            return redirect(route('site.login', ['erro' => 2]));
        }
    }
}
