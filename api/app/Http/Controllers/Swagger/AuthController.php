<?php

namespace App\Http\Controllers\Swagger;

use App\Http\Controllers\Controller;

/**
 *
 * @OA\Post(
 *     path="/api/signup",
 *     summary="Signup",
 *     tags={"Auth"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(
 *                 property="username",
 *                 type="string",
 *                 minLength=6,
 *                 maxLength=32,
 *                 example="user1"
 *             ),
 *
 *             @OA\Property(
 *                 property="password",
 *                 type="string",
 *                 minLength=8,
 *                 maxLength=255,
 *                 description="Одна большая и маленькая латинская буква, хотя бы 1 цифра",
 *                 example="S2dJ42Msa34"
 *             ),
 *
 *             @OA\Property (
 *                 property="password_confirmation",
 *                 type="string",
 *                 example="S2dJ42Msa34"
 *             ),
 *         ),
 *     ),
 *
 *     @OA\Response(
 *         response=201,
 *         description="HTTP_CREATED",
 *         @OA\JsonContent(
 *             @OA\Property(property="token", type="string", example="4|0uzyn2YlL9DbbnoC2VIMkvtLzx4jXwugXIQqPPx6927408e4")
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=422,
 *         ref="#/components/responses/422"
 *     )
 * ),
 *
 * @OA\Post(
 *      path="/api/signin",
 *      summary="Signin",
 *      tags={"Auth"},
 *      @OA\RequestBody(
 *          required=true,
 *          @OA\JsonContent(
 *              @OA\Property(
 *                  property="username",
 *                  type="string",
 *                  minLength=6,
 *                  maxLength=32,
 *                  example="user1"
 *              ),
 *
 *              @OA\Property(
 *                  property="password",
 *                  type="string",
 *                  minLength=8,
 *                  maxLength=255,
 *                  example="S2dJ42Msa34"
 *              ),
 *          ),
 *      ),
 *
 *      @OA\Response(
 *          response=200,
 *          description="HTTP_OK",
 *          @OA\JsonContent(
 *              @OA\Property(property="token", type="string", example="4|0uzyn2YlL9DbbnoC2VIMkvtLzx4jXwugXIQqPPx6927408e4")
 *          )
 *      ),
 *
 *      @OA\Response(
 *          response=422,
 *          ref="#/components/responses/422"
 *      )
 *  ),
 *
 * @OA\Delete(
 *       path="/api/logout",
 *       summary="Logout",
 *       tags={"Auth"},
 *       security={{"bearerAuth":{}}},
 *       @OA\Response(
 *           response=204,
 *           description="HTTP_NO_CONTENT",
 *       ),
 *
 *       @OA\Response(
 *           response=401,
 *           ref="#/components/responses/401"
 *       ),
 *   ),
 *
 */

class AuthController extends Controller
{
    //
}
