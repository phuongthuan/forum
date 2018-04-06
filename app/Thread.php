<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use ReflectionClass;

class Thread extends Model
{
    use Activitable;

    protected $guarded = [];

    protected $with = ['creator', 'channel'];


    protected static function boot()
    {
        parent::boot();

        // When a thread be deleted, all of the replies must me deleve as well.
        static::deleting(function ($thread) {
            $thread->replies->each->delete();
        });
    }


    /**
     * Get path of thread
     *
     * @return string
     */
    public function path()
    {
        return "/threads/{$this->channel->slug}/{$this->id}";
    }

    /**
     * A thread can has many replies.
     *
     * @return HasMany
     */
    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    /**
     * Threads can belongs to a channel.
     *
     * @return BelongsTo
     */
    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    /**
     * Threads belongs to a user/creator.
     *
     * @return BelongsTo
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * A authenticated user can addReply.
     *
     * @param $reply
     * @return Model
     */
    public function addReply($reply)
    {
        return $this->replies()->create($reply);
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


    /**
     * User subcribe a thread.
     *
     * @param null $userId
     */
    public function subcribe($userId = null)
    {
        $this->subcriptions()->create([
            'user_id' => $userId ?: auth()->id()
        ]);
    }

    /**
     * User unsubcribe a thread.
     *
     * @param null $userId
     */
    public function unsubcribe($userId = null)
    {
        $this->subcriptions()
            ->where('user_id', $userId ?: auth()->id())->delete();
    }

    /**
     * A thread can has many subcriptions.
     *
     * @return HasMany
     */
    public function subcriptions()
    {
        return $this->hasMany(ThreadSubcription::class);
    }

}
