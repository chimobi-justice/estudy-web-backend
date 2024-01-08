<?php

namespace App\Http\Controllers\Api\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
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
}
