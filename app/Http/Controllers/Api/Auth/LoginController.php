<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Auth\Events\Lockout;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * @OA\Post(
     *    path="/auth/signin",
     *    tags={"auth"},
     *    summary="Logs existing user with credentials",
     *    description="authentication endpoint using JWT token",
     *    @OA\RequestBody(
     *        required=true,
     *        description="authenticate if user exists",
     *        @OA\JsonContent(
     *            @OA\Property(property="email", type="string", example="giftowens@example.com"),
     *            @OA\Property(property="password", type="string", example="secrets")
     *        )
     *    ),
     *    @OA\Response(
     *        response="200", 
     *        description="Logged in successfully",
     *        
     *        @OA\JsonContent(
     *           example={
     *              "message": "Logged in successfully",      
     *              "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjgwMDAvYXBpL2F1dGgvc2lnbAsIm5iZiI6MTcwNjAwNDI1MCwianRpIjoidE1tUlNHbjg0QlZoQkdYTSIsInN1YiI6IjU1MjJmNjQyLTYyOGQtNDZkZi04NDMyLTNmZTBjMjllNDM5YiIsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.xoKfHEHLZ6vDwIfg-GZQXoMwG9wQGlgs4vDrLTEVwoU",
     *              "token_type": "bearer",
     *              "expires_in": 3600,
     *              "user_type": "mentor"
     *           }
     *        ),
     *    ),
     *    @OA\Response(response="400", description="Bad Request"),
     *    @OA\Response(response="422", description="Unprocessable Content")
     * )
    */
    public function login(Request $request) {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $credentials = request(['email', 'password']);

        $this->anthenticate();

        $token = auth()->attempt($credentials);
         
        return $this->respondWithToken($token);
    }


    protected function respondWithToken($token): JsonResponse {
        $user = auth()->user()->role;

        return response()->json([
            'message' => 'Logged in successfully',
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user_type' => $user
        ]);
    }

    private function anthenticate() {
        $this->ensureIsNotRateLimited();

        if (! Auth::attempt(request()->only('email', 'password'), request('remember'))) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => ('Invalid Email or Password'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }


    public function ensureIsNotRateLimited(): void {
        if (!RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout(request()));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     *
     * @return string
     */
    public function throttleKey(): string {
        return Str::lower(request('email')).'|'.request()->ip();
    }
}
