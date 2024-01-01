<?php

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// use Laravel\Sanctum\Http\Controllers\CsrfCookieController;

use App\Http\Resources\UserFieldResource;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\LogoutController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Courses\PublicCourseController;
use App\Http\Controllers\Api\Courses\Student\AllCourseController;
use App\Http\Controllers\Api\Courses\Student\GetCourseController;
use App\Http\Controllers\Api\Courses\Mentor\GetMyCourseController;
use App\Http\Controllers\Api\Courses\Mentor\CreateCourseController;
use App\Http\Controllers\Api\Courses\Mentor\DeleteCourseController;
use App\Http\Controllers\Api\Courses\Mentor\UpdateCourseController;
use App\Http\Controllers\Api\Courses\Mentor\GetUpdatedCourseController;
use App\Http\Controllers\Api\Courses\Mentor\VideoCourseUploadController;
use App\Http\Controllers\Api\Courses\Mentor\ThumbnailCourseUploadController;

Route::group(['middleware' => 'auth:api'], function() {
    Route::post('/auth/signout', [LogoutController::class, 'logout']);
    
    Route::get('/user', function (Request $request) {
        // return new UserFieldResource($request->user());
        return response()->json(auth()->user());
    });

    Route::group(['prefix' => 'courses'], function() {
        Route::group(['prefix' => 'm'], function() {
            Route::post('/create', [CreateCourseController::class, 'createCourse']);
            Route::patch('/{course}', [UpdateCourseController::class, 'updateCourse']);
            Route::delete('/{course}', [DeleteCourseController::class, 'deleteCourse']);
            Route::get('/all', [GetMyCourseController::class, 'getMyCourse']);
            Route::post('/thumbnail', [ThumbnailCourseUploadController::class, 'thumbnailUplaod']);
            Route::post('/video', [VideoCourseUploadController::class, 'videoUpload']);


            Route::get('/{course}', [GetUpdatedCourseController::class, 'getUpdateCourse']);

            
        });

        Route::group(['prefix' => 's'], function() {
            Route::get('/all', [AllCourseController::class, 'allCourse']);
            Route::get('/{course}', [GetCourseController::class, 'getCourse']);
        });
    });
});


Route::group(['prefix' => 'auth'], function() {
    Route::post('signup', [RegisterController::class, 'register']);
    Route::post('signin', [LoginController::class, 'login']);
});

Route::get('/courses/all', [PublicCourseController::class, 'index']);

Route::get('/random', function() {
    return dd(Str::uuid());
});


// Route::get('/sanctum/csrf-cookie', [CsrfCookieController::class, 'show']);
