<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DeleteAccountController extends Controller
{
    /**
     * @OA\Delete(
     *  path="/user/delete",
     *  tags={"users"},
     *  summary="Delete user from database",
     *  description="Delete user from database",
     *  security={{"bearer_token": {}}},
     *  @OA\Response(
     *        response="200", 
     *        description="Account deleted successfully",
     *        
     *        @OA\JsonContent(
     *           example={
     *               "message": "Account deleted successfully"
     *           }
     *        )
     *    ),
     *    @OA\Response(response="401", description="Unauthenticated"),
     * )
    */
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
