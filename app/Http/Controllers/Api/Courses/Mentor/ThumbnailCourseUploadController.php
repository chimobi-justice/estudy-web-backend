<?php

namespace App\Http\Controllers\Api\Courses\Mentor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ThumbnailCourseUploadController extends Controller
{
     /**
     * @OA\Post(
     *      path="/courses/m/thumbnail",
     *      operationId="PostMentorcourseThumbnail",
     *      tags={"courses"},
     *      summary="Upload course thumbnail to cloudinary",
     *      security={{"bearer_token": {}}},
     *      description="Upload course thumbnail to cloudinary and get actual URL from response to use for course endpoint",
     *      @OA\RequestBody(
     *          required=true,
     *          description="Video file to upload",
     *          @OA\MediaType(
     *              mediaType="multipart/form-data",
     *              @OA\Schema(
     *                  @OA\Property(
     *                      property="thumbnail",
     *                      type="string",
     *                      format="binary",
     *                      description="thumbnail file to upload"
     *                  )
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response="200", 
     *          description="uploaded",
     *          @OA\JsonContent(
     *              example={
     *                  "message": "uploaded",
     *                  "thumbnail": "https://res.cloudinary.com/estudy/image/upload/v1705789451/yofikr4gyecw04sp5ial.png"
     *              }
     *          )
     *      ),
     *      @OA\Response(response="401", description="Unauthenticated")
     * )
     */
    public function thumbnailUplaod(Request $request) {
        $request->validate([
            'thumbnail' => 'image|mimes:jpg,png,jpeg,JPG,PNG|max:2048',
        ]);

        try {
            $imageUpload = cloudinary()->upload($request->file('thumbnail')->getRealPath())->getSecurePath();

            return response([
                'message' => 'Uploaded',
                'thumbnail' => $imageUpload
            ], 201);
        } catch (\Exception $e) {
            return response([
                'message' => $e->getMessage()
            ]);
        }
    }
}
