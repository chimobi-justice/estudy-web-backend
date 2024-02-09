<?php

namespace App\Http\Controllers\Api\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * @OA\Patch(
     *      path="/user/profile",
     *      operationId="updateUserProfileAvatar",
     *      tags={"users"},
     *      summary="Update current authenticated user avatar profile",
     *      security={{"bearer_token": {}}},
     *      description="Update current authenticated user avatar profile",
     *      @OA\RequestBody(
     *        required=true,
     *        description="Update user avatar profile",
     *        @OA\JsonContent(
     *            @OA\Property(property="avatar", type="string", example="https://res.cloudinary.com/dbx3dhfkt/image/upload/v1672045944/estudy/pictures/image-5a9482cd3-a97e-4627-dbc3-9cb53797e40a.png")
     *        )
     *      ),
     * *    @OA\Response(
     *        response="200", 
     *        description="Updated successfully",
     *        
     *        @OA\JsonContent(
     *           example={
     *              "message": "Updated successfully"
     *           }
     *        ),
     *     ),
     *     @OA\Response(response="400", description="Bad Request"),
     *     @OA\Response(response="422", description="Unprocessable Content"),
     *     @OA\Response(response="401", description="Unathenticated")
     *  )
     */
    public function updateProfile(Request $request) {
        try {
            $request->user()->update([
                'avatar' => $request->avatar
            ]);

            return response([
                'message' => 'Updated successfully'
            ], 200);
        } catch (\Exception $e) {
            return response([
                'message' => $e->getMessage()
            ], 500);           
        }
    }

     /**
     * @OA\Patch(
     *      path="/user/profile/all",
     *      operationId="updateUserProfile",
     *      tags={"users"},
     *      summary="Update current authenticated user profile",
     *      security={{"bearer_token": {}}},
     *      description="Update user profile",
     *      @OA\RequestBody(
     *        required=true,
     *        description="Update user profile",
     *        @OA\JsonContent(
     *            @OA\Property(property="fullname", type="string", example="Gift Owen"),
     *            @OA\Property(property="email", type="string", example="giftowens@example.com"),
     *            @OA\Property(property="address", type="string", example="10a avenue Street"),
     *            @OA\Property(property="city", type="string", example="ikeja"),
     *            @OA\Property(property="state", type="string", example="lagos"),
     *            @OA\Property(property="country", type="string", example="nigeria"),
     *            @OA\Property(property="zip", type="number", example="100001"),
     *        )
     *      ),
     * *    @OA\Response(
     *        response="200", 
     *        description="Updated successfully",
     *        
     *        @OA\JsonContent(
     *           example={
     *              "message": "Updated successfully"
     *           }
     *        ),
     *     ),
     *     @OA\Response(response="400", description="Bad Request"),
     *     @OA\Response(response="422", description="Unprocessable Content"),
     *     @OA\Response(response="401", description="Unathenticated")
     *  )
     */
    public function updateProfileAll(Request $request) {
        try {
            $request->user()->update([
                'fullname' => $request->fullname,
                'address' => $request->address,
                'city' => $request->city,
                'state' => $request->state,
                'zip' => $request->zip,
                'country' => $request->country
            ]);

            return response([
                'message' => 'Updated successfully'
            ], 200);
        } catch (\Exception $e) {
            return response([
                'message' => $e->getMessage()
            ], 500);           
        }
    }

    /**
     * @OA\Patch(
     *      path="/user/profile/bio",
     *      operationId="updateUserProfilebio",
     *      tags={"users"},
     *      summary="Mentor can add there bio fields",
     *      security={{"bearer_token": {}}},
     *      description="Update current authenticated user bio profile",
     *      @OA\RequestBody(
     *        required=true,
     *        description="Update user bio profile",
     *        @OA\JsonContent(
     *            @OA\Property(property="occupation", type="string", example="Web Developer & online instructor"),
     *            @OA\Property(property="bio", type="string", example="I'm Gift Owens & online instructor founder of GON learning")
     *        )
     *      ),
     * *    @OA\Response(
     *        response="200", 
     *        description="Your Bio has been Updated successfully",
     *        
     *        @OA\JsonContent(
     *           example={
     *              "message": "Updated successfully"
     *           }
     *        ),
     *     ),
     *     @OA\Response(response="400", description="Bad Request"),
     *     @OA\Response(response="422", description="Unprocessable Content"),
     *     @OA\Response(response="401", description="Unathenticated")
     *  )
     */
    public function updateProfileBio(Request $request) {
        try {
            $request->user()->update([
                'occupation' => $request->occupation,
                'bio' => $request->bio
            ]);

            return response([
                'message' => 'Your Bio has been Updated successfully'
            ], 200);
        } catch (\Exception $e) {
            return response([
                'message' => 'Something went wrong'
            ], 500);           
        }
    }
}
