<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Models\User;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        $erro = '';

        if($request->erro == 1) {
            $erro = 'Email ou senha não existem.';
        }else if($request->erro == 2) {
            $erro = 'Necessário realizar o login para ter acesso a página.';
        }

        return view('site.login', ['titulo'=>'Login', 'erro' => $erro]);
    }

    public function autenticar(LoginRequest $request)
    {
        $email = $request->email;
        $senha = $request->password;

        $usuario = User::where('email', $email)
            ->where('password', $senha)
            ->get()
            ->first();

        if(isset($usuario)) {
            session_start();

            $_SESSION['name'] = $usuario->name;
            $_SESSION['email'] = $usuario->email;

            return redirect(route('app.home'));
        } else {
            return redirect(route('site.login', ['erro' => 1]));
        }
    }

    public function sair() {
        session_destroy();
        return redirect(route('site.index'));
    }
}
