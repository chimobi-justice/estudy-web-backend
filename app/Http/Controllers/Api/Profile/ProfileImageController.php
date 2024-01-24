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
     *        required=true,
     *        description="'Uploaded successfully'",
     *        @OA\JsonContent(
     *            @OA\Property(
     *                property="avatar", 
     *                type="string", 
     *                example="your_image_file.jpg"
     *            )
     *        )
     *      ),
     * *    @OA\Response(
     *        response="200", 
     *        description="Updated successfully",
     *        
     *        @OA\JsonContent(
     *           example={
     *              "message": "Updated successfully",
     *              "avatar": "https://res.cloudinary.com/dbx3dhfkt/image/upload/v1672045944/estudy/pictures/image-5a9482cd3-a97e-4627-dbc3-9cb53797e40a.png"
     *           }
     *        ),
     *     ),
     *     @OA\Response(response="400", description="Bad Request"),
     *     @OA\Response(response="422", description="Unprocessable Content"),
     *     @OA\Response(response="401", description="Unathenticated")
     *  )
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
            ], 200);
        } catch (Exception $e) {
            return response([
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
