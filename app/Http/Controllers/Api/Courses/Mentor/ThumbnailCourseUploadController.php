<?php

namespace App\Http\Controllers\Api\Courses\Mentor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ThumbnailCourseUploadController extends Controller
{
    public function thumbnailUplaod(Request $request) {
        $request->validate([
            'thumbnail' => 'image|mimes:jpg,png,jpeg,JPG,PNG|max:2034608',
        ]);

        try {
            $imageUpload = cloudinary()->upload($request->file('thumbnail')->getRealPath())->getSecurePath();

            return response([
                'message' => 'Uploaded',
                'thumbnail' => $imageUpload
            ], 201);
        } catch (Exception $e) {
            return response([
                'message' => $e->getMessage()
            ]);
        }
    }
}
