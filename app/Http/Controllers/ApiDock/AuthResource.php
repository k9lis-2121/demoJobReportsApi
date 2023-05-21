<?php

namespace App\Http\Controllers\ApiDoc;

use phpDocumentor\Reflection\Types\AggregatedType;

/**
 * Class AuthResource
 * @package App\ApiDoc
 * @OA\Schema(
 *     description="Success Auth response",
 *     title="Auth response"
 * )
 */
class AuthResource
{


    /**
     * @var string
     * @OA\Property(type="email", example="example@example.ru")
     */
    public $email;

    /**
     * @var string
     * @OA\Property(type="string", example="password")
     */
    public $password;

}
