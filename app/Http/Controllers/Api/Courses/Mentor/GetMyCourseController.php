<?php

namespace App\Http\Controllers\Api\Courses\Mentor;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\GetMyCourseResource;

class GetMyCourseController extends Controller
{
    public function getMyCourse() {
        $courses = Course::where('user_id', auth()->user()->id)->latest()->get();

        return GetMyCourseResource::collection($courses);
    }
}
