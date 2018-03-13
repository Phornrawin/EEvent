<?php

namespace EEvent;

use Eloquent;

class Payment extends Eloquent
{
    protected $fillable = [
        'event_id', 'user_id', 'status', 'payment_time'
    ];

    public function attendee()
    {
        return $this->belongsTo('EEvent\Attendee');
    }
}
