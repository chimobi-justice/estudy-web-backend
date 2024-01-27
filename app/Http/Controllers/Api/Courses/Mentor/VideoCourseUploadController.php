<?php

namespace App\Http\Controllers\Api\Courses\Mentor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VideoCourseUploadController extends Controller
{
    /**
     * @OA\Post(
     *      path="/courses/m/video",
     *      operationId="PostMentorcourseVideo",
     *      tags={"courses"},
     *      summary="Upload course video to cloudinary",
     *      security={{"bearer_token": {}}},
     *      description="Upload course video to cloudinary and get actual URL from response to use for course endpoint",
     *      @OA\RequestBody(
     *          required=true,
     *          description="Video file to upload max 8 mb",
     *          @OA\MediaType(
     *              mediaType="multipart/form-data",
     *              @OA\Schema(
     *                  @OA\Property(
     *                      property="video",
     *                      type="string",
     *                      format="binary",
     *                      description="Video file to upload"
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
     *                  "video": "https://res.cloudinary.com/estudy/image/upload/v1705789451/yofikr4gyecw04sp5ial.mp4"
     *              }
     *          )
     *      ),
     *      @OA\Response(response="401", description="Unauthenticated")
     * )
     */
    public function videoUpload(Request $request) {
        $request->validate([
            'video' => 'required',
            'video.*' => 'mimetypes:video/avi,video/mpeg,video/mp4|max:8192',
        ], [
            'video.*.mimetypes' => 'The :attribute must be a video of type: avi, mpeg or mp4.',
            'video.*.max' => 'The :attribute must not be greater than 8 MB.',
        ]);

        try {
            $videoUpload = cloudinary()->uploadVideo($request->file('video')->getRealPath())->getSecurePath();

            return response([
                'message' => 'Uploaded',
                'video' => $videoUpload
            ], 201);
        } catch (Exception $e) {
            return response([
                'message' => $e->getMessage()
            ]);
        }
        
    }
}
