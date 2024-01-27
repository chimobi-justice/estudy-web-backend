<?php

namespace App\Http\Controllers\Api\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileImageController extends Controller
{
    /**
     * @OA\Post(
     *      path="/user/profile/avatar",
     *      operationId="PostUserProfileAvatar",
     *      tags={"users"},
     *      summary="Upload profile image to cloudinary",
     *      security={{"bearer_token": {}}},
     *      description="Upload profile image to cloudinary and get actual url from response to use for profile avatar endpoint",
     *      @OA\RequestBody(
     *          required=true,
     *          description="Image file to upload",
     *          @OA\MediaType(
     *              mediaType="multipart/form-data",
     *              @OA\Schema(
     *                  @OA\Property(
     *                      property="avatar",
     *                      type="string",
     *                      format="binary",
     *                      description="image file to upload"
     *                  )
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response="200", 
     *          description="Uploaded successfully",
     *          @OA\JsonContent(
     *              example={
     *                  "message": "uploaded",
     *                  "avatar": "https://res.cloudinary.com/estudy/image/upload/v1705789451/yofikr4gyecw04sp5ial.png"
     *              }
     *          )
     *      ),
     *      @OA\Response(response="401", description="Unauthenticated")
     * )
     */
    public function avatar(Request $request) {
        $request->validate([
            'avatar' => 'image|mimes:jpg,png,jpeg,JPG,PNG|max:2048',
        ]);

        try {
            $avatarUpload = cloudinary()->upload($request->file('avatar')->getRealPath())->getSecurePath();

            return response([
                'message' => 'Uploaded successfully',
                'avatar' => $avatarUpload
            ], 201);
        } catch (Exception $e) {
            return response([
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
