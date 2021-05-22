<?php

namespace App;

trait Favoritable
{
    // Using all these in reply.

    public function favorite()
    {
        // If we didn't find any record in the db that matches that (user and reply)
        // only in that case should apply a new one.(create a favorite event)
        $attributes = [ 'user_id' => auth()->id() ];

        if ( ! $this->favorites()->where($attributes)->exists() )
        {
            return $this->favorites()->create($attributes);
        }
    }

    /**
     * Determine if the current reply has been favorited.
     *
     * @return boolean
     */
    public function isFavorited()
    {
        return ! ! $this->favorites->where('user_id', auth()->id())->count();
    }

    public function getFavoritesCountAttribute()
    {
        return $this->favorites->count();
    }
}
