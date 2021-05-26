<?php

namespace App;

trait RecordsActivity
{

    protected static function bootRecordsActivity()
    {
        if ( auth()->guest() ) return;
        //when a thread is created, save that activity
        foreach (static::getActivitiesToRecord() as $event) {
            static::$event(function ($model) use ($event) {
                $model->recordActivity($event);
            });
        }
    }

    protected static function getActivitiesToRecord()
    {
        return [ 'created' ];
    }

    public function recordActivity($event)
    {
        $this->activity()->create([
            'user_id' => auth()->id(),
            'type'    => $this->getActivityType($event),
        ]);
    }

    protected function getActivityType($event)
    {
        $type = strtolower((new \ReflectionClass($this))->getShortName());
        return "{$event}_{$type}";
    }

    //Polimorphic relationship
    public function activity()
    {
        return $this->morphMany('App\Activity', 'subject');
    }
}
