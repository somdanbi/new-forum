<?php

namespace App\Policies;

use App\User;
use App\Thread;
use Illuminate\Auth\Access\HandlesAuthorization;

class ThreadPolicy
{
    use HandlesAuthorization;


    /**
     * Determine whether the user can update the thread.
     * @param User $user
     * @param Thread $thread
     * @return bool
     */
    public function update(User $user, Thread $thread)
    {
        return $thread->user_id == $user->id;
    }
}
