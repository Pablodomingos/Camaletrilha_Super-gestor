<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request) {

        $credencial = $request->only('email','password');

        if (!$token = auth()->attempt($credencial)) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        return  response()->json(['token' => $token], 200);
    }

    public function logout() {
        auth('api')->logout();
        return response()->json(['msg' => 'Logout realizado com sucesso.']);
    }

    public function refresh() {
        $token = auth('api')->refresh(); //cliente encaminha um jwt válido
        return response()->json(['token' => $token]);
    }

    public function me() {
        return response()->json((auth()->user()));
    }
}
