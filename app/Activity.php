<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Activity extends Model
{
    protected $guarded = [];

    /**
     * @return MorphTo
     */
    public function subjectable()
    {
        return $this->morphTo();
    }

    /**
     * @param $user
     * @param int $take
     * @return mixed
     */
    public static function feed($user, $take = 50)
    {
        return $user->activities()
            ->latest()
            ->take($take)
            ->with('subjectable')
            ->get()
            ->groupBy(function ($activity) {
            return $activity->created_at->format('Y-m-d');
        });
    }

}
