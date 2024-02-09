<?php

namespace App\Http\Controllers\Api\Courses\Mentor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PreviewCourseUploadController extends Controller
{
    public function previewUpload(Request $request) {
        $request->validate([
            'course_preview' => 'required',
            'course_preview.*' => 'mimetypes:video/avi,video/mpeg,video/mp4|max:8192',
        ], [
            'course_preview.*.mimetypes' => 'The :attribute must be a video of type: avi, mpeg or mp4.',
            'course_preview.*.max' => 'The :attribute must not be greater than 8 MB.',
        ]);

        try {
            $coursePreviewUpload = cloudinary()->uploadVideo($request->file('course_preview')->getRealPath())->getSecurePath();

            return response([
                'message' => 'Uploaded',
                'course_preview' => $coursePreviewUpload
            ], 201);
        } catch (Exception $e) {
            return response([
                'message' => 'Something went wrong'
            ]);
        }
        
    }
}
