<?php

namespace App\Http\Controllers\Swagger;

use App\Http\Controllers\Controller;

/**
 *
 * @OA\Post(
 *     path="/api/notes",
 *     summary="Store",
 *     tags={"Note"},
 *     security={{"bearerAuth":{}}},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="title", type="string", example="Some note title"),
 *             @OA\Property(property="content", type="string", example="Some note content"),
 *             @OA\Property(
 *                 property="tags",
 *                 type="array",
 *                 @OA\Items(type="string"),
 *                 example={"tag1", "tag2", "tag3"}
 *             ),
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=201,
 *         description="HTTP_CREATED",
 *         @OA\JsonContent(
 *             @OA\Property(property="id", type="integer", example=1),
 *             @OA\Property(property="title", type="string", example="Some note title"),
 *             @OA\Property(property="content", type="string", example="Some note content"),
 *             @OA\Property(property="created_at", type="string", format="datetime", example="20-05-2024 17:15"),
 *             @OA\Property(property="updated_at", type="string", format="datetime", example="20-05-2024 17:15"),
 *             @OA\Property(
 *                 property="tags",
 *                 type="array",
 *                 @OA\Items(
 *                     @OA\Property(property="id", type="integer"),
 *                     @OA\Property(property="title", type="string")
 *                 ),
 *                 example={
 *                     {"id": 1, "title": "tag1"},
 *                     {"id": 2, "title": "tag2"},
 *                 }
 *             )
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=401,
 *         ref="#/components/responses/401"
 *     ),
 *
 *     @OA\Response(
 *          response=403,
 *          ref="#/components/responses/403"
 *      ),
 * ),
 *
 * @OA\Get (
 *      path="/api/notes",
 *      summary="Index",
 *      tags={"Note"},
 *      security={{"bearerAuth":{}}},
 *      @OA\Parameter(
 *          name="sort",
 *          in="query",
 *          description="Сортировка по created_at (asc - по возрастанию, desc - по убыванию)",
 *          required=false,
 *          @OA\Schema(type="string", enum={"asc", "desc"})
 *      ),
 *
 *      @OA\Parameter(
 *          name="tags",
 *          in="query",
 *          description="Теги для фильтрации заметок (tag1+tag2+tag3)",
 *          required=false,
 *          @OA\Schema(type="string")
 *      ),
 *
 *      @OA\Response(
 *          response=200,
 *          description="HTTP_OK",
 *          @OA\JsonContent(
 *              type="array",
 *              @OA\Items(
 *                  @OA\Property(property="id", type="integer"),
 *                  @OA\Property(property="title", type="string"),
 *                  @OA\Property(property="content", type="string"),
 *                  @OA\Property(property="created_at", type="string", format="datetime")
 *              ),
 *              example={
 *                  {
 *                      "id": 1,
 *                      "title": "Some note title",
 *                      "content": "Some note content",
 *                      "created_at": "20-05-2024 18:15"
 *                  },
 *
 *                  {
 *                      "id": 2,
 *                      "title": "Some note title",
 *                      "content": "Some note content",
 *                      "created_at": "19-05-2024 18:15"
 *                  },
 *              }
 *          )
 *      ),
 *
 *     @OA\Response(
 *         response=401,
 *         ref="#/components/responses/401"
 *     ),
 *  ),
 *
 * @OA\Get (
 *       path="/api/notes/{id}",
 *       summary="Show",
 *       tags={"Note"},
 *       security={{"bearerAuth":{}}},
 *       @OA\Parameter(
 *           name="id",
 *           in="path",
 *           description="ID of the note to retrieve",
 *           required=true,
 *           @OA\Schema(type="integer")
 *       ),
 *
 *       @OA\Response(
 *           response=200,
 *           description="HTTP_OK",
 *           @OA\JsonContent(
 *               @OA\Property(property="id", type="integer", example=1),
 *               @OA\Property(property="title", type="string", example="Some note title"),
 *               @OA\Property(property="content", type="string", example="Some note content"),
 *               @OA\Property(property="created_at", type="string", format="datetime", example="20-05-2024 18:15"),
 *               @OA\Property(property="updated_at", type="string", format="datetime", example="20-05-2024 18:15"),
 *               @OA\Property(
 *                   property="tags",
 *                   type="array",
 *                   @OA\Items(
 *                       @OA\Property(property="id", type="integer"),
 *                       @OA\Property(property="title", type="string")
 *                   ),
 *                   example={
 *                       {"id": 1, "title": "tag1"},
 *                       {"id": 2, "title": "tag2"},
 *                   }
 *               )
 *           )
 *       ),
 *
 *       @OA\Response(
 *           response=401,
 *           ref="#/components/responses/401"
 *       ),
 *
 *       @OA\Response(
 *           response=403,
 *           ref="#/components/responses/403"
 *       ),
 * ),
 *
 * @OA\Put(
 *      path="/api/notes/{id}",
 *      summary="Update",
 *      tags={"Note"},
 *      security={{"bearerAuth":{}}},
 *      @OA\Parameter(
 *          name="id",
 *          in="path",
 *          description="ID of the note to update",
 *          required=true,
 *          @OA\Schema(type="integer")
 *      ),
 *
 *     @Oa\RequestBody(
 *         required=true,
 *         description="Каждое поле можно отправлять по отдельности(path запрос) или комбинировать.",
 *         @OA\JsonContent(
 *             @OA\Property(property="title", type="string", example="Some note title"),
 *             @OA\Property(property="content", type="string", example="Some note content"),
 *             @OA\Property(
 *                 property="tags",
 *                 type="array",
 *                 @OA\Items(type="string"),
 *                 example={"tag1", "tag2", "tag3"}
 *             )
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="HTTP_OK",
 *         @OA\JsonContent(
 *             @OA\Property(property="id", type="integer", example=1),
 *             @OA\Property(property="title", type="string", example="Some note title"),
 *             @OA\Property(property="content", type="string", example="Some note content"),
 *             @OA\Property(property="created_at", type="string", format="datetime", example="20-05-2024 18:15"),
 *             @OA\Property(property="updated_at", type="string", format="datetime", example="20-05-2024 18:15"),
 *             @OA\Property(
 *                 property="tags",
 *                 type="array",
 *                 @OA\Items(
 *                     @OA\Property(property="id", type="integer"),
 *                     @OA\Property(property="title", type="string")
 *                 ),
 *                 example={
 *                     {"id": 1, "title": "tag1"},
 *                     {"id": 2, "title": "tag2"},
 *                 }
 *             )
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=401,
 *         ref="#/components/responses/401"
 *     ),
 *
 *     @OA\Response(
 *         response=403,
 *         ref="#/components/responses/403"
 *     ),
 * ),
 *
 * @OA\Delete(
 *       path="/api/notes/{id}",
 *       summary="Destroy",
 *       tags={"Note"},
 *       security={{"bearerAuth":{}}},
 *       @OA\Parameter(
 *           name="id",
 *           in="path",
 *           description="ID of the note to update",
 *           required=true,
 *           @OA\Schema(type="integer")
 *       ),
 *
 *      @OA\Response(
 *          response=204,
 *          description="HTTP_NO_CONTENT"
 *      ),
 *
 *      @OA\Response(
 *          response=401,
 *          ref="#/components/responses/401"
 *      ),
 *
 *      @OA\Response(
 *          response=403,
 *          ref="#/components/responses/403"
 *      ),
 *  ),
 */
class NoteController extends Controller
{
    //
}
