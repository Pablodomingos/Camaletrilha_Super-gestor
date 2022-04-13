<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContatoRequest;
use App\Models\MotivoContato;
use App\Models\SiteContato;
use Illuminate\Http\Request;

class ContatoController extends Controller
{
    public function contato() {

        $opcoes = MotivoContato::all();

        return view('site.contato', ['titulo' => 'Contato (teste)', 'opcoes' => $opcoes]);
    }

    public function salvar(ContatoRequest $request) {

        SiteContato::create($request->all());

        return redirect()->back();
        return redirect()->route('site.index');
    }
}
