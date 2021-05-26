<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{

    protected $guarded = [];
    protected $with = [ 'creator', 'channel' ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('replyCount', function ($builder) {
            $builder->withCount('replies');
        });

        //when you delete a thread, please delete all associated replies as well.
        static::deleting(function ($thread) {
            $thread->replies()->delete();
        });

        //when a thread is created, save that activity
        static::created(function ($thread) {
            Activity::create([
                'user_id'      => auth()->id(),
                'type'         => 'created_' . strtolower((new \ReflectionClass($thread))->getShortName()),
                'subject_id'   => $thread->id,
                'subject_type' => get_class($thread),
            ]);
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

    public function addReply($reply)
    {
        $this->replies()->create($reply);
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
