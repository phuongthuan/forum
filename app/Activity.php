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
}
