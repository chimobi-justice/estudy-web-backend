<?php

namespace App\Http\Controllers\Api\Courses\Mentor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VideoCourseUploadController extends Controller
{
    public function videoUpload(Request $request) {
        $request->validate([
            'video' => 'mimetypes:video/avi,video/mpeg,video/quicktime,video/mp4|max:8388608'
        ]);

        try {
            $videoUpload = cloudinary()->uploadVideo($request->file('video')->getRealPath())->getSecurePath();

            return response([
                'message' => 'Uploaded',
                'video' => $videoUpload
            ], 200);
        } catch (Exception $e) {
            return response([
                'message' => $e->getMessage()
            ]);
        }
    }
}
