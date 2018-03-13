<?php

namespace EEvent;

use Eloquent;

class Attendee extends Eloquent
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'event_id', 'user_id', 'check_in'
    ];

    public function user()
    {
        return $this->belongsTo('EEvent\User');
    }

    public function payment()
    {
        return $this->hasOne('EEvent\Payment');
    }

    public function event()
    {
        return $this->belongsTo('EEvent\Event');
    }
}
