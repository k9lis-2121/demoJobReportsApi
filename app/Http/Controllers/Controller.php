<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    /**
     * @OA\Swagger(
     *   schemes={"http"},
     *   host="localhost",
     *   basePath="/",
     *   @OA\Info(
     *     title="Blog posts API",
     *     version="1.0.0"
     *   )
     * )
     */
    use AuthorizesRequests, ValidatesRequests;
}
