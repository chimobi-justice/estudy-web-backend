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
     *        response="204", 
     *        description="Successful operation",
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

            return response(null, 204);
          }
        } catch (\Exception $e) {
            return response([
                'message' => $e->getMessage()
            ]);
        }
    }
}
