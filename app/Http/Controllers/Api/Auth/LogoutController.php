<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;

class LogoutController extends Controller
{
    public function logout(){
        if (EnsureFrontendRequestsAreStateful::fromFrontend(request())) {
            Auth::guard('web')->logout();

            request()->session()->invalidate();

            request()->session()->regenerateToken(); // session
        }
    }
}
