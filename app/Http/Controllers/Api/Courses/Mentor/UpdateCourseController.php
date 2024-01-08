<?php

namespace App\Http\Controllers\Api\Courses\Mentor;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UpdateCourseController extends Controller
{
    public function updateCourse(Request $request, Course $course) {        
        $request->validate([
            'name' => 'required|string',
            'price' => 'required|integer',
            'video' => 'required',
            'category' => 'required|string',
            'thumbnail' => 'required',
            'description' => 'required|string',
        ]);


        $course->update([
            'name' => $request->name,
            'price' => $request->price,
            'video' => $request->video,
            'thumbnail' => $request->thumbnail,
            'category' => $request->category,
            'description' => $request->description,
        ]);

        return response()->json([
            'message' => 'Course updated successfully'
        ], 200);
    }
}
