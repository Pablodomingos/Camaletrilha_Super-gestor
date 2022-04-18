<?php

namespace App\Http\Controllers;

use App\Http\Requests\CadastroRequest;
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

    public function cadastro(Request $request) {
        $erro = $request->erro;

        if($erro == 1) {
            $erro = 'Email já cadastrado';
        } else if($erro == 2) {
            $erro = 'Ambas senhas tem que ser iguais';
        }

        return view('site.cadastro', compact('erro'));
    }

    public function autenticacao_cadastro(CadastroRequest $request){
        $email = $request->email;
        $senha = $request->newPassword;
        $confimacaoSenha = $request->password;

        $emailBd = User::where('email', $email)
            ->get()
            ->first();

        if($emailBd) {
            return redirect(route('cadastro', ['erro' => 1]));
        }else if (($senha != $confimacaoSenha)) {
            return redirect(route('cadastro', ['erro' => 2]));
        }

        $data = $request->except('newPassword');
        User::create($data);
        return redirect(route('site.login'));
    }

    public function sair() {
        session_destroy();
        return redirect(route('site.index'));
    }
}
