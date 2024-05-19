<?php

namespace App\Http\Controllers\Swagger;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * @OA\Info(
 *     title="Doc task todo API",
 *     version="1.0.0"
 * ),
 * @OA\PathItem(
 *     path="/api/"
 * )
 *
 * @OA\SecurityScheme(
 *     securityScheme="bearerAuth",
 *     type="http",
 *     scheme="bearer",
 *     description="Enter your bearer token in the format **Bearer <token>**"
 * ),
 *
 * @OA\Response(
 *     response=401,
 *     description="HTTP_UNAUTHORIZED",
 *     @OA\JsonContent(
 *         @OA\Property(property="message", type="string", example="Unauthenticated.")
 *     )
 * ),
 *
 * @OA\Response(
 *     response=422,
 *     description="HTTP_UNPROCESSABLE_ENTITY",
 *     @OA\JsonContent(
 *         @OA\Property(property="message", type="string", example="The username has already been taken. (and 4 more errors).")
 *     )
 * ),
 *
 * @OA\Response(
 *     response=403,
 *     description="HTTP_FORBIDDEN",
 *     @OA\JsonContent(
 *         @OA\Property(property="message", type="string", example="This action is unauthorized.")
 *     )
 * ),
 */

class MainController extends Controller
{
    //
}
