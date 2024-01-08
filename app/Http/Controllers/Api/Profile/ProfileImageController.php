<?php

namespace App\Http\Controllers\Api\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileImageController extends Controller
{
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
