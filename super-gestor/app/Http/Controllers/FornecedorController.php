<?php

namespace App\Http\Controllers;

use App\Http\Requests\FornecedorRequest;
use App\Models\Fornecedor;
use Illuminate\Http\Request;

class FornecedorController extends Controller
{
    public function index() {
        return view('app.fornecedor.index');
    }

    public function adicionar(FornecedorRequest $request) {

        $msg = '';

        if($request?->_token) {
            Fornecedor::create($request->all());
            $msg = 'Cadastro realizado com sucesso';
        }

        return view('app.fornecedor.adicionar', compact('msg'));
    }

    public function consulta(Request $request) {

        $fornecedores = Fornecedor::where('nome', 'LIKE', '%'.$request->nome.'%')
                                ->where('site', 'LIKE', '%'.$request->site.'%')
                                ->where('uf', 'LIKE', '%'.$request->uf.'%')
                                ->where('email', 'LIKE', '%'.$request->email.'%')
                                ->get();

        return view('app.fornecedor.listar', compact('fornecedores'));
    }
}
