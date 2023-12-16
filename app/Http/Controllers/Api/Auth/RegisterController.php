<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    public function register(Request $request){
        $request->validate([
            'fullname' => 'required|string',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string',
            'role' => 'required|string'
        ]);

        $user = User::create([
            'fullname' => $request->fullname,
            'email' => $request->email,
            'password' => $request->password,
            'role' => $request->role,
        ]);

        return response()->json([
            'message' => 'account created successfully',
        ], 201);
    }
}
