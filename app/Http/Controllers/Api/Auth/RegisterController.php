<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    /**
     * @OA\Post(
     *    path="/auth/signup",
     *    tags={"auth"},
     *    summary="Register a new user",
     *    description="Creates a new user by role using either the listed enum ['mentor', 'mentee']",
     *    @OA\RequestBody(
     *        required=true,
     *        description="create new user",
     *        @OA\JsonContent(
     *            @OA\Property(property="fullname", type="string", example="Gift Owen"),
     *            @OA\Property(property="email", type="string", example="giftowens@example.com"),
     *            @OA\Property(property="password", type="string", example="secrets"),
     *            @OA\Property(property="role", type="string", example="mentor"),
     *        )
     *    ),
     *    @OA\Response(
     *        response="201", 
     *        description="account created successfully",
     *        
     *        @OA\JsonContent(
     *           example={
     *              "message": "account created successfully",
     *           }
     *        ),
     *    ),
     *    @OA\Response(response="400", description="Bad Request"),
     *    @OA\Response(response="422", description="Unprocessable Content"),
     * )
    */
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
