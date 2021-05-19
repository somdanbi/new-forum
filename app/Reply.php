<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{

    protected $guarded = [];

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function favorites()
    {
        return $this->morphMany(Favorite::class, 'favorited');
    }

    public function favorite()
    {
        // If we didn't find any record in the db that matches that (user and reply)
        // only in that case should apply a new one.(create a favorite event)
        $attributes = [ 'user_id' => auth()->id() ];

        if ( ! $this->favorites()->where($attributes)->exists() ) {
            return $this->favorites()->create($attributes);
        }
    }

}
