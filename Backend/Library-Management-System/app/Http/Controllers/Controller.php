<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *    description="This is a Library server.",
 *    title="Book Library API",
 *    version="1.0.0",
 * )
 */
/**
 * @OA\Tag(
 *     name="books",
 *     description="Everything about the Books",
 * )
 * @OA\Tag(
 *     name="Login",
 *     description="Authorization",
 * )
 * @OA\Tag(
 *     name="User",
 *     description="User lists",
 * )
 * @OA\Server(
 *     description="Library API",
 *     url="http://msi/api/v1/"
 * )
 */
/**
 * @OA\Components(
 *     @OA\SecurityScheme(
 *          securityScheme="bearerAuth",
 *          type="http",
 *          scheme="bearer",
 *          bearerFormat="JWT",
 *     )
 * )
*/

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
