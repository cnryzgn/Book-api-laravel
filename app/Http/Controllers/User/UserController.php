<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        if (count($users) === 0) {
            return response()->json([
                'data' => 'Not found any user.'
            ], 404);
        }

        return response()->json([
            'data' => $users
        ], 200);
    }

    public function show($id)
    {
        $user = User::Where('id', $id)->first();

        if (!$user) {
            return response()->json([
                'data' => 'User not found.'
            ], 404);
        }

        return response()->json([
            'data' => $user
        ], 200);
    }

    public function store(Request $request)
    {
        $validation = $request->validate([
            'name' => 'required|min:3|max:255',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:3|max:255'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if (!$user) {
            return response()->json([
                'data' => 'Somethings went wrong!'
            ], 500);
        }

        return response()->json([
            'data' => 'User created!'
        ], 200);
    }

    public function edit(Request $request, $id)
    {
        $validation = $request->validate([
            'name' => 'required|min:3|max:255',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:3|max:255'
        ]);

        $user = User::Where('id', $id)
                    ->update([
                        'name' => $request->name,
                        'email' => $request->email,
                        'password' => Hash::make($request->password),
                    ]);

        if (!$user) {
            return response()->json([
                'data' => 'Somethings went wrong!'
            ], 500);
        }

        return response()->json([
            'data' => 'User updated!'
        ], 200);
    }

    public function destroy($id)
    {
        $user = User::Where('id', $id)->first();

        if (!$user) {
            return response()->json([
                'data' => 'User not found!'
            ], 404);
        }

        $user->delete();

        return response()->json([
            'data' => 'User deleted!'
        ], 200);
    }
}
