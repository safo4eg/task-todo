<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class NoteTag extends Pivot
{
    public $timestamps = false;
    public $incrementing = true;

    protected $table = 'note_tag';
    protected $primaryKey = 'id';
    protected $guarded = [];

}
