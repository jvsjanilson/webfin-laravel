<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if (!Auth::attempt($credentials))
        {
            return response()->json(['message' => 'Login inválido.'],Response::HTTP_UNAUTHORIZED);
        }
        
        return response()->json([
            'name' => $request->user()->name,
            'email' => $request->user()->email
        ]);
    }

    public function logout()
    {
        return Auth::logout();
    }
}
