<?php

namespace App\Http\Controllers;

use App\Models\MotivoContato;
use Illuminate\Http\Request;

class PrincipalController extends Controller
{
    public function principal() {

        $opcoes = MotivoContato::all();

        return view('site.principal', compact('opcoes'));
    }
}
