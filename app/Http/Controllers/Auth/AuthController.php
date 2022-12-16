<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validation = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::Where('email', $request->email)->first();

        if (!$user) {
            return response()->json([
                'data' => 'Invalid email!'
            ], 400);
        }

        $passwordCheck = Hash::check($request->password, $user->password);

        if (!$passwordCheck) {
            return response()->json([
                'data' => 'Invalid password!'
            ], 400);
        }

        /**
         * Check token if exist and if not create  
         */
        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'data' => 'Logged In',
            'token' => $token  
        ], 200);
    }

    public function register(Request $request)
    {
        $validation = $request->validate([
            'name' => 'required|min:3|max:255',
            'email' => 'required|email',
            'password' => 'required|confirmed'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token
        ], 201);
    }

    public function logout(Request $request)
    {
        $token = $request->bearerToken();
        $personelAccessToken = PersonalAccessToken::findToken($token);
        $personelAccessToken->delete();

        return response()->json([
            'data' => 'Logged Out!'
        ], 200);
    }
}
