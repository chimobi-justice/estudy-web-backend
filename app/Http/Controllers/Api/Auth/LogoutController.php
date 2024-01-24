<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    /**
     * @OA\POST(
     *   path="/auth/signout",
     *   tags={"auth"},
     *   summary="Logs out existing user",
     *   description="Logs out existing user",
     *   security={{"bearer_token": {}}},
     *   @OA\Response(
     *    response="200",
     *    description="Successfully logged out",
     *       
     *    @OA\JsonContent(
     *       example={
     *          "message": "Successfully logged out",     
     *        }
     *    )
     *   ),
     *   @OA\Response(response="401", description="Unauthenticated"),
     *    @OA\Response(response="500", description="Internal Server Error")
     * )
    */
    public function logout(){
        Auth::guard('api')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }
}
