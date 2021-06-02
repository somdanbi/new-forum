<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{

    use RecordsActivity;

    protected $guarded = [];
    protected $with = [ 'creator', 'channel' ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();


        //when you delete a thread, please delete all associated replies as well.
        static::deleting(function ($thread) {
            $thread->replies->each->delete();
        });


    }


    public function path()
    {
        #--- this method works with a_thread_can_make_a_string_path
        # (Thread.ft.Test 1/2)
        return "/threads/{$this->channel->slug}/{$this->id}";
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }


    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @param $reply
     * @return Model
     */
    public function addReply($reply)
    {
        $reply = $this->replies()->create($reply);
        $this->increment('replies_count');
        return $reply;
    }

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    /**
     * @param $query
     * @param $filters
     * @return mixed
     */
    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }
}
