<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
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


    /**
     * Favorite a reply.
     *
     * @return Model
     */
    public function favorite()
    {
        $user_id = ['user_id' => auth()->id()];
        //Check if that favorite wasn't liked, let create a favorite.
        if (!$this->favorites()->where($user_id)->exists()) {
            return $this->favorites()->create(['user_id' => auth()->id()]);
        }
    }

    /**
     * Unfavorite a reply.
     */
    public function unfavorite()
    {
        $user_id = ['user_id' => auth()->id()];

        $this->favorites()->where($user_id)->delete();
    }

    /**
     * Is Reply Favorited ?
     * @return bool
     */
    public function isFavorited()
    {
        return !!$this->favorites->where('user_id', auth()->id())->count();
    }


    public function getIsFavoritedAttribute() // $reply->isFavorited
    {
        return $this->isFavorited();
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