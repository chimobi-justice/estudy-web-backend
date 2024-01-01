<?php

namespace App\Http\Controllers\Api\Courses\Mentor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CreateCourseController extends Controller
{
    public function createCourse(Request $request) {        
        $request->validate([
            'name' => 'required|string',
            'price' => 'required|integer',
            'video' => 'required',
            'category' => 'required|string',
            'thumbnail' => 'required',
            'description' => 'required|string',
        ]);


        auth()->user()->course()->create([
            'name' => $request->name,
            'price' => $request->price,
            'video' => $request->video,
            'thumbnail' => $request->thumbnail,
            'category' => $request->category,
            'description' => $request->description,
        ]);

        return response()->json([
            'message' => 'Course created successfully'
        ], 201);
    }
}
