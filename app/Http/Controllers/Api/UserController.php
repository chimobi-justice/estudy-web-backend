<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserFieldResource;

class UserController extends Controller
{
    /**
     * @OA\Get(
     *  path="/user",
     *  tags={"users"},
     *  summary="Get curently authenticated user details",
     *  description="Get curently authenticated user details",
     *  security={{"bearer_token": {}}},
     *  @OA\Response(
     *        response="200", 
     *        description="Successful operation",
     *        
     *        @OA\JsonContent(
     *           @OA\property(
     *             property="data", 
     *             example={
     *               "id": "550e8400-e29b-41d4-a716-446655440000",
     *               "fullname": "Gift Owens",      
     *               "email": "giftowens@emample.com",
     *               "avatar": "https://res.cloudinary.com/estudy/image/upload/v1705789451/yofikr4gyecw04sp5ial.jpg",
     *               "address": "10a avenue Street",
     *               "city": "ikeja",
     *               "state": "lagos",
     *               "zip": "100001",
     *               "country": "nigeria",
     *             }
     *           )
     *        )
     *    ),
     *    @OA\Response(response="401", description="Unauthenticated"),
     * )
    */
    public function user(Request $request) {
        return new UserFieldResource($request->user());
    }
}
