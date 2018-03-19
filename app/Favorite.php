<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Favorite extends Model
{
    use Activitable;

    protected $guarded = [];

    /**
     * @return MorphTo
     */
    public function favoritable()
    {
        return $this->morphTo();
    }
}