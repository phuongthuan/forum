<?php

namespace App;


use Illuminate\Database\Eloquent\Relations\MorphMany;

trait Favoritable
{
    /**
     * A reply can morph many to favorites.
     *
     * @return MorphMany
     */
    public function favorites()
    {
        return $this->morphMany(Favorite::class, 'favoritable');
    }

    public function favorite()
    {
        //Check if that favorite wasn't liked, let create a favorite.
        if (!$this->favorites()->where(['user_id' => auth()->id()])->exists()) {
            return $this->favorites()->create(['user_id' => auth()->id()]);
        }
    }

    /**
     * Is Reply Favorited ?
     * @return bool
     */
    public function isFavorited()
    {
        return !!$this->favorites->where('user_id', auth()->id())->count();
    }

    /**
     * Count Favorites.
     *
     * @return mixed
     */
    public function getFavoritesCountAttribute()
    {
        return $this->favorites->count();
    }
}