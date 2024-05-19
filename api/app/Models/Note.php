<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $table = 'notes';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function tags()
    {
        return $this->belongsToMany(Tag::class)
            ->using(NoteTag::class);
    }
}
