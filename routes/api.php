<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\UserFieldResource;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\LogoutController;
use Laravel\Sanctum\Http\Controllers\CsrfCookieController;

Route::group(['middleware' => 'auth:sanctum'], function() {
    Route::get('/user', function (Request $request) {
        return new UserFieldResource($request->user());
    });
});

Route::get('/sanctum/csrf-cookie', [CsrfCookieController::class, 'show']);

Route::post('/auth/signout', [LogoutController::class, 'logout'])->middleware('auth:sanctum');

Route::post('/auth/signup', [RegisterController::class, 'register']);
Route::post('/auth/signin', [LoginController::class, 'login']);
