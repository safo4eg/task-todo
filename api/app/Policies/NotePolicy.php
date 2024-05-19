<?php

namespace App\Policies;

use App\Models\Note;
use App\Models\User;
use Illuminate\Support\Facades\Log;

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

    public function create(User $user)
    {
        return true;
    }

   public function update(User $user, Note $note)
   {
       return $user->id === $note->user_id;
   }

    public function delete(User $user, Note $note): bool
    {
        return $user->id === $note->user_id;
    }
}
