<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {

    }
    public function login(Request $request)
    {
        $credi = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(Auth::attempt($credi)){
            return response()->json([
                'message' => 'login successfully',
                'token' => Auth::user()->createToken('token_name')->plainTextToken,
            ]);
        }
        return response()->json(['message'=>'login failed']);
    }
    public function logout()
    {

        Auth::user()->tokens()->delete();

        return response()->json([
            'message' => 'successfuly logout'
        ]);

    }
}
