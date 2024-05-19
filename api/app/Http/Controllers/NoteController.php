<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNoteRequest;
use App\Http\Requests\UpdateNoteRequest;
use App\Http\Resources\ListNoteResource;
use App\Http\Resources\NoteCollection;
use App\Http\Resources\NoteResource;
use App\Models\Note;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NoteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->authorizeResource(Note::class, 'post');
    }

    public function index(Request $request)
    {
        return ListNoteResource::collection($request->user()->notes);
    }

    public function store(StoreNoteRequest $request)
    {
        $attributes = $request->validated();
        $attributes['user_id'] = $request->user()->id;

        $note = DB::transaction(function () use($attributes) {
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

           return $note;
        });

        return response()->json($note->load('tags'), 201);
    }

    public function show(Note $note)
    {
        //
    }

    public function update(UpdateNoteRequest $request, Note $note)
    {
        //
    }

    public function destroy(Note $note)
    {
        //
    }
}
