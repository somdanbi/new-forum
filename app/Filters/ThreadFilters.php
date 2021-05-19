<?php

namespace App\Filters;

use App\User;

class ThreadFilters extends Filters
{

    /**
     * Registered filters to operate upon.
     *
     * @var array
     */
    protected $filters = [ 'by','popular' ];



    /**
     * @param $username
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function by($username)
    {
        $user = User::where('name', $username)->firstOrFail();
        return $this->builder->where('user_id', $user->id);
    }

    /**
     * Filter the query according to most popular threads.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function popular()
    {
        return $this->builder->orderBy('replies_count', 'desc');
    }
}
