<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
    * @OA\Info(
    *      version="1.0.0",
    *      title="Estudy",
    *      description="API doc for Estudy",
    *      @OA\Contact(
    *          url="https://justice-chimobi.vercel.app/",
    *      ),
    *      @OA\License(
    *          name="Apache 2.0",
    *          url="http://www.apache.org/licenses/LICENSE-2.0.html"
    *      )
    * )
    *
    * @OA\Server(
    *      url=L5_SWAGGER_CONST_HOST,
    * )
    *
    * @OA\Tag(
    *     name="Projects",
    *     description="API Endpoints of Projects"
    * )
*/
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
