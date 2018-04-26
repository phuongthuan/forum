<?php

namespace App;

use App\Notifications\ThreadWasUpdated;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use ReflectionClass;

class Thread extends Model
{
    use Activitable;

    protected $guarded = [];

    protected $with = ['creator', 'channel'];

    protected $appends = ['isSubcribedTo'];

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
        $reply = $this->replies()->create($reply);

        $this->subcriptions
            ->filter(function ($sub) use ($reply) {
                return $sub->user_id != $reply->user_id;
            })
            ->each(function ($sub) use ($reply) {
                $sub->notify($reply);
            });
        return $reply;
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
     * @return Thread
     */
    public function subcribe($userId = null)
    {
        $this->subcriptions()->create([
            'user_id' => $userId ?: auth()->id()
        ]);
        return $this;
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

    /**
     * Check thread isSubcribed?
     *
     * @return bool
     */
    public function getIsSubcribedToAttribute()
    {
        return $this->subcriptions()
            ->where('user_id', auth()->id())
            ->exists();
    }

}
