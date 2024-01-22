<?php

namespace App\Http\Controllers\Api\Courses\Mentor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ThumbnailCourseUploadController extends Controller
{
    public function thumbnailUplaod(Request $request) {
        $request->validate([
            'thumbnail' => 'image|mimes:jpg,png,jpeg,JPG,PNG|max:2048',
        ]);

        try {
            $imageUpload = cloudinary()->upload($request->file('thumbnail')->getRealPath())->getSecurePath();

            return response([
                'message' => 'Uploaded',
                'thumbnail' => $imageUpload
            ], 200);
        } catch (\Exception $e) {
            return response([
                'message' => $e->getMessage()
            ]);
        }
    }
}
