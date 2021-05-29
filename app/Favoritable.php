<?php

namespace App;

trait Favoritable
{

    /**
     * Boot the trait.
     */
    protected static function bootFavoritable()
    {
        // when you are deleting the associated model...
        static::deleting(function ($model) {
            // ...I also want to delete the favorites
            $model->favorites->each->delete();
        });
    }
    // Using all these in reply.

    public function favorite()
    {
        // If we didn't find any record in the db that matches that (user and reply)
        // only in that case should apply a new one.(create a favorite event)
        $attributes = [ 'user_id' => auth()->id() ];

        if ( ! $this->favorites()->where($attributes)->exists() ) {
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

    public function getIsFavoritedAttribute()
    {
        return $this->isFavorited();
    }

    public function unfavorite()
    {
        $attributes = [ 'user_id' => auth()->id() ];

        $this->favorites()->where($attributes)->get()->each->delete();

    }


    public function getFavoritesCountAttribute()
    {
        return $this->favorites->count();
    }
}
