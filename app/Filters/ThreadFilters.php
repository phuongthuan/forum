<?php

namespace App\Filters;

use App\User;

class ThreadFilters extends Filters
{

    protected $filters = ['by', 'popular', 'unanswered'];


    /**
     * Filter the query by given the username.
     *
     * @param $username
     * @return mixed
     */
    protected function by($username)
    {
        $user = User::where('name', $username)->firstOrFail();

        return $this->builder->where('user_id', $user->id);
    }

    /**
     * Filter the query according to most popular threads.
     *
     * @return mixed
     */
    protected function popular()
    {
        $this->builder->getQuery()->orders = [];
        return $this->builder->orderBy('replies_count', 'desc');
    }

    /**
     * Filter the query according to most unanswered threads.
     *
     * @return mixed
     */
    public function unanswered()
    {
        return $this->builder->where('replies_count', 0);
    }

}