<?php

namespace App\Http\Controllers\Api\Courses\Mentor;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CreateCourseController extends Controller
{
    /**
    * @OA\Post(
    *  path="/courses/m/create",
    *  tags={"courses"},
    *  summary="Created course only by mentor",
    *  description="Created course only by mentor",
    *  security={{"bearer_token": {}}},
    *  @OA\RequestBody(
    *    required=true,
    *    description="Created courses by mentor only: (Get your videos from return payload at /courses/m/video) and (thumbnail from return payload /courses/m/thumnail)",
    *    @OA\JsonContent(
    *      @OA\Property(property="name", type="string", example="estudy course name"),
    *      @OA\Property(property="price", type="number", example=10),
    *      @OA\Property(
    *        property="video", 
    *        type="string", 
    *        example={
    *           "https://res.cloudinary.com/estudy/image/upload/v1705789451/yofikr4gyecw04sp5ial.mp4", 
    *           "https://res.cloudinary.com/estudy/image/upload/v1705789451/yofikr4gyecw04sp5ial.mp4"
    *        }),
    *      @OA\Property(property="category", type="string", example="Web Development"),
    *      @OA\Property(property="thumbnail", type="string", example="https://res.cloudinary.com/estudy/image/upload/v1705789451/yofikr4gyecw04sp5ial.png"),
    *      @OA\Property(property="description", type="string", example="estudy course description"),
    *      @OA\Property(property="title", type="string", example={"Title 1", "Title 2"}),
    *   )
    *  ),
    *  @OA\Response(
    *    response="201", 
    *    description="Successful operation",
    *    @OA\JsonContent(
    *      example={
    *       "message": "Course created successfully",      
    *       }
    *    ),
    *   ),
    *    @OA\Response(response="401", description="Unauthenticated"),
    * )
    */
    public function createCourse(Request $request) {   
        $this->authorize('create', Course::class);

        $request->validate([
            'name' => 'required||string',
            'price' => 'nullable|integer',
            'video' => 'required',
            'category' => 'required|string',
            'thumbnail' => 'required',
            'description' => 'required|string',
            'title' => 'required|array',
        ]);

        auth()->user()->course()->create([
            'name' => $request->name,
            'price' => $request->price,
            'video' => $request->video,
            'thumbnail' => $request->thumbnail,
            'category' => $request->category,
            'description' => $request->description,
            'title' => $request->title,
        ]);

        return response()->json([
            'message' => 'Course created successfully'
        ], 201);
    }
}
