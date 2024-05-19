<?php

namespace App\Policies;

use App\Models\Note;
use App\Models\User;

class NotePolicy
{
    public function viewAny()
    {
        return true;
    }

    public function view(User $user, Note $note): bool
    {
        return $user->id === $note->user_id;
    }

    public function update(User $user, Note $note): bool
    {
        return true;
    }

    public function delete(User $user, Note $note): bool
    {
        return true;
    }
}
