<?php

namespace App\Http\Controllers\Api\Courses;

use App\Http\Controllers\Controller;
use App\Http\Resources\PublicCourseResource;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;


class PublicCourseController extends Controller
{
    public function index(): JsonResource {
        $course = Course::latest()->get();

        return PublicCourseResource::collection($course); 
    }
}
