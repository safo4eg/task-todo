<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNoteRequest;
use App\Http\Requests\UpdateNoteRequest;
use App\Http\Resources\ListNoteResource;
use App\Http\Resources\NoteCollection;
use App\Http\Resources\NoteResource;
use App\Models\Note;
use App\Models\Tag;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class NoteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->authorizeResource(Note::class, 'note');
    }

    public function index(Request $request)
    {
        $inputTags = $request->input('tags');
        $sort = $request->input('sort', 'desc');

        $noteBuilder = $request->user()->notes();

        if($inputTags) {
            $tagsTitles = is_array($inputTags)? $inputTags: explode(' ', $inputTags);
             $noteBuilder->whereHas('tags', function ($query) use($tagsTitles) {
                $query->whereIn('title', $tagsTitles);
            });
        }

        $noteBuilder->orderBy('created_at', $sort);

        return ListNoteResource::collection($noteBuilder->get());
    }

    public function store(StoreNoteRequest $request)
    {
        $attributes = $request->validated();
        $attributes['user_id'] = $request->user()->id;

        DB::beginTransaction();

        try {
            $note = Note::create([
                'user_id' => $attributes['user_id'],
                'title' => $attributes['title'],
                'content' => $attributes['content']
            ]);

            $tagsId = [];
            foreach ($attributes['tags'] as $tagTitle) {
                $tag = Tag::firstOrCreate(['title' => $tagTitle]);
                $tagsId[] = $tag->id;
            }

            $note->tags()->attach($tagsId);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            return new JsonResponse(
                ['error' => 'Error when creating a note'],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }

        return new JsonResponse(new NoteResource($note), Response::HTTP_CREATED);
    }

    public function show(Note $note)
    {
        return new NoteResource($note);
    }

    public function update(UpdateNoteRequest $request, Note $note)
    {
        $attributes = collect($request->validated());
        $tags = $attributes->pull('tags');

        DB::beginTransaction();

        try {
            if($attributes->isNotEmpty()) {
                if($attributes->has('title')) {
                    $note->title = $attributes['title'];
                }

                if($attributes->has('content')) {
                    $note->content = $attributes['content'];
                }

                $note->save();
            }

            if(isset($tags)) {
                $tagsId = [];
                foreach($tags as $tagTitle) {
                    $tag = Tag::firstOrCreate(['title' => $tagTitle]);
                    $tagsId[] = $tag->id;
                }
                $note->tags()->sync($tagsId);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            return new JsonResponse(
                ['error' => 'Error when updating a note'],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }

        return new JsonResponse(new NoteResource($note), Response::HTTP_OK);
    }

    public function destroy(Note $note)
    {
        $note->delete();
        return new JsonResponse([], Response::HTTP_NO_CONTENT);
    }
}
