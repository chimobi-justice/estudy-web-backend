<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DeleteAccountController extends Controller
{
    public function delete() {
       try {
          if (auth()->check()) {
            $user = auth()->user();

            $user->course()->delete();
            $user->courseEnroll()->delete();

            $user->delete();

            return response([
                'message' => 'Account deleted successfully'
            ]);
          }
        } catch (\Exception $e) {
            return response([
                'message' => $e->getMessage()
            ]);
        }
    }
}
