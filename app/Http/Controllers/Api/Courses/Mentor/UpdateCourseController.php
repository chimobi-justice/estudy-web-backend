<?php

namespace App\Http\Controllers\Api\Courses\Mentor;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UpdateCourseController extends Controller
{
    /**
    * @OA\Patch(
    *  path="/courses/m/{id}",
    *  tags={"courses"},
    *  summary="Update course created by a mentor",
    *  description="Update course created by a mentor",
    *  security={{"bearer_token": {}}},
    *  @OA\Parameter(
    *      name="id",
    *      description="Course ID",
    *      required=true,
    *      in="path",
    *      @OA\Schema(
    *         type="string",
    *         format="uuid"
    *      ),
    *      @OA\Examples(example="uuid", value="0006faf6-7a61-426c-9034-579f2cfcfa83", summary="An UUID value."),
    *  ),
    *  @OA\RequestBody(
    *    required=true,
    *    description="Update Course created by mentor only: (Get your videos from return payload at /courses/m/video) and (thumbnail from return payload /courses/m/thumnail)",
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
    *      @OA\Property(property="sub_title", type="string", example={"sub title 1", "Sub title 2"}),
    *      @OA\Property(property="course_preview", type="string", example="https://res.cloudinary.com/estudy/video/upload/v1705789451/yofikr4gyecw04sp5ial.mp4"),
    *   )
    *  ),
    *  @OA\Response(
    *    response="200", 
    *    description="Successful operation",
    *    @OA\JsonContent(
    *      example={
    *       "message": "Course updated successfully",      
    *       }
    *    ),
    *   ),
    *    @OA\Response(response="401", description="Unauthenticated"),
    * )
    */
    public function updateCourse(Request $request, Course $course) {  
        $this->authorize('update', $course);

        $request->validate([
            'name' => 'required|string',
            'price' => 'nullable|numeric|gt:0',
            'video' => 'required',
            'category' => 'required|string',
            'thumbnail' => 'required',
            'description' => 'required|string',
            'title' => 'required|array',
            'sub_title' => 'required|array',
            'course_preview' => 'required'
        ]);


        $course->update([
            'name' => $request->name,
            'price' => $request->price,
            'video' => $request->video,
            'thumbnail' => $request->thumbnail,
            'category' => $request->category,
            'description' => $request->description,
            'title' => $request->title,
            'sub_title' => $request->sub_title,
            'course_preview' => $request->course_preview
        ]);

        return response()->json([
            'message' => 'Course updated successfully'
        ], 200);
    }
}
