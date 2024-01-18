<?php

namespace App\Http\Controllers\Api\Courses\Mentor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VideoCourseUploadController extends Controller
{
    public function videoUpload(Request $request) {
        $request->validate([
            'video' => 'required|array',
            'video.*' => 'mimetypes:video/avi,video/mpeg,video/quicktime,video/mp4|max:8192',
        ], [
            'video.mimetypes' => 'The :attribute must be a video of type: avi, mpeg, quicktime, or mp4.',
            'video.max' => 'The :attribute must not be greater than 8 MB.',
        ]);

        try {
            $uploadedVideos = [];

            $files = $request->file('video');

            if ($files) {
                foreach ($files as $file) {
                   $videoUpload = cloudinary()->uploadVideo($file->getRealPath())->getSecurePath();
                   
                    $uploadedVideos[] = $videoUpload;
                }

                return response([
                    'message' => 'Uploaded',
                    'videos' => $uploadedVideos
                ], 200);
        
            } else {
                return response()->json(['message' => 'No files were provided'], 400);
            }

        } catch (\Exception $e) {
            return response([
                'message' => $e->getMessage()
            ]);
        }
    }
}
