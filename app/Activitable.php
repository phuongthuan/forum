<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use ReflectionClass;

trait Activitable
{
    /**
     * @return array
     */
    protected static function getType()
    {
        return ['created'];
    }


    protected static function bootActivitable()
    {
        if (auth()->guest()) return;

        //When a new record is created, I like to save it to Database
        foreach (static::getType() as $type) {
            static::$type(function ($model) use ($type) {
                $model->recordActivity($type);
            });
        }

        static::deleting(function ($model) {
            $model->activity()->delete();
        });
    }


    /**
     * Create the activities when user handle.
     *
     * @param $event
     * @throws \ReflectionException
     */
    protected function recordActivity($event) //Event can be: create, update or delete
    {
        $this->activity()->create([
            'user_id' => auth()->id(),
            'type' => $this->getActivityType($event), // it will display => 'created_thread'
        ]);
    }

    /**
     * Fetch the activity relationship.
     *
     * @return MorphMany
     */
    public function activity()
    {
        return $this->morphMany(Activity::class, 'subjectable');
    }

    /**
     * Get type of activity.
     *
     * @param $event
     * @return string
     * @throws \ReflectionException
     */
    protected function getActivityType($event)
    {
        $type = strtolower((new ReflectionClass($this))->getShortName());
        return "{$event}_{$type}";
    }
}