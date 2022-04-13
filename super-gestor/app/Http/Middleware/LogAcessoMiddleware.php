<?php

namespace App\Http\Middleware;

use App\Models\LogAcesso;
use Closure;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;

class LogAcessoMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $ip = $request->ip();
        $url = $request->url();

        LogAcesso::create(['log' => "IP:$ip requisitou a rota:$url"]);
        
        $resposta = $next($request);

        $resposta->setStatusCode('201', 'O status da resposta e o texto da resposta foram modificados!!!');

        return $resposta;
        return Response('Olá você chegou no middleware!');
    }
}
